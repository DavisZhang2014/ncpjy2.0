<?php
/**
* TestGuest Version1.0
* ================================================
* Copy 2014
* Web: http://www.yc60.com
* ================================================
* Author:zhangshuhui
* Date: 2014-10-12
*/
session_start();
define('IN_TG',true);
//定义一个常量，用来指定本页的内容
define('SCRIPT', 'deliver');
//引入公共文件
require dirname(__FILE__).'/../../includes/common.inc.php'; //转换成硬路径，速度更快
if($_GET['action'] == 'sub' && isset($_GET['order_id'])){
	$_clean = array();
	$_clean['order_id'] = $_GET['order_id'];
	//更改订单数据库，将处理状态设为已处理
	_query("UPDATE tb_orders SET deal ='1' WHERE order_id ='{$_clean['order_id']}'");
	if(_affected_rows() ==1){
		_close();
		_location("发货成功", "orders_unread.php");
	}else{
		_close();
		_alert_back("数据库操作失败");
	}
	
}else{
	_alert_back("发货失败");
}
?>