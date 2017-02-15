<?php 
/*
 *
*/
if (!defined('IN_DS'))  die('Hacking attempt');
class Admin{
	public static $classMap = array();
	
	static public function run(){
		
		$route = new Route();
		//引用公共控制器
		$CommonCtrlFile =  __ROOT__ . 'Action/CommonController.class.php';
		if(is_file($CommonCtrlFile)){
			include_once $CommonCtrlFile;
			$CtrlClass = isset($route->ctrl)?$route->ctrl.'Controller':'IndexController';
			$Action = isset($route->action)?$route->action:'index';
			$file = __ROOT__ . 'Action/' . $CtrlClass .'.class.php';
			
			if(is_file($file)){
				include $file;
				//实现控制器和方法的传递
				CommonController::$Ctrl = isset($route->ctrl)?$route->ctrl:'Index';
				CommonController::$Action = $Action;
				$Ctrl = new $CtrlClass();
				
				$Ctrl->$Action();
			}else{
				throw new \Exception('找不到控制器 '.$CtrlClass);
			}
		}
		
	} 

	static public function load($class){
		//自动加载类
		if(isset($classMap[$class])){
			return true;
		}else{ //优先加载Admin/lib下类库
			$file = __ROOT__ .'lib/Class.'. $class . '.php';

			if(is_file($file)){
				include $file;
				self::$classMap[$class] = $class;
			}else{ //Admin/lib下找不到改类，就自动去ROOT目录下去查找
				$file = FINAL_ROOT . 'lib/Class.' . $class . '.php';
				if(is_file($file)){
					include $file;
					self::$classMap[$class] = $class;
				}else{
					return false;
				}
			}
		}
	}




}
