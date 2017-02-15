<?php
if (!defined('IN_DS')) {
	die('Hacking attempt');
}
header("Content-type: text/html; charset=utf-8"); 
include_once(dirname(__FILE__) . '/const.php');
include_once(FINAL_ROOT . 'func/common.func.php');
include_once(__ROOT__ . 'func/common.func.php');
include_once(__ROOT__ . 'etc/db_config.php');
include_once(__ROOT__ .'lib/Class.Cookie.php');
include_once FINAL_ROOT . 'lib/Class.Mysql.php';
include_once(__ROOT__ . 'func/core.func.php');

?>