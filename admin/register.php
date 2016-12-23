<?php
/**
* TestGuest Version1.0
* ================================================
* Copy 2014
* Web: http://www.yc60.com
* ================================================
* Author:zhangshuhui
* Date: 2014-5-20
*/
//定义个常量，用来授权调用includes里面的文件
session_start();
define('IN_TG',true);
//引入公共文件
//定义一个常量，用来指定本页的内容
define('SCRIPT', 'register');
require dirname(__FILE__).'/../includes/common.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员注册</title>
<?php 
	require ROOT_PATH.'includes/admin_title.inc.php';
?>
<script type="text/javascript" src="../js/code.js"></script>
<script type="text/javascript" src="../js/register.js"></script>
</head>
<body>
<?php 
	require ROOT_PATH.'includes/db_header.inc.php';
//判断是否提交了
if(@$_GET['action']=='register')
{
	//为了防止恶意注册，跨站攻击
	_check_code($_POST['code'],$_SESSION['code']);
	//引入验证文件
	include ROOT_PATH.'includes/check.func.php';
	
	//创建一个空数组，用来存放提交过来的合法数据
	$_clean = array();	
	//可以通过唯一标示符来防止恶意注册，伪装表单跨站攻击等
	//这个存放入数据库的唯一标识符还有第二个用处，就是登录cookies验证
	$_clean['uniqid'] = _check_uniqid($_POST['uniqid'],$_SESSION['uniqid']);
	$_clean['username'] = _check_username(@$_POST['username'],2,20);
	$_clean['password'] = _check_password(@$_POST['password'],@$_POST['notpassword'],6);
	$_clean['sex'] = _check_sex(@$_POST['sex']);
	$_clean['phone'] = $_POST['phone'];
	$_clean['role_id'] = $_POST['role_id'];
	
	//在新增之前，要判断用户名是否重复
	_is_repeat(
				"SELECT username FROM tb_admin WHERE username='{$_clean['username']}' LIMIT 1",
				'对不起，此用户已被注册'
	);
	
	
	//新增用户  //在双引号里，直接放变量是可以的，比如$_username,但如果是数组，就必须加上{} ，比如 {$_clean['username']}
	_query(
						"INSERT INTO tb_admin (
																uniqid,
																username,
																password,
																sex,
																phone,
																role_id,
																reg_time																							
																) 
												VALUES (
																'{$_clean['uniqid']}',
																'{$_clean['username']}',
																'{$_clean['password']}',
																'{$_clean['sex']}',
																'{$_clean['phone']}',
																'{$_clean['role_id']}',
																NOW()
																)"
	);
	//关闭
	if (_affected_rows() == 1) 
	{
		_close();
		_location('恭喜你，注册成功,等待超级管理员审核','../index.php');
	}
	else
	{
		_close();
		_location('很遗憾，注册失败！','register.php');
	}
} 
else 
{
	$_SESSION['uniqid'] = $_uniqid = _sha1_uniqid();
}
?>
<div id="register">
	<h2>管理员注册</h2>
	<form method="post" name="register" action="register.php?action=register">
	<input type="hidden" name="uniqid" value="<?php echo $_uniqid ?>"/>
	<dl>
		<dt>请认真填写以下内容</dt>
			<dd>用 户 名：<input type="text" name="username" class="text" />(*必填，至少两位)</dd>
			<dd>密　　码：<input type="password" name="password" class="text" />(*必填，至少六位)</dd>
			<dd>确认密码：<input type="password" name="notpassword" class="text" />(*必填，同上)</dd>
			<dd>性　　别：<input type="radio" name="sex" value="男" checked="checked" />男 <input type="radio" name="sex" value="女" />女</dd>
			<dd>联系方式：<input type="text" name="phone" class="text" />(*必填，至少两位)</dd>
			<dd>注册角色：<select name="role_id">
							<option value="1">数据库管理员</option>
							<option value="2">订单管理员</option>
							<option value="3">超级管理员</option>
						</select>
			</dd>
			<dd>验 证 码：<input type="text" name="code" class="text yzm"  /><img src="code.php" id="code" /></dd>
			<dd><input type="submit" class="submit" value="注册" /></dd>
	</dl>
	</form>
</div>

<?php 
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>