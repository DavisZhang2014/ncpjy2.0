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
/**
 * _runtime()是用来获取执行耗时
 * @access public 表示函数对外公开
 * @return float 表示返回出来的是一个浮点型数字
 * */

function _runtime()
{
	$_mtime =explode(' ', microtime());
	return $_mtime[1]+$_mtime[0];
}
/**
 * _alert_back()表是JS弹窗
 * @access public
 * @param $_info
 * @return void 弹窗
 */
function _alert_back($_info)
{
	echo "<script type='text/javascript'>alert('$_info');history.back();</script>";
	exit();
}
function _alert_goback($_info)
{
	echo "<script type='text/javascript'>alert('$_info');history.go(-1);</script>";
	exit();
}

function _alert_close($_info)
{
	echo "<script type='text/javascript'>alert('$_info');window.close();</script>";
	exit();
}

function _location($_info,$_url)
{
	if (!empty($_info))
	{
		echo "<script type='text/javascript'>alert('$_info');location.href='$_url';</script>";
		exit();
	}
	else 
	{
		header('Location:'.$_url);
	}
}
/**
 * _login_state登录状态的判断
 */
function _login_state() 
{
	if (isset($_COOKIE['username'])) 
	{
		_alert_back('登录状态无法进行本操作！');
	}
}

/**
 * 判断唯一标识符是否异常
 * @param $_mysql_uniqid
 * @param $_cookie_uniqid
 */

function _uniqid($_mysql_uniqid,$_cookie_uniqid) {
	if ($_mysql_uniqid != $_cookie_uniqid) {
		_alert_back('唯一标识符异常！');
	}
}
/*
 * 原比例调整图像大小
 */
function _thumb($_filename,$_percent) {
	//生成png标头文件
	header('Content-type: image/png');
	$_n = explode('.',$_filename);
	//获取文件信息，长和高
	list($_width, $_height) = getimagesize($_filename);
	//生成缩微的长和高
	$_new_width = $_width * $_percent;
	$_new_height = $_height * $_percent;
	//创建一个以0.3百分比新长度的画布
	$_new_image = imagecreatetruecolor($_new_width,$_new_height);
	//按照已有的图片创建一个画布
	switch ($_n[1]) {
		case 'jpg' : $_image = imagecreatefromjpeg($_filename);
		break;
		case 'png' : $_image = imagecreatefrompng($_filename);
		break;
		case 'gif' : $_image = imagecreatefrompng($_filename);
		break;
	}
	//将原图采集后重新复制到新图上，就缩略了
	imagecopyresampled($_new_image, $_image, 0, 0, 0, 0, $_new_width,$_new_height, $_width, $_height);
	imagepng($_new_image);
	imagedestroy($_new_image);
	imagedestroy($_image);
}

function _change($_filename,$_per_w,$_per_h) {
	//生成png标头文件
	header('Content-type: image/png');
	$_n = explode('.',$_filename);
	//获取文件信息，长和高
	list($_width, $_height) = getimagesize($_filename);
	//生成缩微的长和高
	$_new_width = $_width * $_per_w;
	$_new_height = $_height * $_per_h;
	//创建一个以0.3百分比新长度的画布
	$_new_image = imagecreatetruecolor($_new_width,$_new_height);
	//按照已有的图片创建一个画布
	switch ($_n[1]) {
		case 'jpg' : $_image = imagecreatefromjpeg($_filename);
		break;
		case 'png' : $_image = imagecreatefrompng($_filename);
		break;
		case 'gif' : $_image = imagecreatefrompng($_filename);
		break;
	}
	//将原图采集后重新复制到新图上，就缩略了
	imagecopyresampled($_new_image, $_image, 0, 0, 0, 0, $_new_width,$_new_height, $_width, $_height);
	imagepng($_new_image);
	imagedestroy($_new_image);
	imagedestroy($_image);
}

/**
 * _title()标题截取函数
 * @param unknown $_string
 * @return string
 */

