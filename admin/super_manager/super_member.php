<?php
/**
* TestGuest Version1.0
* ================================================
* Copy 2014
* Web: http://www.yc60.com
* ================================================
* Author:zhangshuhui
* Date: 2014-6-25
*/
session_start();
define('IN_TG',true);
//引入公共文件
//定义一个常量，用来指定本页的内容
define('SCRIPT', 'member');
//引入公共文件
require dirname(__FILE__).'/../../includes/common.inc.php';
//是否正常登录
if(!isset($_COOKIE['username'])){
	_alert_back('非法登录');
}

$_result=_query("SELECT last_time FROM tb_admin WHERE username='{$_COOKIE['username']}'");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员个人中心</title>
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
	<div id="member_main">
	上次登录时间：
	<?php 
	$_rows=_fetch_array_list($_result);
	echo $_rows['last_time'];
	?>
	</div>
</div>
<?php 
	require ROOT_PATH.'includes/footer.inc.php';
?>

</body>
</html>