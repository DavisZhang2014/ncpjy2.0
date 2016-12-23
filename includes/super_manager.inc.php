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
		<dd><a href="index.php">信息中心</a></dd>
		<dd><a href="super_member_modify.php">个人信息</a></dd>
		<dd><a href="super_member_PSW_modify.php">密码管理</a></dd>
	</dl>
	<dl>
		<dt>成员管理</dt>
		<dd><a href="member_list.php">用户列表</a></dd>
		<dd><a href="manager_list.php">管理员列表</a></dd>
		<dd><a href="member_delete_list.php">已删除成员</a></dd>		
	</dl>
	<dl>
		<dt>数据库管理</dt>
		<dd><a href="backup.php">数据库备份</a></dd>
		<dd><a href="db_product_list.php?sort=0">数据库恢复</a></dd>
		
	</dl>
</div>