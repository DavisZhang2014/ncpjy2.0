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
define('SCRIPT', 'member_list');
//引入公共文件
require dirname(__FILE__).'/../../includes/common.inc.php';
include ROOT_PATH.'includes/check.func.php';
//是否正常登录
if(!isset($_COOKIE['username'])){
	_alert_back('非法登录');
}
if(isset($_GET['id']) && $_GET['action'] == 'lock'){
	_query(" UPDATE tb_user SET state = '0' WHERE id = '{$_GET['id']}' ");
	if (_affected_rows() == 1)
	{
		_location('恭喜你，封号成功！','member_list.php');
	}
	else
	{
		_location('很遗憾，封号失败！','member_list.php');
	}

}
if(isset($_GET['id']) && $_GET['action'] == 'unlock'){
	_query(" UPDATE tb_user SET state = '1' WHERE id = '{$_GET['id']}' ");
	if (_affected_rows() == 1)
	{
		_location('恭喜你，解除成功！','member_list.php');
	}
	else
	{
		_location('很遗憾，解除失败！','member_list.php');
	}
}
if(isset($_GET['id']) && $_GET['action'] == 'delete'){
	_query(" UPDATE tb_user SET del = '1' WHERE id = '{$_GET['id']}' ");
	if (_affected_rows() == 1)
	{
		_location('恭喜你，删除成功，可以在已删除成员里选择恢复','member_delete_list.php');
	}
	else
	{
		_location('很遗憾，删除失败！','member_delete_list.php');
	}
}

global $_pagesize,$_pagenum;

_page("SELECT id FROM tb_user",5);
$_result = _query("SELECT id,username,state,sex,email,reg_time FROM tb_user LIMIT $_pagenum,$_pagesize");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
	#member #member_list{
	border:1px solid #999;
	width:750px;
	margin:9px;
	float:right;
	background:#eed;
	}
	#member #member_list table{
		width:100%;
		margin:10px auto;
		text-align:center;
		background:#ccc;
		margin-bottom:0px;
	}
	#member #member_list table tr{
		height:25px;
		line-height:40px;
		background:#fff;
	}
	#member #member_list table tr td{
		line-height:50px;
	}
	#member #member_list table td a{
		text-decoration:none;
	}
	#member #member_list table td a:hover{
		text-decoration:underline;
	}
	#member #member_list dl{
		float:right;
		margin:10px 300px 0 0;
	}
	#member #member_list dl a{
		text-decoration:none;
		color:#333;
	}
	#member #member_list dl a:hover{
		text-decoration:underline;
		color:#030;
	}
	
</style>
<title>商品列表</title>
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
			require ROOT_PATH.'includes/super_manager.inc.php';
		?>
	<div id="member_list">
		<h2>用户列表</h2>
		<table cellspacing="1">
		<tr><th>ID</th><th>用户名</th><th>性别</th><th>邮箱</th><th>注册时间</th><th>操作</th></tr>
			<?php 
				while (!!$_rows = _fetch_array_list($_result)){
					$_html = array();
					$_html['id'] = $_rows['id'];
					$_html['username'] = $_rows['username'];
					$_html['state'] = $_rows['state'];
					$_html['sex'] = $_rows['sex'];
					$_html['email'] = $_rows['email'];
					$_html['reg_time'] = $_rows['reg_time'];
					$_html = _html($_html);
			?>
			<tr>
				<td><?php echo $_html['id']?></td>
				<td><?php echo $_html['username']?></td>
				<td><?php echo $_html['sex']?></td>
				<td><?php echo $_html['email']?></td>
				<td><?php echo $_html['reg_time']?></td>
				<td>
					<?php 
						if ($_html['state'] != 0)
						  	{	echo '[<a href="?id='.$_html['id'].'&action=lock">封号</a>]' ;}
						else 
							{	echo '[<a href="?id='.$_html['id'].'&action=unlock">已封号</a>]'; }
						echo ' [<a href="?id='.$_html['id'].'&action=delete">删除</a>]';
					?>
				</td>
			</tr>
			<?php 
				}

			?>
		</table>
		<?php 
			//调用分页
			_free_result($_result);
			_paging(1);
		?>
	</div>
</div>
<?php 
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>