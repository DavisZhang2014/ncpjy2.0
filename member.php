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
require dirname(__FILE__).'/includes/common.inc.php';

$_result=_query("SELECT last_time FROM tb_user WHERE username='{$_COOKIE['username']}'");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员中心</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>

<?php 
	require ROOT_PATH.'includes/header.inc.php';
?>
<div id="member">
	<?php 
		require ROOT_PATH.'includes/member.inc.php';
	?>
	<div id="member_main">
		<div id="new_comment">
			<dl>
					<dt><strong>新消息</strong></dt>
					
			</dl>
		</div>
		<span>上次登录时间：
				<?php 
				$_rows=_fetch_array_list($_result);
				echo $_rows['last_time'];
				?>
		</span>

	</div>
</div>
<?php 
	require ROOT_PATH.'includes/footer.inc.php';
?>

</body>
</html>