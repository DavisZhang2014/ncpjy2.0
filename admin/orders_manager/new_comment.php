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
_page("SELECT id FROM tb_comment WHERE state = 0",7);
$_result = _query("SELECT * FROM 
								tb_comment
							WHERE 
								state = 0 
							LIMIT 
							$_pagenum,$_pagesize
							");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>未回复评论</title>
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
		<h2>未回复评论</h2>
		<table cellspacing="1">
		<tr><th>商品信息</th><th>商品名称</th><th>所属订单</th><th>评价内容</th><th>评价时间</th></tr>
			<?php 
				while (!!$_rows = _fetch_array_list($_result)){
					$_html = array();
					$_html['order_id'] = $_rows['order_id'];
					$_html['product_id'] = $_rows['product_id'];
					$_html['username'] = $_rows['username'];
					$_html['content'] = $_rows['content'];
					$_html['date_time'] = $_rows['date_time'];
					$_html = _html($_html);
					
					if (!!$_rows2 = _fetch_array("SELECT 
															pic,
															name
														FROM 
															tb_product 
														WHERE 
															id='{$_html['product_id']}' 
														LIMIT 
															1
														")){
						$_html['pic'] = $_rows2['pic'];
						$_html['name'] = $_rows2['name'];
						$_html = _html($_html);
					}
			?>
			<tr class="product">			
				<td><a href="comment_detail.php?id=<?php echo $_html['product_id']?>"><img src="../../thumb.php?filename=<?php echo 'uploads/'.$_html['pic']?>&percent=<?php echo $_percent?>" /></a></td>
				<td><?php echo $_html['name']?></td>
				<td><a href="order_detail.php?order_id=<?php echo $_html['order_id']?>"><?php echo $_html['order_id']?></a></td>
				<td><?php echo  $_html['content']?></td>
				<td><?php echo  $_html['date_time']?></td>
			</tr>
		
			<?php 
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