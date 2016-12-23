<?php
/**
* TestGuest Version1.0
* ================================================
* Copy 2014
* Web: http://www.yc60.com
* ================================================
* Author:zhangshuhui
* Date: 2014-6-26
*/
if (!defined('IN_TG'))		//防止恶意调用
{
	exit('非法调用');
}

?>
<div id="member_sidebar">
	<h2>中心导航</h2>
		<dl>
			<dt>信息中心</dt>
			<dd><a href="orders_unread.php">新进订单</a></dd>
			<dd><a href="new_comment.php">最新评论</a></dd>
		</dl>
	<dl>
		<dt>账户管理</dt>
		<dd><a href="orders_member_modify.php">个人信息</a></dd>
		<dd><a href="orders_member_PSW_modify.php">密码管理</a></dd>
	</dl>
	<dl>
		<dt>订单管理</dt>	
		<dd><a href="orders_processed.php">已处理订单</a></dd>
		<dd><a href="orders_finish.php">已完成订单</a></dd>
		<dd><a href="db_product_list.php?sort=1">订单查询</a></dd>
		<dd><a href="db_product_list.php?sort=2">订单总结</a></dd>
	</dl>



</div>