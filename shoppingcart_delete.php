<?php
/**
* TestGuest Version1.0
* ================================================
* Copy 2014
* Web: http://www.yc60.com
* ================================================
* Author:zhangshuhui
* Date: 2014-9-18
*/
//清空购物车
session_start();
//定义个常量，用来授权调用includes里面的文件
define('IN_TG',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','member_message');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
if(!!isset($_GET['username'])){
	//危险操作，为了防止cookies伪造，还要比对一下唯一标识符uniqid()
	if (!!$_rows = _fetch_array("SELECT
										uniqid
									FROM
										tb_user
									WHERE
										username='{$_COOKIE['username']}'
									LIMIT
									1"
						)) {
			_uniqid($_rows['uniqid'],$_COOKIE['uniqid']);
			_query("DELETE	FROM
								tb_shoppingcart
							WHERE	
								username='{$_GET['username']}'			
							");
			if (_affected_rows())
			{
				_close();
				_location('购物车已清空','index.php');
			}
			else
			{
				_close();
				_alert_back('清空购物车失败');
				}
			}
	
}
?>