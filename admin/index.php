<?php
/**
* TestGuest Version1.0
* ================================================
* Copy 2014
* Web: http://www.yc60.com
* ================================================
* Author:zhangshuhui
* Date: 2014-5-27
*/
session_start();
define('IN_TG',true);
//引入公共文件
//定义一个常量，用来指定本页的内容
define('SCRIPT', 'login');
require dirname(__FILE__).'/../includes/common.inc.php';
//开始处理登录状态

if($_GET['action'] == 'login')
{
	//为了防止恶意注册，跨站攻击
	_check_code($_POST['code'],$_SESSION['code']);
	//引入验证文件
	include ROOT_PATH.'includes/login.func.php';
	$_clean = array();
	$_clean['username'] = _check_username($_POST['username'],2,20);
	$_clean['password'] = _check_password($_POST['password'],6);
	//到数据库去验证
	if (!!$_rows = _fetch_array("SELECT username,uniqid,role_id FROM tb_admin WHERE username='{$_clean['username']}' AND password='{$_clean['password']}' AND state = '1' LIMIT 1")) 
	{
		//登录成功后记录登录信息
		_query("UPDATE tb_admin SET
					last_time=NOW()
				WHERE
					username='{$_rows['username']}'
				");
		_close();
		_setcookies($_rows['username'],$_rows['uniqid']);
		//身份辨别
		switch ($_rows['role_id']){
			case 1:
				$_SESSION['manager'] = '数据库管理员';
				_location(null,'db_manager/index.php');
				break;
			case 2:
				$_SESSION['manager'] = '订单管理员';
				_location(null,'orders_manager/index.php');
				break;
			case 3:
				$_SESSION['manager'] = '超级管理员';
				_location(null,'super_manager/index.php');
				break;
			default:
				_location(null,'index1.php');
				break;
		}
	}
	 else 
	{
		_close();
		_session_destroy();
		_location('用户名密码不正确或者该账户未被激活！','index.php');
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员--登录</title>
<?php 
	require ROOT_PATH.'includes/admin_title.inc.php';
?>
<script type="text/javascript" src="../js/code.js"></script>
<script type="text/javascript" src="../js/login.js"></script>
</head>
<body>
<div id="login">
	<h2>管理员登录</h2>
	<form method="post" name="login" action="index.php?action=login">
		<dl>
			<dt></dt>
			<dd>用 户 名：<input type="text" name="username" class="text" /></dd>
			<dd>密　　码：<input type="password" name="password" class="text" /></dd>
			<dd>验 证 码：<input type="text" name="code" class="text code"  /> <img src="code.php" id="code" /></dd>
			<dd><input type="submit" value="登录" class="button" />&nbsp;&nbsp;&nbsp;&nbsp;<a href="register.php">管理员注册</a> </dd>
			
		</dl>
	</form>
</div>

</body>
</html>