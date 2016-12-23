<?php
/**
* TestGuest Version1.0
* ================================================
* Copy 2014
* Web: http://www.yc60.com
* ================================================
* Author:zhangshuhui
* Date: 2014-10-10
*/
define('IN_TG',true);
//定义一个常量，用来指定本页的内容
define('SCRIPT', 'comment_sub');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php'; //转换成硬路径，速度更快
if(!isset($_GET['order_id']) || !isset($_GET['product_id'])){
	_alert_back("非法访问");
}
//获取数据
$_clean = array();
$_clean['order_id'] = $_GET['order_id'];
$_clean['product_id'] = $_GET['product_id'];
$_clean['content'] = $_POST['content'];
$_clean['username'] = $_COOKIE['username'];
//将评论存入数据库
_query("INSERT INTO tb_comment(
						order_id,
						product_id,
						username,
						content,
						date_time
				)VALUES(
						'{$_clean['order_id']}',
						'{$_clean['product_id']}',
						'{$_clean['username']}',
						'{$_clean['content']}',
						NOW()
						)
		");
if(_affected_rows()==1){
	_close();
	_alert_back("评论成功！");
}
else
{
	_close();
	_alert_back("评论失败！");
}
?>