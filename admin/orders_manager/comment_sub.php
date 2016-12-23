<?php
/**
* TestGuest Version1.0
* ================================================
* Copy 2014
* Web: http://www.yc60.com
* ================================================
* Author:zhangshuhui
* Date: 2014-10-12
*/
session_start();
define('IN_TG',true);
//定义一个常量，用来指定本页的内容
define('SCRIPT', 'deliver');
//引入公共文件
require dirname(__FILE__).'/../../includes/common.inc.php'; //转换成硬路径，速度更快
if($_GET['action'] == 'sub' && isset($_GET['to_comment_id'])){
	$_clean = array();
	$_clean['to_comment_id'] = $_GET['to_comment_id'];
	$_clean['username'] = $_COOKIE['username'];
	$_clean['content'] = $_POST['content'];
	//更改订单数据库，将处理状态设为已处理
	_query("INSERT INTO tb_reply
						(
							to_comment_id,
							username,
							degree,
							content,
							date_time
					)VALUES(
							'{$_clean['to_comment_id']}',
							'{$_clean['username']}',
							1,
							'{$_clean['content']}',
							NOW()
					)");
	if(_affected_rows() ==1){
		if (!!$_row=_fetch_array("SELECT id FROM tb_comment WHERE state = 0 AND id='{$_clean['to_comment_id_id']}'")){
			_query("UPDATE tb_comment SET state=1 WHERE id='{$_clean['to_comment_id_id']}'");
			if(_affected_rows() ==1){
			_close();
			_alert_back("回复成功");
			}else{
				_close();
				_alert_back("状态更改失败");
			}
		}else{
			_close();
			_alert_back("回复成功");
		}
	}else{
		_close();
		_alert_back("回复失败");
	}
	
}else{
	_alert_back("非法操作");
}
?>