<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
	if (!defined('IN_TG'))		//防止恶意调用
	{
		exit('非法调用');
	}
?>
<div id="header">
	<div id="top">
		<h1><a href="index.php">食酷网</a></h1>
		<dl>
			<dd>
				<?php 
				 if (isset($_COOKIE['username'])){
					echo '<dd>用户 您好,'.'<a href="member.php">'.$_COOKIE['username'].'</a></dd>';
					echo '<dd><a href="logout.php">'.'退出'.'</a></dd>';
				}
				else 
				{
					echo '<dd><a href="login.php">'.'登录'.'</a></dd>';
					echo '<dd><a href="register.php">'.'注册'.'</a></dd>';
				}
				?>
			</dd>
			<dd class="cart"><a href="shoppingcart.php"><img src="images/shopcart_icon.png" />购物车</a></dd>
		</dl>
	</div>
	<div id="bottom">
		<ul>
			<li class="index"><a href="index.php">首 页</a></li>
			<li><a href="productstuff.php?sort=0">果 品</a></li>
			<li><a href="productstuff.php?sort=1">蔬 菜</a></li>
			<li><a href="productstuff.php?sort=2">畜 禽</a></li>
			<li><a href="productstuff.php?sort=3">水 产</a></li>
			<li><a href="productstuff.php?sort=4">花 卉</a></li>
			<li><a href="productstuff.php?sort=5">其 他</a></li>
		</ul>
	</div>
</div>