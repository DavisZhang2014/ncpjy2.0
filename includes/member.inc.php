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
		<dt>账户管理</dt>
		<dd><a href="member.php">信息中心</a></dd>
		<dd><a href="member_modify.php">账户信息</a></dd>
		<dd><a href="member_PSW_modify.php">密码管理</a></dd>
		<dd><a href="member.php">账户余额</a></dd>
	</dl>
	<dl>
		<dt>订单管理</dt>
		<dd><a href="orders.php">我的订单</a></dd>
		<dd><a href="orders_old.php">历史订单</a></dd>
	</dl>
	<dl>
		<dt>积分管理</dt>
		<dd><a href="member.php">积分中心</a></dd>
		<dd><a href="member.php">积分商城</a></dd>
	</dl>
	<dl>
		<dt>卡券管理</dt>
		<dd><a href="member.php">VIP会员卡</a></dd>
		<dd><a href="member.php">我的礼品券</a></dd>
		<dd><a href="member.php">我的优惠券</a></dd>
	</dl>
</div>

