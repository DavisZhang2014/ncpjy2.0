<?php
if (!defined('IN_DS')) {
	die('Hacking attempt');
}
//config
define('__ROOT__', dirname(dirname(__FILE__)).'/');
define('FINAL_ROOT', dirname(dirname(dirname(__FILE__))).'/');

//COOKIE_PREFIX
define('COOKIE_PREFIX',"DAVIS_");
define('COOKIE_EXPIRE', time()+3600*24);
define('COOKIE_PATH','');
define('COOKIE_DOMAIN','davis.app.backend.com');
define('MYSQL_ENCODING','UTF8');

