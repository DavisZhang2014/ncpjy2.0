<?php 

if (!defined('IN_DS'))  die('Hacking attempt');

class CommonController{
	static public $Ctrl;
	static public $Action;
	static public $dataArr;

	function display(){

		global $route;
		$tpl_file = self::$Action . '.html';
		$tpl = new TemplateSmarty(APP,self::$Ctrl);
		if(!empty(self::$dataArr)){
			foreach (self::$dataArr as $value) {
				if(!empty($value)){
					foreach ($value as $key => $sub_value) {
						$tpl->assign($key,$sub_value);
					}
				}
			}
		}
		$menu = $this->get_menu();
		foreach ($menu as $key => $value) {
			if($value['Code'] == self::$Ctrl){
				$menu[$key]['selected']='yes';
			}else{
				$menu[$key]['selected']='no';
			}
		}
		
		$tpl->assign('menu',$menu);
		$tpl->assign('__ROOT__',__ROOT__);
		$tpl->assign('__APP__','/index.php');
		$tpl->assign('__MODEL__','/index.php/'.self::$Ctrl);
		$tpl->display($tpl_file);
	}
	
	function assign($value,$data){
		self::$dataArr[][$value] = $data; 
	}

	function get_menu(){
		$DB = DBlink();
		$sql = "SELECT ID,DisplayName,Code FROM tb_node WHERE `Status` = 'active' ";
		return $DB->getRows($sql);
	}

	function _post($name,$default="",$toEncoding=""){
		$sPost = isset($_POST["$name"])?$_POST["$name"]:"";
		if (get_magic_quotes_gpc()) 
			$sPost = stripslashes($sPost);
		if($sPost === "") return $default;
		if($toEncoding != "") $sPost = iconv("UTF-8",$toEncoding,$sPost);
		return $sPost;
	}

	function _request($name,$default="",$toEncoding=""){
		$sReturn = isset($_REQUEST["$name"])?$_REQUEST["$name"]:"";
		if (get_magic_quotes_gpc()) 
			$sReturn = stripslashes($sReturn);
		if($sReturn === "") return $default;
		if($toEncoding != "") $sReturn = iconv("UTF-8",$toEncoding,$sReturn);
		return $sReturn;
	}

	function _get($name,$default="",$toEncoding=""){
		$sGet = isset($_GET["$name"])?$_GET["$name"]:"";
		if (get_magic_quotes_gpc()) 
			$sGet = stripslashes($sGet);
		if($sGet === "") return $default;
		if($toEncoding != "") $sGet = iconv("UTF-8",$toEncoding,$sGet);
		return $sGet;
	}

	function success($message='',$jumpUrl=''){
		$jumpUrl ='/index.php/'.$jumpUrl;
		$this->dispatchJump($message,1,$jumpUrl);
	}

	function error($message=''){
		echo "<script language = 'javascript' type = 'text/javascript'> alert('$message');window.history.go(-1);</script >  ";  
	}

	function dispatchJump($message,$tatus=1,$jumpUrl){ 
		echo "<script language = 'javascript' type = 'text/javascript'> alert('$message');window.location.href = '$jumpUrl'</script >  ";  
	}


}