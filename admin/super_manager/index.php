<?php
/**
* TestGuest Version1.0
* ================================================
* Copy 2014
* Web: http://www.yc60.com
* ================================================
* Author:zhangshuhui
* Date: 2014-9-21
*/
session_start();
define('IN_TG',true);
//引入公共文件
//定义一个常量，用来指定本页的内容
define('SCRIPT', 'index');
//引入公共文件
require dirname(__FILE__).'/../../includes/common.inc.php';
include ROOT_PATH.'includes/check.func.php';
//是否正常登录
if(!isset($_COOKIE['username'])){
	_alert_back('非法登录');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>超级管理员</title>
<style type="text/css">
#member #member_modify{
	border:1px solid #999;
	width:750px;
	margin:9px;
	height:500px;
	float:right;
	background:#eed;
}
#member #member_modify h2 {
	text-indent:0;
	text-align:center;
	height:30px;
	line-height:30px;
}
#member #member_modify dl{
	width:550px;
	margin:15px auto;
	font-size:14px;	
}
#member #member_modify dl dd{
	padding:10px 0;
	border-bottom:1px dashed #999;	
}
#member #member_modify dl dd input.text{
	weidth:220px;
	height:19px;
	border:1px dashed #333;
	background:#fff;
}
#member #member_modify dl dd input.yzm{
	width:60px;
}
#member #member_modify dl dd img#code{
	position:relative;
	top:6px;
	cursor:pointer;
}
#member #member_modify dl dd  input.submit{
	border:60px;
	height:22px;
	border:1px dashed #333;
	cursor:pointer;
}

</style>

<?php
	require ROOT_PATH.'includes/db_title.inc.php';
?>
</head>
<body>
	<?php 
		require ROOT_PATH.'includes/db_header.inc.php';
	?>
<div id="member">
	<?php 
		require ROOT_PATH.'includes/super_manager.inc.php';
	?>
	<div id="member_modify">
	<h2>个人信息</h2>
		
	</div>
</div>
<?php 
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>