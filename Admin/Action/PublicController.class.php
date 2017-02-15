<?php 

class PublicController extends CommonController{
	
	function index(){
		
		$this->display();
	}

	function login(){
		global $NowTime;
		$DB = DBlink();
		$UserName = addslashes(trim($this->_post('UserName')));
		$PassWord = addslashes(md5(trim($this->_post('PassWord'))));
		
		if(!empty($UserName) && !empty($PassWord)){
			$sql = "SELECT ID FROM tb_admin WHERE UserName = '{$UserName}' AND PassWord = '{$PassWord}' AND `Status`='Active' limit 1";

			$user = $DB->getRows($sql);
			if(!empty($user[0]['ID'])){
				Cookie::set('UserName',$UserName);
				$sql = "UPDATE tb_admin SET LastUpdateTime = '$NowTime' WHERE ID = {$user[0]['ID']}";
				$DB->query($sql);
				$this->success('登录成功','Index/index');
			}else{
				$this->error('登录失败，用户名或者密码错误');
			}
		}
	}

	function register(){
		global $NowTime;

		$DB = DBlink();
		$UserName = addslashes(trim($this->_post('UserName')));
		$PassWord = addslashes(md5(trim($this->_post('PassWord'))));
		$rPassWord = addslashes(md5(trim($this->_post('rPassWord'))));
		$Email = addslashes(trim($this->_post('Email')));
		if(empty($UserName)){
			$this->error('用户名不可为空');
		}

		if($PassWord != $rPassWord){
			$this->error('两次输入的密码不一致，请重新填写');
		}

		$sql = "SELECT UserName,Email FROM tb_admin WHERE UserName = '{$UserName}' OR Email='{$Email}' LIMIT 1 ";
		
		$user = $DB->getRows($sql);
		if(!empty($user)){
			if($user[0]['UserName'] == $UserName){
				$this->error('用户名已存在，请重新输入');
			}elseif($user[0]['Email'] == $Email){
				$this->error('邮箱已被注册，请重新填写');
			}
		}
		
		$sql = "INSERT INTO user (`UserName`,`PassWord`,`Email`,`Status`,`AddTime`) VALUES ('{$UserName}','{$PassWord}','{$Email}','no','{$NowTime}')";

		$result = $DB->query($sql);
		
		if($result>0){
			$this->success("注册成功,请登录",'Public/index');
		}else{
			$this->error('注册失败，稍后');
		}
	}
		


}