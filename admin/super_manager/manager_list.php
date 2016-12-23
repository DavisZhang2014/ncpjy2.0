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
define('SCRIPT', 'manager_list');
//引入公共文件
require dirname(__FILE__).'/../../includes/common.inc.php';
include ROOT_PATH.'includes/check.func.php';
//是否正常登录
if(!isset($_COOKIE['username'])){
	_alert_back('非法登录');
}
if(isset($_GET['id']) && $_GET['action'] == 'lock'){
	_query(" UPDATE tb_admin SET state = '0' WHERE id = '{$_GET['id']}' ");
	if (_affected_rows() == 1)
		{
			_location('恭喜你，封号成功！','manager_list.php');
		}
	else
		{
			_location('很遗憾，封号失败！','manager_list.php');
		}

}
if(isset($_GET['id']) && $_GET['action'] == 'unlock'){
	_query(" UPDATE tb_admin SET state = '1' WHERE id = '{$_GET['id']}' ");
	if (_affected_rows() == 1)
		{
			_location('恭喜你，解除成功！','manager_list.php');
		}
	else
		{
			_location('很遗憾，解除失败！','manager_list.php');
		}
}

global $_pagesize,$_pagenum;
_page("SELECT id FROM tb_admin",5);
$_result = _query("SELECT id,username,sex,phone,state,reg_time,role_id FROM tb_admin LIMIT $_pagenum,$_pagesize");


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
		cursor:pointer;
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
<title>管理员列表</title>
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
		<h2>管理员列表</h2>
		<table cellspacing="1">
		<tr><th>ID</th><th>用户名</th><th>性别</th><th>手机号</th><th>注册时间</th><th>角色</th><th>操作</th></tr>
			<?php 
				while (!!$_rows = _fetch_array_list($_result)){
					$_html = array();
					$_html['id'] = $_rows['id'];
					$_html['username'] = $_rows['username'];
					$_html['sex'] = $_rows['sex'];
					$_html['phone'] = $_rows['phone'];		
					$_html['state'] = $_rows['state'];
					$_html['reg_time'] = $_rows['reg_time'];
					$_html['role_id'] = $_rows['role_id'];
					$_html = _html($_html);
			?>
			<tr>
				<td><?php echo $_html['id']?></td>
				<td><?php echo $_html['username']?></td>
				<td><?php echo $_html['sex']?></td>
				<td><?php echo $_html['phone']?></td>
				<td><?php echo $_html['reg_time']?></td>
				<td>
					<?php
						switch ($_html['role_id']){
							case '1': echo "数据库管理员";	break;
							case '2': echo "订单管理员"; 		break;
							case '3': echo "超级管理员";		break;
							default: break;
						}
					?>
				</td>
				<td>
					<?php 
						if($_COOKIE['username'] == $_html['username'])
							{	echo "自身"; }
						else if ($_html['state'] != 0)
						  	{	echo '[<a href="?id='.$_html['id'].'&action=lock">封号</a>] [<a>删除</a>]';}
						else 
							{	echo '[<a href="?id='.$_html['id'].'&action=unlock">已封号</a>] [<a>删除</a>]'; }
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