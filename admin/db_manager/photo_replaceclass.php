<?php
/**
* TestGuest Version1.0
* ================================================
* Copy 2014
* Web: http://www.yc60.com
* ================================================
* Author:zhangshuhui
* Date: 2014-6-16
*/
session_start();
define('IN_TG',true);
//定义一个常量，用来指定本页的内容
define('SCRIPT', 'index');
//引入公共文件
require dirname(__FILE__).'/../../includes/common.inc.php'; //转换成硬路径，速度更快
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>处理上传图片功能</title>
</head>
<body>
<?php 
//接受上传文件
//$_FILES
//存在，但是空值


//[userfile][name]表示上传的文件名
//[userfile][type]表示文件类型：例如，jpg的文件类型为：image/jpeg
//[userfile][tmp_name]表示上传的文件临时存放的位置C:\WINDOWS\Temp\php5E1.tmp
//[userfile][error]表示错误类型，0表示没有任何错误。
//[userfile][size]表示上传文件的大小

//创建一个常量
define('MAX_SIZE',2000000);
define('URL',dirname(__FILE__).'../../../\uploads');
$fileMimes = array('image/jpeg','image/pjpeg','image/png','image/x-png','image/gif');
include ROOT_PATH.'includes/check.func.php';

//判断类型是否是数组中的一种
 if(is_array($fileMimes)){
 	if(!in_array($_FILES['userfile']['type'], $fileMimes))
 	{
 		echo "<script>alert('本站只允许jpg、gif、png图片！');history.back();</script>";
 		exit;
 	}
 }

//if ($_FILES['userfile']['type'] != 'image/jpeg' && $_FILES['userfile']['type'] != 'image/pjpeg') {
//	//	echo "<script>alert('本站只允许jpg图片！');history.back();</script>";
//		exit;
//}

// 	switch ($_FILES['userfile']['type']) {
// 		case 'image/jpeg' :  //火狐
// 			break;
// 		case 'image/pjpeg' : //IE
// 			break;
// 		case 'image/gif' :
// 			break;
// 		case 'image/png' : //火狐
// 			break;
// 		case 'image/x-png' : //IE
// 			break;
// 		default: echo "<script>alert('本站只允许jpg、gif、png图片！');history.back();</script>";
// 		    exit;
// 	}
	

//如果上传错误
if ($_FILES['userfile']['error'] > 0) {
	switch ($_FILES['userfile']['error']) {
		case 1: echo "<script>alert('上传文件超过约定值1');history.back();</script>";
		break;
		case 2: echo "<script>alert('上传文件超过约定值2');history.back();</script>";
		break;
		case 3: echo "<script>alert('部分被上传');history.back();</script>";
		break;
		case 4: echo "<script>alert('没有任何文件被上传');history.back();</script>";
		break;
	}
	exit;
}

//判断配置大小
if ($_FILES['userfile']['size'] >MAX_SIZE)
{
	echo "<script> alert(上传文件不得超过2M);history.back();</script>";
	exit();
}
//判断目录是否存在
if(!is_dir(URL)){
	mkdir(URL,0777);		//最大权限0777
}

//is_uploaded_file()
//判断文件是否是通过 HTTP POST 上传的
//通过HTTP POST上传后，文件会存放在临时文件夹下
//获取文件的扩展名
$_n = explode('.', $_FILES['userfile']['name']);
$_name = time().'.'.$_n[1];
if(is_uploaded_file($_FILES['userfile']['tmp_name']))
{
	//move_uploaded_file()
	//将上传的文件移动到新位置
	if(!move_uploaded_file($_FILES['userfile']['tmp_name'],URL.'/'.$_name))
	{
		//如果移动失败
		echo "<script>alert('移动失败!');history.back();</script>";
		exit();
	}
}
else
{
	echo "<script>alert('临时文件夹下找不到上传文件！');history.back();</script>";
		exit();
}

//存入数据库
$_clean = array();
$_clean['id']=$_POST['id'];
$_clean['pic'] = _check_face($_name);
$_rows = _fetch_array("SELECT pic FROM tb_product WHERE id='{$_clean['id']}' LIMIT 1");
_query("UPDATE tb_product SET pic = '{$_clean['pic']}' WHERE id='{$_clean['id']}'");
if (_affected_rows() == 1)
					{
					_close();
					$_url = '../../uploads/'.$_rows['pic'];
					if(file_exists($_url)){
						unlink($_url);
					}
					_location('恭喜你，更改成功！','db_product_add.php');
}
else
	{
	_close();
	_location('很遗憾，更改失败！','db_product_add.php');
}


echo "<script>alert('文件上传成功');location.href='db_product_add?url=".$_FILES['userfile']['name']."';</script>";

?>
</body>
</html>