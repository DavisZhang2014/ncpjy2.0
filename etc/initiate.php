<?php
if (!defined('IN_DS')) {
	die('Hacking attempt');
}

include_once(dirname(__FILE__) . '/const.php');

include_once(INCLUDE_ROOT . 'func/front.func.php');
include_once(INCLUDE_ROOT . 'etc/db_config.php');



$db =  new Mysql(DB_NAME, DB_HOST, DB_USER, DB_PASS);

$tpl = new TemplateSmarty();




?>