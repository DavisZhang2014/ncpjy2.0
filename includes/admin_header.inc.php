<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
	if (!defined('IN_TG'))		//防止恶意调用
	{
		exit('非法调用');
	}
?>
<div id="header">
	<h1><a href="index.php">食酷网</a></h1>
		<dl>
			<?php 
			 if (isset($_COOKIE['username']))
			{
				echo '<dd>数据库管理员 您好,'.'<a href="../index.php">'.$_COOKIE['username'].'</a></dd>';
				echo '<dd><a href="../admin/logout.php">'.'退出'.'</a></dd>';
			}
			else 
			{
				echo '<dd><a href="../login.php">'.'登录'.'</a></dd>';
				echo '<dd><a href="../register.php">'.'注册'.'</a></dd>';
			}
			?>
		</dl>
</div>