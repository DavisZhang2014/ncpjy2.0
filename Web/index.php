<?php
error_reporting(1);
define('IN_DS', true);
define('APP','Web');
define('DEBUG',false);

include_once dirname(__FILE__) . '/etc/initiate.php';
$tpl->assign('domain_url',DOMAIN_URL);
$script_uri = isset($_SERVER['SCRIPT_URL'])?$_SERVER['SCRIPT_URL']:'';
if($script_uri == '/about/'){
	include_once FRONT_DIR . 'about.php';
}else{
	include_once FRONT_DIR . 'homepage.php';
}


