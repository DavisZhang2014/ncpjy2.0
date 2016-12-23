<?php
/**
* TestGuest Version1.0
* ================================================
* Copy 2014
* Web: http://www.yc60.com
* ================================================
* Author:zhangshuhui
* Date: 2014-10-1
*/
session_start();
define('IN_TG',true);
//引入公共文件
//定义一个常量，用来指定本页的内容
define('SCRIPT', 'db_product_list');
//引入公共文件
require dirname(__FILE__).'/../../includes/common.inc.php';

if ($_GET['action'] == 'delete' && isset($_GET['id'])){
	if (!!$_rows = _fetch_array("SELECT 
										uniqid
								FROM 
										tb_admin
					 			WHERE 
										username='{$_COOKIE['username']}' 
							 	LIMIT 	
										1"
	)){
		_uniqid($_rows['uniqid'],$_COOKIE['uniqid']);
		//取得图片存储位置
		if (!!$_rows = _fetch_array("SELECT
												pic,
												sort
										FROM
												tb_product
										WHERE
												id='{$_GET['id']}'
										LIMIT
												1"
		)){
			$_url = '../../uploads/'.$_rows['pic'];
			//首先删除图片的数据库信息
			_query("DELETE FROM tb_product WHERE id='{$_GET['id']}'");
			if(_affected_rows() == 1){
				//删除图片的物理地址
				if(file_exists($_url)){
					unlink($_url);
				}
				else {
					_alert_back('磁盘里已不存在此图！');
				}
				_close();
				_location('图片删除成功！','db_product_list.php?sort='.$_rows['sort']);
			}else {
				_alert_back("删除失败");
			}
		}else{
			_alert_back("不存在该商品图片");
		}
		
	}else{
		_alert_back("非法登录");
	}
}
else{
	_alert_back("非法访问");
}
?>