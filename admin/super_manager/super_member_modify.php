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
define('SCRIPT', 'member_modify');
//引入公共文件
require dirname(__FILE__).'/../../includes/common.inc.php';
//是否正常登录
if(!isset($_COOKIE['username'])){
	_alert_back('非法登录');
}

//修改资料
if($_GET['action'] == "modify")
{
	//为了防止恶意注册，跨站攻击
	_check_code($_POST['code'],$_SESSION['code']);
	if (!!$_rows = _fetch_array("SELECT uniqid FROM tb_admin WHERE username='{$_COOKIE['username']}' LIMIT 1"))
	{
		//为了防止cookies伪造，还要比对一下唯一标识符uniqid()
		uniqid($_rows['uniqid'],$_COOKIE['uniqid']);
		//引入验证文件
		include ROOT_PATH.'includes/check.func.php';

		//创建一个空数组，用来存放提交过来的合法数据
		$_clean = array();

		$_clean['password'] = _check_modify_password($_POST['password'],6);
		$_clean['sex'] = _check_sex($_POST['sex']);
		$_clean['phone'] = $_POST['phone'];

		//修改资料
		if (empty($_clean['password']))
		{
			_query("UPDATE tb_admin SET
				sex='{$_clean['sex']}',
				phone='{$_clean['phone']}',
				email='{$_clean['email']}'
			WHERE
				username='{$_COOKIE['username']}'
				");
			}
		
		}
		//判断是否修改成功
		if (_affected_rows() == 1)
		{
			_close();
			_session_destroy();
			_location('恭喜你，修改成功！','db_member_modify.php');
		}
		else
		{
			_close();
			_session_destroy();
			_location('很遗憾，修改失败！','db_member_modify.php');
		}
}

//是否正常登录
if(isset($_COOKIE['username']))
{
	//获取数据
	$_rows =_fetch_array("SELECT sex,username,phone FROM tb_admin WHERE username= '{$_COOKIE['username']}' LIMIT 1");
	if($_rows)
	{
		$_html= array();
		$_html['username'] = $_rows['username'];
		$_html['sex'] = $_rows['sex'];
		$_html['phone'] = $_rows['phone'];
		$_html = _html($_html);
		//性别选择
		if($_html['sex'] == '男')
		{
			$_html['sex_html'] = '<input type="radio" name="sex" value="男" checked="checked" /> 男 <input type="radio" name="sex" value="女" /> 女';
		}
		elseif ($_html['sex'] == '女')
		{
			$_html['sex_html'] = '<input type="radio" name="sex" value="男" /> 男  <input type="radio" name="sex" value="女" checked="checked" /> 女';
		}
	}
	else
	{
		_alert_back('此用户不存在');
	}
}
else
{
	_alert_back('非法登录');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>个人信息</title>
<?php
	require ROOT_PATH.'includes/db_title.inc.php';
?>
<script type="text/javascript" src="../../js/code.js"></script>
<script type="text/javascript" src="../../js/member_modify.js"></script>
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
		<form method="post" action="?action=modify">
			<dl>
				<dd>用户名：<?php echo $_html['username']?></dd>
				<dd>性	别：<?php echo $_html['sex_html']?></dd>
				<dd>手机号：<input type="text" name="phone" class="text" value="<?php echo $_html['phone']?>"></dd>
				<dd>验证码:<input type="text" name="code" class="text yzm" /><img src="code.php" id="code" /></dd>
				<dd><input type="submit" class="submit" value="确定" /></dd>

			</dl>
		</form>
	</div>
</div>
<?php 
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>