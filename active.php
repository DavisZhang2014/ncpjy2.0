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
//定义个常量，用来授权调用includes里面的文件
define('IN_TG',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','active');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
//开始激活处理
if (!isset($_GET['active'])) {
	_alert_back('非法操作');
}
if (isset($_GET['action']) && isset($_GET['active']) && $_GET['action'] == 'ok') {
	$_active = _mysql_string($_GET['active']);
	if (_fetch_array("SELECT active 
			FROM tb_user 
			WHERE active='$_active' 
			LIMIT 1"
			)) {
		//将active设置为空
		_query("UPDATE tb_user 
		SET active=NULL 
		WHERE active='$_active' 
		LIMIT 1"
				);
		if (_affected_rows() == 1) {
			_close();
			_location('账户激活成功','login.php');
		} else {
			_close();
			_location('账户激活失败','register.php');
		}
	} else {
		_alert_back('非法操作');
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>多用户留言系统--激活</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
<script type="text/javascript" src="js/register.js"></script>
</head>
<body>
	<?php 
		require ROOT_PATH.'includes/header.inc.php';
	?>
	<div id="active">
		<h2>激活账户</h2>
		<p>本页面试为了模拟您的邮件功能，点击一下超级链接激活您的账户</p>
		<p><a href="active.php?action=ok&amp;active=<?php echo $_GET['active']?>"><?php echo 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"]?>active.php?action=ok&amp;active=<?php echo $_GET['active']?></a></p>
	</div>
	<?php 
		require ROOT_PATH.'includes/footer.inc.php';
	?>
</body>
</html>