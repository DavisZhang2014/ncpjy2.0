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
define('SCRIPT', 'db_product_add');
//引入公共文件
require dirname(__FILE__).'/../../includes/common.inc.php';
//引入验证文件
include ROOT_PATH.'includes/check.func.php';
//是否正常登录
if(!isset($_COOKIE['username'])){
	_alert_back('非法登录');
}

//必须是数据库管理员
// 	if (!$_SESSION['db_manager']){
// 		_alert_back('您必须是数据库管理员');
// 	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商品添加</title>
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
			require ROOT_PATH.'includes/db_manager.inc.php';
		?>
		<div id="product_add">
			<h2>商品添加</h2>
					
			<form enctype="multipart/form-data" action="uploadclass.php" method="post">
				<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
				<dl class="photo_up">
					<dt>
						<?php 
								echo "<img src='../../images/tjtp.jpg' />";
	 					?>

					</dt>
					<dd><input type="file" name="userfile"  style = "width: 70px;" /></dd>
				</dl>
				<dl class="product_intro">	
					<dt>名称: <input type="text" name="title"  ></input></dt>
					<dt>类别：<select name="sort">
								<option value="0">果品</option>
								<option value="1">蔬菜</option>
								<option value="2">畜禽</option>
								<option value="3">花卉</option>
								<option value="4">水产</option>
								<option value="5">其它</option>
							</select>
					</dt>
					<dd class="product_count">品种：<input type="text" name="variety" ></input></dd>
					<dd class="product_count">数量: <input type="text" name="count" value="0" size="3"></input></dd>
					<dd class="product_mater">规格: <input type="text" name="standard" ></input></dd>
					<dd class="product_mater">价格: <input type="text" name="price" value="0" size="3"></input></dd>
					<dd class="product_time">上市时间：<input type="text" name="year" size="3" /> 年 <input type="text" name="month" size="2" /> 月 <input type="text" name="day" size="2"/> 日 </dd>
					<dd class="product_sea">产地：<textarea name="area" rows="2" cols="46" ></textarea></dd>
				</dl>
				<dl class="method">
					<dt>详情：</dt>
					<dd><textarea name="content" rows="8" cols="80"></textarea></dd>
					<dd><input type="submit" value="添加" /></dd>
				</dl>
			</form>
		</div>
	</div>
<?php 
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>