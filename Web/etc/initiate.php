<?php
if (!defined('IN_DS')) {
	die('Hacking attempt');
}

include_once(dirname(__FILE__) . '/const.php');
include_once(FINAL_ROOT . 'func/common.func.php');
include_once(FINAL_ROOT . 'lib/Class.Mysql.php');
include_once(FINAL_ROOT . 'lib/Class.TemplateSmarty.php');
include_once(__ROOT__ . 'func/front.func.php');
include_once(__ROOT__ . 'etc/db_config.php');
$WWW_DB =  new Mysql(DB_NAME, DB_HOST, DB_USER, DB_PASS);
$tpl = new TemplateSmarty(APP);

?>