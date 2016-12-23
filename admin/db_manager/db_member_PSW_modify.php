<?php
/**
* TestGuest Version1.0
* ================================================
* Copy 2014
* Web: http://www.yc60.com
* ================================================
* Author:zhangshuhui
* Date: 2014-6-27
*/
session_start();
define('IN_TG',true);
//引入公共文件
//定义一个常量，用来指定本页的内容
define('SCRIPT', 'member_PSW_modify');
//引入公共文件
require dirname(__FILE__).'/../../includes/common.inc.php';
//引入验证文件
include ROOT_PATH.'includes/check.func.php';
//是否正常登录
if(!isset($_COOKIE['username'])){
	_alert_back('非法登录');
}

//修改资料
if($_GET['action'] == "modify")
{
	//为了防止恶意注册，跨站攻击
	$_clean = array();
	$_clean['password1']= _check_modify_password(@$_POST['password1'],6);
	$_clean['password'] = _check_password(@$_POST['password2'],@$_POST['password3'],6);
	if (!!$_rows = _fetch_array("SELECT uniqid FROM tb_admin WHERE username='{$_COOKIE['username']}' AND password='{$_clean['password1']}' LIMIT 1"))
	{
		//为了防止cookies伪造，还要比对一下唯一标识符uniqid()
		uniqid($_rows['uniqid'],$_COOKIE['uniqid']);

			_query("UPDATE tb_admin
					SET
					password = '{$_clean['password']}' 
					WHERE 
					username='{$_COOKIE['username']}'	
					");
			
	}
	//判断是否修改成功
	if (_affected_rows() == 1)
	{
		_close();
		_session_destroy();
		_location('恭喜你，密码修改成功！','db_member_PSW_modify.php');
	}
	else
	{
		_close();
		_session_destroy();
		_location('很遗憾，密码修改失败！','db_member_PSW_modify.php');
	}
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>密码修改</title>
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
			require ROOT_PATH.'includes/db_manager.inc.php';
		?>
		<div id="member_PSW_modify">
			<h2>密码修改</h2>
			<form method="post" action="?action=modify">
				<dl>
					<dd> 旧	密	码:<input type="password" name="password1"></dd>
					<dd> 新	密	码:<input type="password" name="password2">	(*新密码不得少于6位)</dd>
					<dd> 确认新密码:<input type="password" name="password3"></dd>
					<dd><input type="submit" name="submit" value="确认修改">
				</dl>
			</form>
		</div>
	</div>
<?php 
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>