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
if(!isset($_GET['id'])) {
	_alert_back("非法操作");
				}
				
$_percent = 0.4;
$id=$_GET['id'];
$_result=_query("SELECT id,name,pic,variety,area,sort,standard,price,content,stock FROM tb_product WHERE id= '$id' LIMIT 1");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商品修改</title>
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
			<h2>商品修改</h2>
<?php 
	//获取数据
	$_rows=_fetch_array_list($_result);
	$_html = array();
	$_html['id'] = $_rows['id'];
	$_html['name'] = $_rows['name'];
	$_html['pic'] = $_rows['pic'];
	$_html['variety'] = $_rows['variety'];
	$_html['area'] = $_rows['area'];
	$_html['sort']=$_rows['sort'];
	$_html['standard']=$_rows['standard'];
	$_html['price']=$_rows['price'];
	$_html['content'] = $_rows['content'];
	$_html['stock'] = $_rows['stock'];
	$_html = _html($_html);	
?>
		<form enctype="multipart/form-data" action="photo_replaceclass.php" method="post">
		<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
			<dl class="photo_up">
				<input type="hidden" name="id" value=<?php echo $_html['id']?>> 
					<dt id="img">
						<?php 
							echo "<img src=../../thumb.php?filename=uploads/".$_html['pic']."&percent=".$_percent." />";
 						?>
					</dt>
					<dd><input type="file" name="userfile"  style = "width: 70px;" /></dd>
					<dd><input type="submit" value="确认修改" /></dd>
			</dl>
		</form>		
		<form action="modifyclass.php?action=modify" method="post">
			<input type="hidden" name="id" value=<?php echo $_html['id']?>> 
			<dl class="product_intro">	
				<dt>名称: <input type="text" name="title" value=<?php echo $_html['name']?> ></input></dt>
				<dt>类别：<select name="sort">
						<option value="0">果品</option>
						<option value="1">蔬菜</option>
						<option value="2">畜禽</option>
						<option value="3">花卉</option>
						<option value="4">水产</option>
						<option value="5">其它</option>
					</select>
				</dt>
				<dd class="product_count">品种：<input type="text" name="variety" value = <?php echo $_html['sort']?>></input></dd>
				<dd class="product_count">数量: <input type="text" name="stock" value = <?php echo $_html['stock']?> size="3"></input></dd>
				<dd class="product_mater">规格: <input type="text" name="standard" value = <?php echo $_html['standard']?> ></input></dd>
				<dd class="product_mater">价格: <input type="text" name="price" value = <?php echo $_html['price']?> size="3"></input></dd>
				<dd class="product_time">上市时间：<input type="text" name="year" size="3" /> 年 <input type="text" name="month" size="2" /> 月 <input type="text" name="day" size="2"/> 日 </dd>
				<dd class="product_sea">产地：<textarea name="area" rows="2" cols="46" value = <?php echo $_html['area'] ?>></textarea></dd>
			</dl>
			<dl class="method">
				<dt>商品详情：</dt>
				<dd><textarea name="content" rows="8" cols="80"><?php echo $_html['content']?></textarea></dd>
				<dd><input type="submit" value="修改" /></dd>
			</dl>
		</form>
			
				</div>
	</div>
<?php 
	require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>