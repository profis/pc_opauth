<?php

function pc_opauth_install() {
	global $core;
	foreach( array('en', 'ru', 'lt') as $ln ) {
		$core->Set_variable_if($ln, 'OPAuth.Disqus', 'Disqus', 'pc_opauth');
		$core->Set_variable_if($ln, 'OPAuth.Facebook', 'Facebook', 'pc_opauth');
		$core->Set_variable_if($ln, 'OPAuth.Flickr', 'Flickr', 'pc_opauth');
		$core->Set_variable_if($ln, 'OPAuth.GitHub', 'GitHub', 'pc_opauth');
		$core->Set_variable_if($ln, 'OPAuth.Google', 'Google', 'pc_opauth');
		$core->Set_variable_if($ln, 'OPAuth.Instagram', 'Instagram', 'pc_opauth');
		$core->Set_variable_if($ln, 'OPAuth.LinkedIn', 'LinkedIn', 'pc_opauth');
		$core->Set_variable_if($ln, 'OPAuth.Live', 'Microsoft Live', 'pc_opauth');
		$core->Set_variable_if($ln, 'OPAuth.OpenID', 'OpenID', 'pc_opauth');
		$core->Set_variable_if($ln, 'OPAuth.Twitter', 'Twitter', 'pc_opauth');
		$core->Set_variable_if($ln, 'OPAuth.Vimeo', 'Vimeo', 'pc_opauth');
		if( $ln != 'ru' )
			$core->Set_variable_if($ln, 'OPAuth.VKontakte', 'VKontakte', 'pc_opauth');
	}
	$core->Set_variable_if('ru', 'OPAuth.VKontakte', 'ВКонтакте', 'pc_opauth');

	$core->Set_variable_if('en', 'OPAuth.error_banned', 'Your account is banned', 'pc_opauth');
	$core->Set_variable_if('en', 'OPAuth.error_cannot_auto_register', 'Cannot automatically register your account. There is already a registered account that uses your email address. Please sign in using the same method you used when signing in for the first time and add this method in your profile.', 'pc_opauth');
	$core->Set_variable_if('en', 'OPAuth.error_invalid_auth_response', 'Invalid authentication response', 'pc_opauth');
	$core->Set_variable_if('en', 'OPAuth.error_authentication_error', 'Authentication error', 'pc_opauth');
	$core->Set_variable_if('en', 'OPAuth.error_unsupported', 'This authentication method is not supported', 'pc_opauth');

	$core->Set_variable_if('ru', 'OPAuth.error_banned', 'Ваша учётная запись заблокирована', 'pc_opauth');
	$core->Set_variable_if('ru', 'OPAuth.error_cannot_auto_register', 'Невозможно зарегистрировать вас автоматически, так как ваш адрес эл. почты уже зарегистрирован. Пожалуйста аоспользуйтесь тем же методом авторизации, которым вы воспользовались подключаясь в первый раз, и добавьте этот метод авторизации в вашем профиле.', 'pc_opauth');
	$core->Set_variable_if('ru', 'OPAuth.error_invalid_auth_response', 'Неправильный ответ аутентификатора', 'pc_opauth');
	$core->Set_variable_if('ru', 'OPAuth.error_authentication_error', 'Ошибка аутентификации', 'pc_opauth');
	$core->Set_variable_if('ru', 'OPAuth.error_unsupported', 'Данный метод аутентификации не поддерживается', 'pc_opauth');

	$core->Set_variable_if('lt', 'OPAuth.error_banned', 'Jūsų vartotojo įrašas užblokuotas', 'pc_opauth');
	$core->Set_variable_if('lt', 'OPAuth.error_cannot_auto_register', 'Neįmanoma užregistruoti Jūs automatiškai kadangi vartotojas su Jūsų el. pašto adresu jau yra įregistruotas. Prašome prisijungti naudojant tą pati prisijungimo būda, kūri Jūs panaudojote prisijungiant pirmą kartą, ir pridėti šitą prisijungimo būdą Jūsų profilyje.', 'pc_opauth');
	$core->Set_variable_if('lt', 'OPAuth.error_invalid_auth_response', 'Blogas autentifikacijos atsakymas', 'pc_opauth');
	$core->Set_variable_if('lt', 'OPAuth.error_authentication_error', 'Autentifikacijos klaida', 'pc_opauth');
	$core->Set_variable_if('lt', 'OPAuth.error_unsupported', 'Šis prisijungimo būdas nepalaikomas', 'pc_opauth');

	$core->Set_config_if('strategy_order', 'Disqus,Facebook,Flickr,GitHub,Google,Instagram,LinkedIn,Live,OpenID,Twitter,Vimeo,VKontakte', 'pc_opauth');

	$core->Set_config_if('disqus_enabled', '0', 'pc_opauth');
	$core->Set_config_if('disqus_api_key', '', 'pc_opauth');
	$core->Set_config_if('disqus_api_secret', '', 'pc_opauth');

	$core->Set_config_if('facebook_enabled', '0', 'pc_opauth');
	$core->Set_config_if('facebook_app_id', '', 'pc_opauth');
	$core->Set_config_if('facebook_app_secret', '', 'pc_opauth');

	$core->Set_config_if('flickr_enabled', '0', 'pc_opauth');
	$core->Set_config_if('flickr_key', '', 'pc_opauth');
	$core->Set_config_if('flickr_secret', '', 'pc_opauth');

	$core->Set_config_if('github_enabled', '0', 'pc_opauth');
	$core->Set_config_if('github_client_id', '', 'pc_opauth');
	$core->Set_config_if('github_client_secret', '', 'pc_opauth');

	$core->Set_config_if('google_enabled', '0', 'pc_opauth');
	$core->Set_config_if('google_client_id', '', 'pc_opauth');
	$core->Set_config_if('google_client_secret', '', 'pc_opauth');

	$core->Set_config_if('instagram_enabled', '0', 'pc_opauth');
	$core->Set_config_if('instagram_client_id', '', 'pc_opauth');
	$core->Set_config_if('instagram_client_secret', '', 'pc_opauth');

	$core->Set_config_if('linkedin_enabled', '0', 'pc_opauth');
	$core->Set_config_if('linkedin_api_key', '', 'pc_opauth');
	$core->Set_config_if('linkedin_secret_key', '', 'pc_opauth');

	$core->Set_config_if('live_enabled', '0', 'pc_opauth');
	$core->Set_config_if('live_client_id', '', 'pc_opauth');
	$core->Set_config_if('live_client_secret', '', 'pc_opauth');

	$core->Set_config_if('twitter_enabled', '0', 'pc_opauth');
	$core->Set_config_if('twitter_key', '', 'pc_opauth');
	$core->Set_config_if('twitter_secret', '', 'pc_opauth');

	$core->Set_config_if('vimeo_enabled', '0', 'pc_opauth');
	$core->Set_config_if('vimeo_key', '', 'pc_opauth');
	$core->Set_config_if('vimeo_secret', '', 'pc_opauth');

	$core->Set_config_if('vkontakte_enabled', '0', 'pc_opauth');
	$core->Set_config_if('vkontakte_app_id', '', 'pc_opauth');
	$core->Set_config_if('vkontakte_app_secret', '', 'pc_opauth');

	$core->Set_config_if('openid_enabled', '0', 'pc_opauth');
}