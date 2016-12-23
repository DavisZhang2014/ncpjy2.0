<?php
/**
* TestGuest Version1.0
* ================================================
* Copy 2014
* Web: http://www.yc60.com
* ================================================
* Author:zhangshuhui
* Date: 2014-9-19
*/
session_start();
define('IN_TG',true);
//引入公共文件
//定义一个常量，用来指定本页的内容
define('SCRIPT', 'db_manager');
//引入公共文件
require dirname(__FILE__).'/../../includes/common.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>数据库管理员中心</title>

<style type="text/css">
		@CHARSET "UTF-8";
		#member #product_list{
			border:1px solid #999;
			width:750px;
			margin:9px;
			float:right;
			background:#eed;
		}
		#member #product_list table{
			width:100%;
			margin:10px auto;
			text-align:center;
			background:#ccc;
			margin-bottom:0px;
		}
		#member #product_list table tr{
			height:25px;
			line-height:40px;
			background:#fff;
		}
		#member #product_list table tr td{
			line-height:50px;
		}
		#member #product_list table td a{
			text-decoration:none;
		}
		#member #product_list table td a:hover{
			text-decoration:underline;
		}
		#member #product_list dl{
			float:right;
			margin:10px 300px 0 0;
		}
		#member #product_list dl a{
			text-decoration:none;
			color:#333;
		}
		#member #product_list dl a:hover{
			text-decoration:underline;
			color:#030;
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
		require ROOT_PATH.'includes/orders_manager.inc.php';
	?>
	<div id="member_main">

	</div>
</div>
<?php 
	require ROOT_PATH.'includes/footer.inc.php';
?>

</body>
</html>