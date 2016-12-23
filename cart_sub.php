<?php
/**
* TestGuest Version1.0
* ================================================
* Copy 2014
* Web: http://www.yc60.com
* ================================================
* Author:zhangshuhui
* Date: 2014-9-24
*/
//定义个常量，用来授权调用includes里面的文件
session_start();
define('IN_TG',true);
//引入公共文件
//定义一个常量，用来指定本页的内容
define('SCRIPT', 'register');
require dirname(__FILE__).'/includes/common.inc.php';

//引入验证文件
include ROOT_PATH.'includes/check.func.php';
//判断是否登录
if(!isset($_COOKIE['username'])){
	_location("请先登录", 'login.php');
}else {
//从数据库购物车表提取数据，并存入订单表
$_result = _query("SELECT product_id,quantity FROM tb_shoppingcart WHERE username='{$_COOKIE['username']}'");
//创建一个空数组，用来存放提交过来的合法数据
$_clean = array();
$_clean['order_id'] = _build_order_no();
$_clean['username'] = $_COOKIE['username'];
$_clean['product_id'] = $_POST['product_id'];
$_clean['re_name'] = $_POST['re_name'];
$_clean['phone'] = $_POST['phone'];
$_clean['address'] = $_POST['address'];
$_clean['remarks'] = $_POST['remarks'];
//将表单数据保存到数据库
_query("INSERT INTO tb_orders (
								order_id,
								username,
								re_name,
								phone,
								address,
								remarks,
								order_time
							)
						VALUES(
								'{$_clean['order_id']}',
								'{$_clean['username']}',
								'{$_clean['re_name']}',
								'{$_clean['phone']}',
								'{$_clean['address']}',
								'{$_clean['remarks']}',
								NOW()
							)"
					);
if (_affected_rows() == 1)
{
	while(!!$_rows = _fetch_array_list($_result)){
		$_html = array();
		$_html['product_id'] = $_rows['product_id'];
		$_html['quantity'] = $_rows['quantity'];
		$_html = _html($_html);
		_query("INSERT INTO tb_order_items (
										order_id,
										product_id,
										quantity
									)VALUES(
										'{$_clean['order_id']}',
										'{$_html['product_id']}',
										'{$_html['quantity']}'
									)
								");
		if(_affected_rows() == 1){
			_query("DELETE FROM tb_shoppingcart WHERE username='{$_COOKIE['username']}' AND product_id='{$_html['product_id']}'");
			_query("UPDATE tb_product
					SET
						stock = stock-'{$_html['quantity']}',
						sell_count = sell_count+'{$_html['quantity']}'
					WHERE
						id = '{$_html['product_id']}'
			");
		}
	}
	_close();
	_location('购买成功', 'index.php');
}
else
{
	_close();
	_alert_back("购买失败");
}
}
?>