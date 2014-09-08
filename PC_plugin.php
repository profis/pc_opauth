<?php
/**
 * @var PC_core $core
 */

function pc_plugin_pc_opauth_register_strategies($params) {
	global $core;

	$pluginName = basename(dirname(__FILE__));

	$strategies = require(dirname(__FILE__) . '/config.strategies.php');

	foreach( $strategies as $strategyId => $strategy ) {
		$strategyPath = isset($strategy['strategy_url_name']) ? $strategy['strategy_url_name'] : strtolower($strategyId);
		$params['list'][$strategyId] = array(
			'url' => $core->Get_url('root', 'api/plugin/' . $pluginName . '/auth/' . $strategyPath . '/'),
			'name' => $core->Get_variable('OPAuth.' . $strategyId, null, 'pc_opauth'),
		);
	}
}

Register_class_autoloader('Opauth', dirname(__FILE__).'/lib/opauth/Opauth.php');

// $core->Register_hook('site_init', 'pc_plugin_pc_opauth_init');

$core->Register_hook('PC_user/registerExternalAuthenticators', 'pc_plugin_pc_opauth_register_strategies');

