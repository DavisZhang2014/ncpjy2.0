<?php
error_reporting(E_ALL);
define('IN_DS', true);

include_once dirname(__FILE__) . '/etc/initiate.php';
include_once __ROOT__ . 'lib/Class.Admin.php';

define('APP','Admin');
define('DEBUG',true);

$NowTime = date('Y-m-d H:i:s');
spl_autoload_register('Admin::load');
Admin::run();