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
define('SCRIPT', 'db_dump');
//引入公共文件
require dirname(__FILE__).'/../../includes/common.inc.php';
//引入验证文件
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
<title>数据库备份</title>

<?php
	require ROOT_PATH.'includes/db_title.inc.php';
?>

<style type="text/css">
	#member #dump{
		border:1px solid #999;
		width:750px;
		height:500px;
		margin:9px;
		float:right;
		background:#eee;
	}
</style>
</head>
<body>
<?php 
	require ROOT_PATH.'includes/db_header.inc.php';
?>
	<div id="member">
		<?php 
			require ROOT_PATH.'includes/super_manager.inc.php';
		?>
		<div id="dump">
			123
		</div>
	</div>
<?php 
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>