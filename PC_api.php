<?php
/**
 * @var PC_core $core
 * @var PC_site $site
 * @var PC_page $page
 * @var PC_routes $routes
 * @var PC_user $site_users
 */
header('Content-Type: text/html; charset=utf-8');
header('Cache-Control: no-cache');
if (!$site->Is_loaded()) $site->Identify();

$route = $routes->Get(1);

function pc_plugin_pc_opauth_init($run = true) {
	global $core;

	$pluginName = basename(dirname(__FILE__));

	$strategies = require(dirname(__FILE__) . '/config.strategies.php');

	$config = array(
		'path' => '/' . $core->Get_rel_path('root', 'api/plugin/' . $pluginName . '/auth/'), // this is used only while Opauth::run() is called (only during authentication) so everything that goes after that path in url is parsed into strategy name and its parameters
		'complete_path' => $core->Get_url('root', 'api/plugin/' . $pluginName . '/auth/'), // not sure if it is used for any other reasons than to display an error
		'callback_url' => $core->Get_url('root', 'api/plugin/' . $pluginName . '/callback/'),
		'salt' => 'pc_opauth$' . $core->cfg['salt'],
		'callback_transport' => 'session',
		'debug' => true,
		'security_iteration' => 300,
		'security_timeout' => '2 minutes',
		'Strategy' => $strategies,
	);

	return new Opauth($config, $run);
}

switch ($route) {
	case 'callback':
		$opauth = pc_plugin_pc_opauth_init(false);

		$response = null;
		switch($opauth->env['callback_transport']) {
			case 'session':
				session_start();
				$response = $_SESSION['opauth'];
				unset($_SESSION['opauth']);
				break;

			case 'post':
				$response = unserialize(base64_decode( $_POST['opauth'] ));
				break;

			case 'get':
				$response = unserialize(base64_decode( $_GET['opauth'] ));
				break;

			default:
				PC_utils::putMessage('login-error', $core->Get_variable('OPAuth.error_unsupported', null, 'pc_opauth'));
				break;
		}

		if( is_array($response) ) {
			if (array_key_exists('error', $response)) {
				PC_utils::putMessage('login-error', $core->Get_variable('OPAuth.error_authentication_error', null, 'pc_opauth'));
			}
			else{
				if (empty($response['auth']) || empty($response['timestamp']) || empty($response['signature']) || empty($response['auth']['provider']) || empty($response['auth']['uid'])) {
					PC_utils::putMessage('login-error', $core->Get_variable('OPAuth.error_invalid_auth_response', null, 'pc_opauth'));
				} elseif (!$opauth->validate(sha1(print_r($response['auth'], true)), $response['timestamp'], $response['signature'], $reason)) {
					PC_utils::putMessage('login-error', $core->Get_variable('OPAuth.error_invalid_auth_response', null, 'pc_opauth'));
				} else {
					if( !isset($site_users) )
						$site_users = $core->Get_object('PC_user');
					if( !$site_users->Login($response['auth']) )
						PC_utils::putMessage('login-error', $core->Get_variable('OPAuth.error_' . $site_users->login_error, null, 'pc_opauth'));
				}
			}
		}

		$redirectUrl = PC_utils::getData('opauth_redirect');
		if( empty($redirectUrl) )
			$redirectUrl = $site->Get_home_link();

		if( !preg_match('#^https?://#i', $redirectUrl) )
			$redirectUrl = $core->Get_url('root', $redirectUrl);

		// Hash added to URL in order to remove authenticator's hash. This is needed since not all browsers do redirects
		// according to RFC.
		$core->Redirect($redirectUrl . '#');
		break;

	case 'auth':
		if( $routes->Get_count() == 2 )
			PC_utils::setData('opauth_redirect', (isset($_REQUEST['redirect']) && !empty($_REQUEST['redirect'])) ? $_REQUEST['redirect'] : null);
		$opauth = pc_plugin_pc_opauth_init();
		break;

	default:
		echo 'Invalid API action';
		break;
}
