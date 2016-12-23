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
session_start();
//定义个常量，用来授权调用includes里面的文件
define('IN_TG',true);
//定义一个常量，用来指定本页的内容
define('SCRIPT', 'productstuff');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php'; //转换成硬路径，速度更快
global $_pagesize,$_pagenum;
//list中图片放缩比例
$_percent = 0.7;
$_sortid=$_GET['sort'];
_page("SELECT id FROM tb_product WHERE sort='$_sortid'",6);   //第一个参数获取总条数，第二个参数，指定每页多少条
$_result=_query("SELECT id,name,pic,price FROM tb_product WHERE sort='$_sortid'");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
<?php 
	switch ($_sortid)
	{
		case 0: echo "果品";
			break;
		case 1: echo "蔬菜";
			break;
		case 2: echo "畜禽";
			break;
		case 3: echo "水产";
			break;
		case 4: echo "花卉";
			break;
		default: echo "其它";
			break;
	}
?>
</title>
<?php 
	require ROOT_PATH.'/includes/title.inc.php';
?>
</head>
<body>
<?php 
	require ROOT_PATH.'/includes/header.inc.php';
?>
<div id="subject">
	<?php 
 		while (!!$_rows = _fetch_array_list($_result)) {
 			$_html = array();
 			$_html['id'] = $_rows['id'];
 			$_html['name'] = $_rows['name'];
 			$_html['pic'] = $_rows['pic'];
 			$_html['price'] = $_rows['price'];
 			$_html = _html($_html);
 			
	?>
	<div id="list">
		<dl>
			<dt><a href="product_detail.php?id=<?php echo $_html['id']?>"><img src="thumb.php?filename=<?php echo 'uploads/'.$_html['pic']?>&percent=<?php echo $_percent?>" alt="<?php echo $_html['name']?>" /></a></dt>
			<dd><?php echo $_html['name']?></dd>
			<dd class="price">￥<?php echo $_html['price']?></dd>
		</dl>
	</div>
<?php 
}
?>
</div>
<?php
require ROOT_PATH.'/includes/footer.inc.php';
?>
</body>
</html>