function _title($_string){
	if(mb_strlen($_string,'utf-8')>14)
	{
		$_string = mb_substr($_string,1,14,'utf-8').'...';
	}
	return $_string;
}

/**
 * _html() 函数表示对字符串进行HTML过滤显示，如果是数组按数组的方式过滤，
 * 如果是单独的字符串，那么就按单独的字符串过滤
 * @param unknown_type $_string
 */
function _html($_string)
{
	if (is_array($_string)) {
		foreach ($_string as $_key => $_value) {
			$_string[$_key] = _html($_value);   //这里采用了递归，如果不理解，那么还是用htmlspecialchars
		}
	} else {
		$_string = htmlspecialchars($_string);
	}
	return $_string;
}


function _page($_sql,$_size)
{
	global $_page,$_pagesize,$_pagenum,$_pageabsolute,$_num;
	if(isset($_GET['page']))
	{
		$_page = $_GET['page'];
		if(empty($_page) || $_page <0 || !is_numeric($_page))
		{
			$_page=1;
		}
		else
		{
			$_page = intval($_page);			//intval取整
		}
	}
	else
	{
		$_page = 1;
	}
	$_pagesize = $_size;
	//首页要得到所有的数据总和
	$_num = _num_rows(_query($_sql));
	
	
	if($_num ==0)
	{
		$_pageabsolute= 1;
	}
	else
	{
		$_pageabsolute = ceil($_num / $_pagesize);
	}
	//如果分页大于总页数
	if ($_page > $_pageabsolute)
	{
		$_page = $_pageabsolute;
	}
	$_pagenum = ($_page - 1) * $_pagesize;
}


/**
 * _pacing分页函数
 * @param unknown $_type
 * @return 返回分页
 */
function _paging($_type)
{
	global $_page,$_pageabsolute,$_num,$_id;
	if($_type == 1)
	{
		echo '<div id="page_num">';
		echo '<ul>';
	 for ($i=0;$i<$_pageabsolute;$i++)
		{
		if ($_page == ($i+1))
		{
		echo '<li><a href="'.SCRIPT.'.php?'.$_id.'page='.($i+1).'"class="selected">'.($i+1).'</a></li>';
				}
				else
		{
		echo '<li><a href="'.SCRIPT.'.php?'.$_id.'page='.($i+1).'">'.($i+1).'</a></li>';
		}
		}
		echo '</ul>';
			echo '</div>';
	}
	elseif ($_type == 2)
	{
		echo '<div id="page_text">';
		echo '<ul>';
		echo '<li>'.$_page.'/'.$_pageabsolute.'页 |</li>';
		echo	'<li>共有<strong>'.$_num.'</strong>条数据 |</li>'; 
						if($_page == 1)
						{
							echo '<li>首页 |</li>';
							echo '<li>上一页 |</li>';
						}
						else 
						{
							echo '<li><a href="'.SCRIPT.'.php">首页</a> |</li>';
							echo '<li><a href="'.SCRIPT.'.php?'.$_id.'page='.($_page-1).'">上一页</a> |</li>';
						}
						if($_page == $_pageabsolute)
						{
							echo '<li>下一页 | </li>';
							echo '<li>尾页</li>';
						}
						else
						{
							echo '<li><a href="'.SCRIPT.'.php?'.$_id.'page='.($_page+1).'">下一页</a> | </li>';
							echo '<li><a href="'.SCRIPT.'.php?'.$_id.'page='.$_pageabsolute.'">尾页</a></li>';
						}
			echo '</ul>';
			echo '</div>';
	}
	elseif($_type == 3){
		echo "<div class='f_btn' id='left_btn' ></div>";
		echo "<div class='f_btn' id='right_btn'></div>";
	}
}

/**
 * _session_destroy删除session
 */
function _session_destroy() {
	if(session_start()){
	session_destroy();
	}
}

/**
 * 删除cookies   _unsetcookies()
 */
function _unsetcookies() {
	setcookie('username','',time()-1);
	setcookie('uniqid','',time()-1);
	_session_destroy();
	_location(null,'index.php');
}

