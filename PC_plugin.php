<?php
/**
 * @var PC_core $core
 */

function pc_plugin_pc_opauth_register_strategies($params) {
	global $core;

	$cfg = $core->cfg['pc_opauth'];
	$pluginName = basename(dirname(__FILE__));

	foreach( explode(',', $cfg['strategy_order']) as $strategyClass ) {
		$strategyClass = trim($strategyClass);
		$strategyId = strtolower($strategyClass);
		if( !isset($cfg["{$strategyId}_enabled"]) || !$cfg["{$strategyId}_enabled"] )
			continue;

		$strategyPath = isset($cfg["{$strategyId}_strategy_url_name"]) ? $cfg["{$strategyId}_strategy_url_name"] : $strategyId;
		$params['list'][$strategyClass] = array(
			'url' => $core->Get_url('root', 'api/plugin/' . $pluginName . '/auth/' . $strategyPath . '/'),
			'name' => $core->Get_variable('OPAuth.' . $strategyClass, null, 'pc_opauth'),
		);
	}
}

Register_class_autoloader('Opauth', dirname(__FILE__).'/lib/opauth/Opauth.php');

// $core->Register_hook('site_init', 'pc_plugin_pc_opauth_init');

$core->Register_hook('PC_user/registerExternalAuthenticators', 'pc_plugin_pc_opauth_register_strategies');

