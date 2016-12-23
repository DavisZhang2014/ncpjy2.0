<?php
/**
* TestGuest Version1.0
* ================================================
* Copy 2014
* Web: http://www.yc60.com
* ================================================
* Author:zhangshuhui
* Date: 2014-6-27
*/
session_start();
define('IN_TG',true);
//引入公共文件
//定义一个常量，用来指定本页的内容
define('SCRIPT', 'db_dump');
//引入公共文件
require dirname(__FILE__).'/../../includes/common.inc.php';
//引入验证文件
include ROOT_PATH.'includes/check.func.php';
//是否正常登录
if(!isset($_COOKIE['username'])){
	_alert_back('非法登录');
}
if ($_GET['action']=='backup'){
	header("Content-type:text/html;charset=utf-8");
	
	//配置信息
	$cfg_dbhost = 'localhost';
	$cfg_dbname = 'db_product';
	$cfg_dbuser = 'root';
	$cfg_dbpwd = 'root';
	$cfg_db_language = 'utf8';
	$to_file_name = $cfg_dbname.'_'.date("Ymd_His").".sql";
	// END 配置

	//链接数据库
	$link = mysql_connect($cfg_dbhost,$cfg_dbuser,$cfg_dbpwd);
	mysql_select_db($cfg_dbname);
	//选择编码
	mysql_query("set names ".$cfg_db_language);
	//数据库中有哪些表
	$tables = mysql_list_tables($cfg_dbname);
	//将这些表记录到一个数组
	$tabList = array();
	while($row = mysql_fetch_row($tables)){
		$tabList[] = $row[0];
	}
	
	echo "运行中，请耐心等待...<br/>";
	$info .= "-- 日期：".date("Y-m-d H:i:s",time())."\r\n";
	file_put_contents($to_file_name,$info,FILE_APPEND);

	//将每个表的表结构导出到文件
	foreach($tabList as $val){
		$sql = "show create table ".$val;
		$res = mysql_query($sql,$link);
		$row = mysql_fetch_array($res);
		$info = "-- ----------------------------\r\n";
		$info .= "-- Table structure for `".$val."`\r\n";
		$info .= "-- ----------------------------\r\n";
		$info .= "DROP TABLE IF EXISTS `".$val."`;\r\n";
		$sqlStr = $info.$row[1].";\r\n\r\n";
		//追加到文件
		file_put_contents($to_file_name,$sqlStr,FILE_APPEND);
		//释放资源
		mysql_free_result($res);
	}

	//将每个表的数据导出到文件
	foreach($tabList as $val){
		$sql = "select * from ".$val;
		$res = mysql_query($sql,$link);
		//如果表中没有数据，则继续下一张表
		if(mysql_num_rows($res)<1) continue;
		//
		$info = "-- ----------------------------\r\n";
		$info .= "-- Records for `".$val."`\r\n";
		$info .= "-- ----------------------------\r\n";
		file_put_contents($to_file_name,$info,FILE_APPEND);
		//读取数据
		while($row = mysql_fetch_row($res)){
			$sqlStr = "INSERT INTO `".$val."` VALUES (";
			foreach($row as $zd){
				$sqlStr .= "'".$zd."', ";
			}
			//去掉最后一个逗号和空格
			$sqlStr = substr($sqlStr,0,strlen($sqlStr)-2);
			$sqlStr .= ");\r\n";
			file_put_contents($to_file_name,$sqlStr,FILE_APPEND);
		}
		//释放资源
		mysql_free_result($res);
		file_put_contents($to_file_name,"\r\n",FILE_APPEND);
	}
	
	_location("备份成功", 'backup.php');

	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>数据库备份</title>

<?php
	require ROOT_PATH.'includes/db_title.inc.php';
?>

<style type="text/css">
	#member #dump{
		border:1px solid #999;
		width:750px;
		height:500px;
		margin:9px;
		float:right;
		background:#eee;
	}
	#member #dump dl{
		margin:20px;
		border:1px solid #ccc;
	}
	#member #dump dt{
		margin:20px;
		font-size:12pt;
	}
	#member #dump dd{
		margin:20px 80px;
		font-size:11pt;
	}
	#member #dump dl.bt{
		width:80px;
		margin:50px auto;
	}
</style>
</head>
<body>
<?php 
	require ROOT_PATH.'includes/db_header.inc.php';
?>
	<div id="member">
		<?php 
			require ROOT_PATH.'includes/super_manager.inc.php';
		?>
		<div id="dump">
			<h2>数据库备份</h2>
			<dl>
				<dt>备份方式:<dt>
				<dd>备份全部数据 		(*将全部数据备份到一个数据库文件中)</dd>
			</dl>
			<dl>
				<dt>存储位置:</dt>
				<dd><?php echo dirname(__FILE__);?></dd>
			</dl>
			 	<dl class="bt"><a href="?action=backup"><button style="width:80px;height:40px">备份</button></a></dl>
		</div>
	</div>
<?php 
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>