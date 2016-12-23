<?php
/**
* TestGuest Version1.0
* ================================================
* Copy 2014
* Web: http://www.yc60.com
* ================================================
* Author:zhangshuhui
* Date: 2014-6-16
*/
session_start();
define('IN_TG',true);
//定义一个常量，用来指定本页的内容
define('SCRIPT', 'index');
//引入公共文件
require dirname(__FILE__).'/../../includes/common.inc.php'; //转换成硬路径，速度更快
include ROOT_PATH.'includes/check.func.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>更换图片</title>
<style type="text/css">
<!--
	dl{
		position:absolute;
		top:300px;
		left:70px;
	}
	dd{
		display:inline;
		
	}
-->
</style>
</head>
<body>
<form enctype="multipart/form-data" action="photo_replaceclass?action=replace" method="post">
				<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
				<dl class="photo_up">
					<dd><input type="file" name="userfile"  style = "width: 70px;" /></dd>
					<dd><input type="submit" value="确认修改" /></dd>
				</dl>
</form>
</body>
</html>