<?php 

Class Route{
	public $ctrl;
	public $action;
	public function __construct(){
		/**
		 * 1
		 * 2.获取URL参数部分
		 * 3.返回对应的参数和方法
		 */
		
		if(!empty($_SERVER['PATH_INFO'])){
			$pathInfo = $_SERVER['PATH_INFO'];
			$pathArr = explode('/', trim($pathInfo,'/'));
			//获取控制器和方法
			if(isset($pathArr[0])){
				$this->ctrl = $pathArr[0];
			}
			unset($pathArr[0]);
			if(isset($pathArr[1])){
				$this->action = $pathArr[1];
				unset($pathArr[1]);
			}else{
				$this->action = 'index';
			}
			
			//URL多余部分转成GET参数
			$count = count($pathArr) + 2 ;
			$i = 2;
			while($i < $count){
				if(isset($pathArr[$i + 1])){
					$_GET[$pathArr[$i]] = $pathArr[$i + 1];
				}
				$i = $i+2;
			}
		}else{
			$this->ctrl = 'Public';
			$this->action = 'index';
		}
	}
}