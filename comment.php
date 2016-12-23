<?php
/**
* TestGuest Version1.0
* ================================================
* Copy 2014
* Web: http://www.yc60.com
* ================================================
* Author:zhangshuhui
* Date: 2014-10-9
*/
define('IN_TG',true);
//定义一个常量，用来指定本页的内容
define('SCRIPT', 'comment');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php'; //转换成硬路径，速度更快
if(!isset($_GET['id']) || !isset($_GET['order_id'])){
	_alert_back("非法访问");
}
$_id=$_GET['id'];
$_order_id=$_GET['order_id'];
$_result=_query("SELECT * FROM tb_product WHERE id= '$_id' LIMIT 1");
$_result2 = _query("SELECT order_time FROM tb_orders WHERE id='$_order_id' LIMIT 1");
$_result3 = _query("SELECT username,content,date_time FROM tb_comment WHERE product_id='$_id'");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商品评价</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>
<?php 
	require ROOT_PATH.'includes/header.inc.php';
?>

<?php 
	$_rows=_fetch_array_list($_result);
	$_rows2 = _fetch_array_list($_result2);
	$_html = array();
	$_html['id'] = $_rows['id'];
	$_html['name'] = $_rows['name'];
	$_html['pic'] = $_rows['pic'];
	$_html['material']=$_rows['material'];
	$_html['price'] = $_rows['price'];
	$_html['order_time'] = $_rows2['order_time'];
	$_html = _html($_html);	
?>
<div id="product_detail_up">
	<div id="product_detail_left">
		<img src="uploads/<?php echo $_html['pic']?>"></img>
	</div>
	
	<div id="product_detail_right">
			<h2><?php echo $_html['name']?></h2>
			<dl>
				<dt>价格：<?php echo $_html['price']?>元</dt>
			</dl>
			<dl>
				<dt>用料：</dt>
				<dd><?php echo $_html['material']?></dd>
			</dl>
			<dl>
				<dt>购买时间：<?php echo $_html['order_time']?></dt>
			</dl>
	</div>
</div>
<div id="product_detail_bottom">
		<div id="comment">
			<span>累计评价：<?php ?></span>
			<form method="post" action="comment_sub.php?order_id=<?php echo $_order_id?>&product_id=<?php echo $_id?>">
				<dl>评价内容：<textarea name = "content" cols="100" rows="5"></textarea></dl>
				<dl class="submit"><input type="submit" value="提交评价"></input></dl>
			</form>
		</div>
		<div id="content">	
		<p class="line"></p>		
			<?php 
				while (!!$_rows3 = _fetch_array_list($_result3)){
					$_html['username'] = $_rows3['username'];
					$_html['content'] = $_rows3['content'];
					$_html['date_time'] = $_rows3['date_time'];
					$_html=_html($_html);
			?>
				
				<dl class="con"><?php echo $_html['content']?></dl>
				<dl class="username"><?php echo $_html['username']?></dl>
				<dl class="time"><?php echo $_html['date_time']?></dl>
				<p class="line"></p>
			<?php 
				}
			?>
		</div>
</div>
<?php
require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>