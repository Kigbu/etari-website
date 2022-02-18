<?php 
session_start();
error_reporting(E_ALL);
	//echo 'Hello';
include_once('constants.php');

// Using African time zone
date_default_timezone_set('Africa/Lagos');

// global configuration array
$GLOBALS['config'] = array(
	// 'mysql' => array(
	// 			'host' => '72.52.238.104',
	// 			'username' => 'etaricr1_idea_user',
	// 			'password' => 'publishing_etari',
	// 			'db' => 'etaricr1_tech_server'
	// 			),
	'mysql' => array(
				'host' => 'localhost',
				'username' => 'root',
				'password' => '',
				'db' => 'server_tec_v1'
				),
	'remember' => array(
				'cookie_name' => 'hash',
				'cookie_expiry' => 604800
				),			
	'session' => array(
				'session_name' => 'user',
				'token_name' => 'token'
				)
	);

//echo LIB_PATH;
spl_autoload_register(function($class){
	($class == 'DB')? require_once(LIB_PATH.DS.$class.'.php') : require_once(LIB_PATH.DS.strtolower(str_replace('\\', '/', $class)).'.php');
});

require_once(SITE_ROOT .DS.'functions'.DS.'functions.php');

if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))){
	
	$hash = Cookie::get(Config::get('remember/cookie_name'));
	$hashCheck = DB::getInstance()->get('user_session', array('hash', '=', $hash));
	if($hashCheck->count()){
		$user = new User($hashCheck ->first()->user_id);
		$user->login();
	}
}
?>