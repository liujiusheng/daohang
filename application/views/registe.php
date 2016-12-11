<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/>
	<meta name="apple-mobile-web-app-capable"content="yes"/>
	<meta http-equiv="X-UA-Compatible"content="chrome=1">
	<meta name="author" content="Daliu"/>
	<meta name="keywords" content="我的主页、个人书签、在线书签、个人主页"/>
	<meta name="describe" content="属于每个人自己的主页"/>
	<title>我的主页.注册页面</title>
	<link rel="Shortcut Icon"href="<?php echo base_url('sourse/images/icon.png');?>"/>
	<link rel="apple-touch-icon"href="<?php echo base_url('sourse/images/favicon.ico');?>"/>
	<link rel="apple-touch-icon-precomposed"href="<?php echo base_url('sourse/images/favicon.ico');?>"/>
	<link href="<?php echo base_url('sourse/css/bootstrap.min.css');?>"rel="stylesheet"/>
	<link href="<?php echo base_url('sourse/css/init.css');?>"rel="stylesheet"/>
	<script src="<?php echo base_url('sourse/js/jquery.1.11.3.min.js');?>"></script>
	<script src="<?php echo base_url('sourse/js/bootstrap.min.js');?>"></script>
	<script>
		$(document).ready(function(){
			
			
		});
	</script>
</head>
<body>
	<div id=""class="navbar navbar-inverse navbar-fixed-top">
		<!--导航栏-->
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="true">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="#">我的主页.<small>注册页面</small></a>
		</div>
		<ul id="bs-example-navbar-collapse-1"class="nav navbar-nav navbar-right container-fluid collapse navbar-collapse">
		<li id=""class=""><a href="#"><span class="glyphicon glyphicon-plus-sign"></span></a></li>
			<li id=""class=""><a href="<?php echo base_url('pages/index.php');?>">我的主页</a></li>
			<li id=""class=""><a href="<?php echo base_url('index.php/welcome/help');?>">帮助</a></li>
			<li id=""class="dropdown">
			<a href="#"class="dropdown-toggle" data-toggle="dropdown"role="button"aria-haspopup="true"aria-expanded="false">
			<span class="glyphicon glyphicon-user"></span>&nbsp <?php if($username!=''){echo $username;}else{echo "您还未登录";}?><span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li id=""class=""><a href="<?php echo base_url('index.php/welcome/loadLogin');?>"><span class="glyphicon glyphicon-lock"></span>&nbsp 登录</a></li>
					<li id=""class=""><a href="<?php echo base_url('index.php/welcome/loadRegiste');?>"><span class="glyphicon glyphicon-plus"></span>&nbsp 注册</a></li>
					<li id=""class=""><a href="<?php echo base_url('index.php/welcome/logout');?>"><span class="glyphicon glyphicon-off"></span>&nbsp 注销</a></li>
				</ul>
			</li>
			<li id=""class=""><a href="#"><span class="glyphicon glyphicon-heart"></span></a></li>
			<li id=""class=""><a href="#"><span class="glyphicon glyphicon-cog"></span></a></li>
		</ul>
	</div>
	<div id=""class="row"style="margin-top:85px;">
		
		<div class="panel panel-default col-sm-6 col-sm-offset-3">
		  <div class="panel-heading">
			开始注册
		  </div>
		  <div class="panel-body">
			<form class="form-horizontal"action="<?php echo base_url('index.php/welcome/doRegiste');?>"method="post">
			  <div class="form-group">
				<label for="username" class="col-sm-2 control-label">用户名</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="username" name="username" placeholder="Username">
				</div>
			  </div>
			  <div class="form-group">
				<label for="mail" class="col-sm-2 control-label">邮箱</label>
				<div class="col-sm-10">
				  <input type="email" class="form-control" id="mail"name="mail" placeholder="Email">
				</div>
			  </div>
			  <div class="form-group">
				<label for="password" class="col-sm-2 control-label">密码</label>
				<div class="col-sm-10">
				  <input type="password" class="form-control" id="password"name="password" placeholder="Password">
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
				  <div class="checkbox">
					<label>
					  <a href="<?php echo base_url('index.php/welcome/loadLogin');?>">已经有账号？去登录</a>
					</label>
				  </div>
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
				  <button type="submit" class="btn btn-default">注 册</button>
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<a style="background:url(<?php echo base_url('sourse/images/oauth-logo.png');?>);background-position:0px 0px;height:53px;width:53px;display:inline-block;cursor:pointer;"></a>
					<a style="background:url(<?php echo base_url('sourse/images/oauth-logo.png');?>);background-position:-53px 0px;height:53px;width:53px;display:inline-block;cursor:pointer;"></a>
					<a style="background:url(<?php echo base_url('sourse/images/oauth-logo.png');?>);background-position:-106px 0px;height:53px;width:53px;display:inline-block;cursor:pointer;"></a>
					<a style="background:url(<?php echo base_url('sourse/images/oauth-logo.png');?>);background-position:-159px 0px;height:53px;width:53px;display:inline-block;cursor:pointer;"></a>
				</div>
			  </div>
			</form>
		  </div>
		</div>
	</div>
</body>
</html>