<?php
/**
* TestGuest Version1.0
* ================================================
* Copy 2014
* Web: http://www.yc60.com
* ================================================
* Author:zhangshuhui
* Date: 2014-6-18
*/
session_start();
define('IN_TG',true);
//定义一个常量，用来指定本页的内容
define('SCRIPT', 'shoppingcart');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php'; //转换成硬路径，速度更快

global $_pagesize,$_pagenum;
_page("SELECT id FROM tb_shoppingcart WHERE username='{$_COOKIE['username']}'",5);

if(!isset($_COOKIE['username'])){
	_location('请先登录', 'login.php');
}
$_percent = 0.2;
//从购物车删除商品
if ($_GET['action'] == 'del' && isset($_GET['id'])) {
	//这是验证商品是否合法
	if (!!$_rows = _fetch_array("SELECT
										id
									FROM
										tb_shoppingcart
									WHERE
										id='{$_GET['id']}'
									LIMIT
										1
									")) {
	//危险操作，为了防止cookies伪造，还要比对一下唯一标识符uniqid()
			if (!!$_rows = _fetch_array("SELECT
												uniqid
											FROM
												tb_user
											WHERE
												username='{$_COOKIE['username']}'
											LIMIT
												1"
				)) {
				_uniqid($_rows['uniqid'],$_COOKIE['uniqid']);
				//删除单商品
				_query("DELETE FROM
									tb_shoppingcart
								WHERE
									id='{$_GET['id']}'
								LIMIT
									1
									");
				if (_affected_rows() == 1) {
						_close();
						_location('商品删除成功','shoppingcart.php');
					} else {
					_close();
					_alert_back('商品删除失败');
					}
				} else {
					_alert_back('非法登录');
				}
			} else {
				_alert_back('此商品不存在！');
			}
}

//获取数据购物车数据
$_result = _query("SELECT
						f.name,
						f.pic,
						f.price,
						s.id,
						s.product_id,
						s.creat_date,
						s.quantity
					FROM
						tb_product AS f,
						tb_shoppingcart AS s
					WHERE
						f.id = any(SELECT
									s.product_id
								FROM
									tb_shoppingcart
								WHERE
									s.username='{$_COOKIE['username']}')
					AND
						s.username='{$_COOKIE['username']}'
					LIMIT
						$_pagenum,$_pagesize
								");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>购物车</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>
<?php 
	require ROOT_PATH.'includes/header.inc.php';
?>
<div id="shoppingcart">
		<h2>购物车</h2>
		<?php 
			if(!!$_rows = _fetch_array_list($_result)){
		?>
		<form method="post" >
		<table cellspacing="1">
		<tr><th>图片</th><th>名称</th><th>价格</th><th>数量</th><th>总价</th><th>操作</th></tr>
		<?php 
				do{
					$_html = array();
					$_html['product_id'] = $_rows['product_id'];
					$_html['id'] = $_rows['id'];
					$_html['pic'] = $_rows['pic'];
					$_html['name'] = $_rows['name'];
					$_html['price'] = $_rows['price'];
					$_html['quantity'] = $_rows['quantity'];
					$_html = _html($_html);				
			?>
			
			<tr>
				<td><a href="product_detail.php?id=<?php echo $_html['product_id']?>"><img src="thumb.php?filename=<?php echo 'uploads/'.$_html['pic']?>&percent=<?php echo $_percent?>" /></a></td>
				<td><?php echo $_html['name']?></td>
				<td><?php echo $_html['price']?></td>
				<td><?php echo $_html['quantity']?></td>
				<td><?php echo ($_html['price']*$_html['quantity'])?></td>
				<td>[<a href="orders_buy.php?product_id=<?php echo $_html['product_id']?>">购买</a>][<a href="?action=del&id=<?php echo $_html['id']?>">删除</a>]</td>
			</tr>		
		<?php 			
		}while (!!$_rows = _fetch_array_list($_result))
		?>
		</table>
		</form>	
		<dl>
				<dd>[<a href="cart_buy.php?action=gobuy">购  买</a>]</dd>
				<dd>[<a href="shoppingcart_delete.php?username=<?php echo $_COOKIE['username'];?>">清空购物车</a>]</dd>				
		</dl>
		<?php
			 _free_result($_result);
			_paging(2);
			}else{
		?>
			<p class="no_product">购物车暂无商品</p>
		<?php 
			}
		?>
</div>
<?php
require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>