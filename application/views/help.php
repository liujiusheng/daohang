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
	<title>我的主页.帮助页面</title>
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
		  <a class="navbar-brand" href="#">我的主页.<small>帮助页面</small></a>
		</div>
		<ul id="bs-example-navbar-collapse-1"class="nav navbar-nav navbar-right container-fluid collapse navbar-collapse">
			<li id=""class=""><a href="<?php echo base_url('index.php/welcome/blog');?>">博客</a></li>
			<li id=""class=""><a href="<?php echo base_url('pages/index.php');?>">我的主页</a></li>
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
	<div id=""class="row help-content"style="margin-top:55px;">
		<div class="col-sm-10 col-sm-offset-1">
			<h3>我的主页使用帮助</h3>
			<h4>主页部分<small>.添加链接</small></h4>
			<p>
			1.下载我们官方提供的插件
			</p>
			<p>
			2.在每一个模块的窗口中点击添加按钮，在出现的输入框中填写链接名称和链接
			</p>
			<h4>主页部分<small>.删除链接</small></h4>
			<p>点击窗口工具栏中的删除按钮后到相应链接上点击</p>
			<h4>主页部分<small>.模块布局</small></h4>
			<p>打开设置页面，点击“布局”，拖动相应的模块到相应位置</p>
			<h4>主页部分<small>.签到</small></h4>
			<p>右上角心形图标点击就可以签到，每天可点击一次，只要你留有正确的邮箱地址，某年中的某个时刻我们会给你带来惊喜哦！期待吧</p>
			<h4>主页部分<small>.模块显示</small></h4>
			<p>可以设置模块是否在主页上显示，on为显示，off为不显示</p>
			<h4>主页部分<small>.模块隐私</small></h4>
			<p>设置模块的隐私状态，默认情况下所有模块均对外打开，开启隐私模式后需要为模块设置密码，订阅者只有输入密码才能订阅到你的内容</p>
			<h4>主页部分<small>.界面</small></h4>
			<p>在界面部分可以修改主页的样式风格，我们内置了五种主题风格供您选择，您也可以自己更换背景，
			可以是图片也可以是颜色，您还可以根据自己的喜好调整各部分的透明度。更多主题正在努力开发中...
			</p>
		</div>
	</div>
</body>
</html>