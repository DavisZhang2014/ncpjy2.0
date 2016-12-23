<?php
/**
* TestGuest Version1.0
* ================================================
* Copy 2014
* Web: http://www.yc60.com
* ================================================
* Author:zhangshuhui
* Date: 2014-9-17
*/
session_start();
define('IN_TG',true);
//引入公共文件
//定义一个常量，用来指定本页的内容
define('SCRIPT', 'member');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
if(!isset($_COOKIE['username'])){
	_location("请先登录", "login.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>系统——购物车</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
</head>
<body>
<?php if($_GET['id']){
	//创建一个空数组，用来存放提交过来的合法数据
	if(!!isset($_COOKIE[username])){
		$_clean = array();
		$_clean['username'] =$_COOKIE['username'];
		$_clean['productid'] = $_GET['id'];

		_query("INSERT INTO tb_shoppingcart(
												username,
												product_id,
												creat_date,
												quantity
											)
											VALUES(
												'{$_clean['username']}',
												'{$_clean['productid']}',
												NOW(),
												'1'
											)");
		_alert_back("商品已成功加入购物车");
	}
	elseif (d){
	//购物车存入Cookie
	}

	}else {
	_alert_back('非法操作..！');
}?>
<?php 
	require ROOT_PATH.'includes/header.inc.php';
?>

<?php 
	require ROOT_PATH.'includes/footer.inc.php';
?>

</body>
</html>