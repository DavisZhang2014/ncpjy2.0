
<?php
/**
* TestGuest Version1.0
* ================================================
* Copy 2014
* Web: http://www.yc60.com
* ================================================
* Author:zhangshuhui
* Date: 2014-5-20
*/
header('Content-Type:text/html; charset=utf-8');
//防止恶意调用
if(!defined('IN_TG'))
{
	exit('非法访问！');	
}


//转换硬路径常量
define('ROOT_PATH',substr(dirname(__FILE__),0,-8));

//创建一个自动转义状态的常量
define('GPC', get_magic_quotes_gpc());

//拒绝PHP低版本
if(PHP_VERSION<'4.0.1')
{
	exit ('PHP版本太低');
}
//引用核心函数库
require ROOT_PATH.'includes/global.func.php';
require ROOT_PATH.'includes/mysql.func.php';
//执行耗时'
define('START_TIME', _runtime());

//数据库连接
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PWD', 'root');
define('DB_NAME', 'db_product');
//初始化数据库
_connect();		//连接MYSQL数据库
_select_db();	//选择一款数据库
_set_names();	//设置字符集
?>