<?php
/**
* TestGuest Version1.0
* ================================================
* Copy 2014
* Web: http://www.yc60.com
* ================================================
* Author:zhangshuhui
* Date: 2014-9-21
*/
session_start();
define('IN_TG',true);
//引入公共文件
//定义一个常量，用来指定本页的内容
define('SCRIPT', 'orders_unread');
//引入公共文件
require dirname(__FILE__).'/../../includes/common.inc.php';
include ROOT_PATH.'includes/check.func.php';

$_percent = 0.2;
//分页模块
global $_pagesize,$_pagenum,$_system;
_page("SELECT id FROM tb_orders WHERE deal='1'",7);
$_result = _query("SELECT * FROM tb_orders WHERE deal='1' LIMIT $_pagenum,$_pagesize");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>未处理订单列表</title>
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
			require ROOT_PATH.'includes/orders_manager.inc.php';
		?>
	<div id="product_list">
		<h2>已处理订单</h2>
		<table cellspacing="1">
		<tr><th>商品信息</th><th>商品名称</th><th>单价</th><th>数量</th></tr>
			<?php 
				while (!!$_rows = _fetch_array_list($_result)){
					$_html = array();
					$_html['id'] = $_rows['id'];
					$_html['order_id'] = $_rows['order_id'];
					$_html['username'] = $_rows['username'];
					$_html['re_name'] = $_rows['re_name'];
					$_html['phone'] = $_rows['phone'];
					$_html['address'] = $_rows['address'];
					$_html['order_time'] = $_rows['order_time'];
					$_html = _html($_html);
			?>
			<tr class="orders">
				<td colspan="4">
					<span>订单号:<a href="order_detail.php?order_id=<?php echo $_html['order_id']?>"><?php echo $_html['order_id']?></a></span>
					<span>收货人：<?php echo $_html['re_name']?></span>
					<span>收货人联系方式：<?php echo $_html['phone']?></span>
					<span>购买时间：<?php echo $_html['order_time']?></span>
				</td>			
			</tr>
			<?php 
				$_result2 = _query("SELECT 
											of.id,
											of.name,
											of.pic,
											of.price,
											ord.quantity
										FROM 
											tb_product AS of,tb_order_items AS ord
										WHERE 
											ord.order_id='{$_rows['order_id']}' AND of.id=ord.product_id
										");
				while(!!$_rows2 = _fetch_array_list($_result2)){
					$_html['product_id'] = $_rows2['id'];
					$_html['name'] = $_rows2['name'];
					$_html['pic']=$_rows2['pic'];
					$_html['price'] = $_rows2['price'];
					$_html['quantity'] = $_rows2['quantity'];
					$_html = _html($_html);
			?>
			<tr class="product">			
				<td><a href="product_detail.php?id=<?php echo $_html['product_id']?>"><img src="../../thumb.php?filename=<?php echo 'uploads/'.$_html['pic']?>&percent=<?php echo $_percent?>" /></a></td>
				<td><?php echo $_html['name']?></td>
				<td><?php echo $_html['price']?></td>
				<td><?php echo  $_html['quantity']?></td>
			</tr>
		
			<?php 
				}
			}
			?>
		</table>
<?php 
	_paging(2);
?>
	</div>
</div>
<?php 
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>