/**
 * 
 * @return Ambigous <string, string>
 */
function _sha1_uniqid() 
{
	return _mysql_string(sha1(uniqid(rand(),true)));
}

/**
 * _mysql_string
 * @param string $_string
 * @return string
 */
function _mysql_string($_string)
{
	//get_magic_quotes_gpc()如果开启状态，那么就不需要转移
	if(!GPC)
	{
		if(is_array($_string))
		{
			foreach ($_string as $_key => $_value)
			{
				$_string[$_key] = _mysql_string($_value);
			}
		}
		else 
		{
		 	mysql_real_escape_string($_string);
		}
	}
	return $_string;

}

/**
 * _check_code
 * @param string $_first_code
 * @param string $_end_code
 * @return void 验证码比对
 */
function _check_code($_first_code,$_end_code)
{
	if($_first_code!=$_end_code)
	{
		_alert_back('验证码不正确!');
	}
}

/**
 * _code()是验证码函数
 * @access public 
 * @param int $_width 表示验证码的长度
 * @param int $_height 表示验证码的高度
 * @param int $_rnd_code 表示验证码的位数
 * @param bool $_flag 表示验证码是否需要边框 
 * @return void 这个函数执行后产生一个验证码
 */
function _code($_width=75,$_height = 25,$_rnd_code = 4,$_flag = false){

	//创建随机码
	for($i=0;$i<$_rnd_code;$i++)
	{
		@$_nmsg.= dechex(mt_rand(0,15));
	}
	//保存在session里
	$_SESSION['code'] = $_nmsg;


	
	//创建一张图像
	$_img = imagecreatetruecolor($_width,$_height);
	//白色
	$_white = imagecolorallocate($_img,255,255,255);
	//填充
	imagefill($_img,0,0,$_white);

	if($_flag){
		//创建黑色的边框
		$_black = imagecolorallocate($_img,0,0,0);
		imagerectangle($_img,0,0,$_width-1,$_height-1,$_black);
	}
	//随机画出6个线条
	for($i=0;$i<6;$i++)
	{
		$_rnd_color = imagecolorallocate($_img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
		imageline($_img,mt_rand(0,$_width),mt_rand(0,$_height),mt_rand(0,$_width),mt_rand(0,$_height),$_rnd_color);
	}
	//随机雪花
	for($i=0;$i<100;$i++)
	{
		$_rnd_color = imagecolorallocate($_img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
		imagestring($_img,1,mt_rand(1,$_width),mt_rand(1,$_height),'*',$_rnd_color);
	}

	//输出验证码

	for($i=0;$i<strlen($_SESSION['code']);$i++)
	{
		$_rnd_color = imagecolorallocate($_img,mt_rand(0,100),mt_rand(0,150),mt_rand(0,200));
		imagestring($_img,5,$i*$_width/$_rnd_code+mt_rand(1,10),mt_rand(1,$_height/2),$_SESSION['code'][$i],$_rnd_color);
	}

	//输出图像
	header('Content-Type: image/png');
	imagepng($_img);

	//销毁
	imagedestroy($_img);
}
/*
 * 字符串自动分段函数
 */
function _wrap($_text){
	$_wrapped="";
	$_paragraphs = explode("\n",$_text);
	foreach($_paragraphs as $_paragraph){
		$_wrapped .="<p>$_paragraph</p>";
	}
	return $_wrapped;
}
/*
 * _build_order_no()生成订单号
 * 用uniqid获取一个基于当前的微秒数生成的唯一不重复的字符串（但是他的前7位貌似很久才会发生变动，所以不用考虑可删除），取其第8到13位。
 * 用ord获取字符串中英文字母的ASCII码。
 * 所以就有了下一步：用str_split把这个字符串分割为数组，用array_map去操作（速度快点）。
 * 然后返回的还是一个数组，在用implode弄成字符串，但是字符长度不定，取前固定的几位，然后前面加上当前的年份和日期。
 * 这个方法生成的订单号，全世界不会有多少重复的。
 */

function _build_order_no(){
	return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
}

?>