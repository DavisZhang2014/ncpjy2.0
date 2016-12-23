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
require dirname(__FILE__).'/includes/common.inc.php';
//登录状态
_login_state();
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
	if (!!$_rows = _fetch_array("SELECT username,uniqid FROM tb_user WHERE username='{$_clean['username']}' AND password='{$_clean['password']}' AND active='' LIMIT 1")) 
	{
		//登录成功后记录登录信息
		_query("UPDATE tb_user SET
								last_time=NOW()
							WHERE
								username='{$_rows['username']}'
							");
		_close();
		_setcookies($_rows['username'],$_rows['uniqid']);
		_location(NULL, 'index.php');
	}
	 else 
	{
		_close();
		_session_destroy();
		_location('用户名密码不正确或者该账户未被激活！','login.php');
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>多用户留言系统--登录</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/login.js"></script>
</head>
<body>
<?php 
	require ROOT_PATH.'includes/header.inc.php';
?>
<div id="login">
	<h2>登录</h2>
	<form method="post" name="login" action="login.php?action=login">
		<dl>
			<dt></dt>
			<dd>用 户 名：<input type="text" name="username" class="text" /></dd>
			<dd>密　　码：<input type="password" name="password" class="text" /></dd>
			<dd>验 证 码：<input type="text" name="code" class="text code"  /> <img src="code.php" id="code" /></dd>
			<dd><input type="submit" value="登录" class="button" /> <input type="button" value="注册" id="location" class="button location" /></dd>
		</dl>
	</form>
</div>


<?php 
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>