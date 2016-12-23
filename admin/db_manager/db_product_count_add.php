<?php
/**
* TestGuest Version1.0
* ================================================
* Copy 2014
* Web: http://www.yc60.com
* ================================================
* Author:zhangshuhui
* Date: 2014-6-16
*/
session_start();
define('IN_TG',true);
//定义一个常量，用来指定本页的内容
define('SCRIPT', 'index');
//引入公共文件
require dirname(__FILE__).'/../../includes/common.inc.php'; //转换成硬路径，速度更快

$_clean['adds'] = intval(@$_POST['adds']);
echo $_clean['adds'].'13';
_query("UPDATE tb_product SET stock = stock + '{$_clean['adds']}' WHERE id = '{$_GET['ids']}'");
if(_affected_rows() == 1){
	_alert_goback("添加成功");
}
else{
	_alert_goback("商品数量更新失败");
}
?>
