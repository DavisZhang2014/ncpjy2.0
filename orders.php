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
define('SCRIPT', 'orders');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
include ROOT_PATH.'includes/check.func.php';
//订单删除操作
if($_GET['action'] == 'delete' && isset($_GET['id'])){
	$_order_id = $_GET['id'];
	_query("DELETE FROM tb_order_items WHERE order_id = $_order_id");
	_query("DELETE FROM tb_orders WHERE order_id = $_order_id");
	if(_affected_rows() == 1){
		_close();
		_location("订单删除成功",'orders.php');
	}
}
$_percent = 0.2;
//分页模块
global $_pagesize,$_pagenum,$_system;
_page("SELECT id FROM tb_orders WHERE username='{$_COOKIE['username']}'",7);
$_result = _query("SELECT 
							order_id,
							re_name,
							phone,
							order_time,
							deal	
						FROM 
							tb_orders
						WHERE 
							username='{$_COOKIE['username']}' AND deal<2
					");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>我的订单</title>
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
	<div id="product_list">
		<h2>我的订单</h2>
		<table cellspacing="1">
		<tr><th>商品信息</th><th>商品名称</th><th>单价</th><th>操作</th></tr>
			<?php 
				while (!!$_rows = _fetch_array_list($_result)){
					$_html = array();
					$_html['order_id'] = $_rows['order_id'];
					$_html['re_name'] = $_rows['re_name'];
					$_html['phone'] = $_rows['phone'];
					$_html['order_time'] = $_rows['order_time'];
					$_html['deal'] = $_rows['deal'];
					$_html = _html($_html);
			?>
			<tr class="orders">
				<td colspan="4">
					<span>订单号:<a href="orders_detail.php?order_id=<?php echo $_html['order_id']?>"><?php echo $_html['order_id']?></a></span>
					<span><?php echo $_html['order_time']?></span>
					<span>收货人：<?php echo $_html['re_name']?></span>
					<span>联系方式：<?php echo $_html['phone']?></span>
					
					<span >
							<?php 
								switch ($_html['deal']){
									case 0: echo '已提交订单'; break;
									case 1: echo '已发货'; break;
									default: echo ' ';
								}
							?>
					</span>
					<span class="delete">[<a href="orders.php?action=delete&id=<?php echo $_html['order_id']?>">删除</a>]	</span>
				</td>			
			</tr>
			<?php 
				$_result2 = _query("SELECT 
											of.id,
											of.name,
											of.pic,
											of.price
										FROM 
											tb_product AS of,tb_order_items AS ord
										WHERE 
											ord.order_id='{$_html['order_id']}' AND of.id=ord.product_id
										");
				while(!!$_rows2 = _fetch_array_list($_result2)){
					$_html['product_id'] = $_rows2['id'];
					$_html['name'] = $_rows2['name'];
					$_html['pic']=$_rows2['pic'];
					$_html['price'] = $_rows2['price'];	
					$_html = _html($_html);
			?>
			<tr class="product">			
				<td><a href="product_detail.php?id=<?php echo $_html['product_id']?>"><img src="thumb.php?filename=<?php echo 'uploads/'.$_html['pic']?>&percent=<?php echo $_percent?>" /></a></td>
				<td><?php echo $_html['name']?></td>
				<td><?php echo $_html['price']?></td>
				<td>[<a href="comment.php?id=<?php echo $_html['product_id']?>&order_id=<?php echo $_html['order_id']?>">评价</a>]</td>
			</tr>
		
			<?php 
				}
			}
			?>
		</table>
	</div>
</div>
<?php 
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>