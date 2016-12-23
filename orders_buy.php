<?php
/**
* TestGuest Version1.0
* ================================================
* Copy 2014
* Web: http://www.yc60.com
* ================================================
* Author:zhangshuhui
* Date: 2014-9-22
*/
session_start();
define('IN_TG',true);
//引入公共文件
//定义一个常量，用来指定本页的内容
define('SCRIPT', 'orders_buy');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
//定义图片收缩值
$_percent = 0.2;
//获取数据
if (isset($_GET['product_id'])){
	$_product_id = $_GET['product_id'];
	$_rows = _fetch_array("SELECT phone,address FROM tb_user WHERE username='{$_COOKIE['username']}' LIMIT 1");
	$_rows2 = _fetch_array("SELECT name,pic,price FROM tb_product WHERE id='$_product_id'");
	$_html = array();
	$_html['re_name'] = $_COOKIE['username'];
	$_html['phone'] = $_rows['phone'];
	$_html['address'] = $_rows['address'];
	$_html['product_name'] = $_rows2['name'];
	$_html['pic'] = $_rows2['pic'];
	$_html['product_price'] = $_rows2['price'];
	$_html = _html($_html);
}else{
	_alert_back('非法登录');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>订单</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
</head>
<?php 
	require ROOT_PATH.'includes/header.inc.php';
?>
<body>

	<div id="orders">
		<form method="post" name="order" action="orders_sub.php">
			<input type="hidden" name="product_id" value="<?php echo $_product_id ?>" />
			<input type="hidden" name="username" value="<?php echo $_COOKIE['username']?>" />
			<dl>
				<dt>收货人信息</dt>
				<dd>收 货 人：<input type="text" name="re_name" value=<?php echo $_html['re_name']?> ></input></dd>
				<dd>手 机 号：<input type="text" name="phone" value=<?php echo  $_html['phone']?> ></input></dd>				
				<dd>收货地址：<input type="text" name="address" style="width:400px; height:20px;"></input> (*请填写详细地址)</dd>
				<dd>备注信息：<input type="text" name="remarks" style="width:500px; height:20px;"></input> (*200字以内)</dd>
			</dl>
			<dl>
				<dt>商品信息</dt>				
				<table cellspacing="1">
				<tr><th>图片</th><th>名称</th><th>价格</th><th>数量</th></tr>
				<tr>
					<td><a href="product_detail.php?id=<?php echo $_product_id?>"><img src="thumb.php?filename=<?php echo 'uploads/'.$_html['pic']?>&percent=<?php echo $_percent?>" /></a></td>
					<td><?php echo $_html['product_name']?></td>
					<td><?php echo $_html['product_price']?></td>
					<td><input type="text" name="quantity" size="2" value="1" ></input></td>
				</tr>
				</table>
			</dl>
			<dl>
				<dd class="submit"><input type="submit" class="submit" value="提交" style="width:70px;height:30px;" /></dd>
			</dl>
		</form>

	</div>
</body>
</html>