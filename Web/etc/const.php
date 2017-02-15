<?php
if (!defined('IN_DS')) {
	die('Hacking attempt');
}
//config
define('__ROOT__', dirname(dirname(__FILE__)).'/');
define('FINAL_ROOT', dirname(dirname(dirname(__FILE__))).'/');
define('FRONT_DIR',__ROOT__.'front/');
define('TPL_PREFIX',__ROOT__.'Tpl/');
define('DOMAIN_URL','http://davis.app.com');

//配置memcache
define('MEM_CACHE_SERVER_LIST', 'localhost');
define('MEM_CACHE_PORT', 11211);
define('MEM_LIFT_TIME', 3600 * 24);
define('MEM_PREX', 'hw_');


function __autoload($class)
{
	$class_file = INCLUDE_ROOT . 'lib/Class.' . $class . '.php';

	if(file_exists($class_file)){
		return include_once($class_file);
	}else{
		$class_file = __ROOT__ . 'lib/Class.' . $class . '.php';
		if(file_exists($class_file))
		return include_once($class_file);
	}
	
}
