<?php
if (!defined('IN_DS')) {
	die('Hacking attempt');
}
//config
define('__ROOT__', dirname(dirname(__FILE__)).'/');



function __autoload($class)
{
	$class_file = __ROOT__ . 'lib/Class.' . $class . '.php';
	
	if(file_exists($class_file))
		return include_once($class_file);
}
