<?php /* Smarty version 2.6.26, created on 2016-12-26 10:13:21
         compiled from index.html */ ?>
<!DOCTYPE html>
<html lang="en"> 
<head>
	<meta charset="utf-8" />
	<title>Metronic | Login Page</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<link href="/public/media/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="/public/media/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
	<link href="/public/media/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="/public/media/css/style-metro.css" rel="stylesheet" type="text/css"/>
	<link href="/public/media/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="/public/media/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	<link href="/public/media/css/default.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="/public/media/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<link href="/public/media/css/login.css" rel="stylesheet" type="text/css"/>
	<link rel="shortcut icon" href="/public/media/image/favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
	<!-- BEGIN LOGO -->
	<div class="logo">
		<img src="/public/media/image/logo-big.png" alt="" />
	</div>
	<!-- END LOGO -->
	<!-- BEGIN LOGIN -->
	<div class="content">
		<!-- BEGIN LOGIN FORM -->
		<form class="form-vertical login-form" method="POST" action="<?php echo $this->_tpl_vars['__MODEL__']; ?>
/login">
			<h3 class="form-title">登录</h3>
			<div class="alert alert-error hide">
				<button class="close" data-dismiss="alert"></button>
				<span>请填写您的用户名和密码</span>
			</div>
			<div class="control-group">
				<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
				<label class="control-label visible-ie8 visible-ie9">登录名</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-user"></i>
						<input class="m-wrap placeholder-no-fix" type="text" placeholder="登录名" name="UserName"/>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label visible-ie8 visible-ie9">密码</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-lock"></i>
						<input class="m-wrap placeholder-no-fix" type="password" placeholder="密码" name="PassWord"/>
					</div>
				</div>
			</div>
			<div class="form-actions">
				<label class="checkbox">
				<input type="checkbox" name="remember" value="1"/> 记住我
				</label>
				<button type="submit" class="btn green pull-right">
				登录 <i class="m-icon-swapright m-icon-white"></i>
				</button>
			</div>
			<div class="forget-password">
				<p><a href="javascript:;" class="" id="forget-password">忘记密码 ?</a></p>
			</div>
			<div class="create-account">
				<p><a href="javascript:;" id="register-btn" class="">注册新用户</a></p>
			</div>
		</form>
		<!-- END LOGIN FORM -->
		<!-- BEGIN FORGOT PASSWORD FORM -->
		<form class="form-vertical forget-form" action="inddex.html">
			<h3 class="">忘记密码 ?</h3>
			<p>请输入您的电子邮件地址以重新设置您的密码：</p>
			<div class="control-group">
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-envelope"></i>
						<input class="m-wrap placeholder-no-fix" type="text" placeholder="Email" name="Email" />
					</div>
				</div>
			</div>
			<div class="form-actions">
				<button type="button" id="back-btn" class="btn">
				<i class="m-icon-swapleft"></i> 返回
				</button>
				<button type="submit" class="btn green pull-right">
				提交 <i class="m-icon-swapright m-icon-white"></i>
				</button>
			</div>
		</form>
		<!-- END FORGOT PASSWORD FORM -->
		<!-- BEGIN REGISTRATION FORM -->
		<form class="form-vertical register-form" method="POST" action="<?php echo $this->_tpl_vars['__MODEL__']; ?>
/register">
			<h3 class="">注册</h3>
			<p>请填写注册信息</p>
			<div class="control-group">
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-user"></i>
						<input class="m-wrap placeholder-no-fix" type="text" placeholder="用户名" name="UserName"/>
					</div>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-lock"></i>
						<input class="m-wrap placeholder-no-fix" type="password" id="register_password" placeholder="密码" name="PassWord"/>
					</div>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-ok"></i>
						<input class="m-wrap placeholder-no-fix" type="password" placeholder="请再次输入您的密码" name="rPassWord"/>
					</div>
				</div>
			</div>
			<div class="control-group">
				<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
				<label class="control-label visible-ie8 visible-ie9">Email</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-envelope"></i>
						<input class="m-wrap placeholder-no-fix" type="text" placeholder="Email" name="Email"/>
					</div>
				</div>
			</div>
			<div class="control-group">
				<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
				<label class="control-label visible-ie8 visible-ie9">性别</label>
				<div class="controls">
					<div class="input-icon left">
						<select class="small m-wrap" tabindex="1">
						<option value="Category 1">男</option>
						<option value="Category 2">女</option>
					</select>
					</div>
				</div>
			</div>
			<div class="form-actions">
				<button id="register-back-btn" type="button" class="btn">
				<i class="m-icon-swapleft"></i>  Back
				</button>
				<button type="submit" id="register-submit-btn" class="btn green pull-right">
				注册<i class="m-icon-swapright m-icon-white"></i>
				</button>
			</div>
		</form>
		<!-- END REGISTRATION FORM -->
	</div>
	<!-- END LOGIN -->
	
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script src="/public/media/js/login.js" type="text/javascript"></script>