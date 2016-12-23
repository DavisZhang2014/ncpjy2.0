<?php
/**
* TestGuest Version1.0
* ================================================
* Copy 2014
* Web: http://www.yc60.com
* ================================================
* Author:zhangshuhui
* Date: 2014-6-18
*/
define('IN_TG',true);
//定义一个常量，用来指定本页的内容
define('SCRIPT', 'comment_detail');
//引入公共文件
require dirname(__FILE__).'/../../includes/common.inc.php'; //转换成硬路径，速度更快
$_percent = 0.8;
$_id=$_GET['id'];
$_result=_query("SELECT * FROM tb_product WHERE id= '$_id' LIMIT 1");
$_result2 = _query("SELECT id,order_id,product_id,username,content,date_time FROM tb_comment WHERE product_id='$_id'");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>商品详情</title>
<?php 
	require ROOT_PATH.'includes/db_title.inc.php';
?>
<script src="../../js/jquery-2.1.1.js"></script>
<script src="../../js/product_detail.js"></script>
</head>
<body>
<?php 
	require ROOT_PATH.'includes/db_header.inc.php';
?>
<div id="member">
<?php 
			require ROOT_PATH.'includes/orders_manager.inc.php';
?>
<?php 
	$_rows=_fetch_array_list($_result);
	$_html = array();
	$_html['id'] = $_rows['id'];
	$_html['name'] = $_rows['name'];
	$_html['pic'] = $_rows['pic'];
	$_html['material']=$_rows['material'];
	$_html['seasoning']=$_rows['seasoning'];
	$_html['content'] = $_rows['content'];
	$_html['price'] = $_rows['price'];
	$_html = _html($_html);	
?>
	<div id="product_detail_up">
		<div id="product_detail_left">
			<td><img src="../../thumb.php?filename=<?php echo 'uploads/'.$_html['pic']?>&percent=<?php echo $_percent?>" /></td>
		</div>
		
		<div id="product_detail_right">
				<h2><?php echo $_html['name']?></h2>
				<dl><strong>价格:</strong><?php echo $_html['price']?>元</dl>
				<p class="line"></p>
				<dl><strong>用料:</strong><?php echo $_html['material']?></dl>
				<p class="line"></p>
				<dl><strong>调料:</strong><?php echo $_html['seasoning']?></dl>
		</div>
	</div>
	<div id="product_detail_bottom">
		<div id="cooking">
			<dl>
				<dt><strong class="cooking">做法</strong><strong class="comment" >评价</strong></dt>
				<p class="line"></p>
				<dd><?php echo _wrap($_html['content'])?></dd>
			</dl>
		</div>
		<div id="comment">
			<dl>
				<dt><strong class="cooking">做法</strong><strong class="comment" >评价</strong></dt>
			</dl>
			<p class="line"></p>		
				<?php 
					while (!!$_rows2 = _fetch_array_list($_result2)){
						$_html2 = array();
						$_html2['id'] = $_rows2['id'];
						$_html2['order_id'] = $_rows2['order_id'];
						$_html2['product_id'] = $_rows2['product_id'];
						$_html2['username'] = $_rows2['username'];
						$_html2['content'] = $_rows2['content'];
						$_html2['date_time'] = $_rows2['date_time'];
						$_html2=_html($_html2);
				?>
				<div id="com_detail">
					<span>回复</span>
					<dl class="con"><?php echo $_html2['content']?></dl>
					<dl class="username"><?php echo $_html2['username']?></dl>
					<dl class="time"><?php echo $_html2['date_time']?></dl>
					<div class="reply">
						<form method="post" action="comment_sub.php?action=sub&to_comment_id=<?php echo $_html2['id']?>">
							<input type="hidden" name="username" value="<?php echo $_html2['username']?>"/>
							<textarea name="content"cols="60" rows="4"></textarea>
							<input type="submit" style="width:50px;height:25px" value="回复"></input>
						</form>
					</div>
				</div>
				<p class="line"></p>
	

				<?php 
					}
				?>
		</div>
	</div>
</div>
<?php
require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>