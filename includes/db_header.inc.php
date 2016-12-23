<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
//开启session功能
session_start();
	if (!defined('IN_TG'))		//防止恶意调用
	{
		exit('非法调用');
	}
?>
<div id="header">
	<div id="top">
	<h1><a href="index.php">食酷网</a></h1>
		<dl>
			<?php 
			 if (isset($_COOKIE['username']) && isset($_SESSION['manager']))
			{
				
				echo '<dd>'.$_SESSION['manager'].' 您好,'.'<a href="index.php">'.$_COOKIE['username'].'</a></dd>';
				echo '<dd><a href="../logout.php">'.'退出'.'</a></dd>';
			}
			else 
			{
				echo '<dd><a href="../index.php">'.'登录'.'</a></dd>';
				echo '<dd><a href="../register.php">'.'注册'.'</a></dd>';
			}
			?>
		</dl>
	</div>
	<div id="bottom">
		<ul>
		</ul>
	</div>
</div>