<?php
/**
* TestGuest Version1.0
* ================================================
* Copy 2014
* Web: http://www.yc60.com
* ================================================
* Author:zhangshuhui
* Date: 2014-9-5
*/
include 'includes/global.func.php';

if (isset($_GET['filename']) && isset($_GET['percent'])) {
	_thumb($_GET['filename'],$_GET['percent']);
}
if (isset($_GET['filename']) && isset($_GET['per_w']) && isset($_GET['per_h'])) {
	_change($_GET['filename'],$_GET['per_w'],$_GET['per_h']);
	echo $_GET['per_w'].$_GET['per_h'].'123123';
}
?>