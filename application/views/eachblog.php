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
	<title>我的主页.Blog</title>
	<link rel="Shortcut Icon"href="<?php echo base_url('sourse/images/icon.png');?>"/>
	<link rel="apple-touch-icon"href="<?php echo base_url('sourse/images/favicon.ico');?>"/>
	<link rel="apple-touch-icon-precomposed"href="<?php echo base_url('sourse/images/favicon.ico');?>"/>
	<link href="<?php echo base_url('sourse/css/bootstrap.min.css');?>"rel="stylesheet"/>
	<link href="<?php echo base_url('sourse/css/blog.css');?>"rel="stylesheet"/>
	<script src="<?php echo base_url('sourse/js/jquery.1.11.3.min.js');?>"></script>
	<script src="<?php echo base_url('sourse/js/bootstrap.min.js');?>"></script>
	<script src="<?php echo base_url('sourse/js/blog.js');?>"></script>
	<script>
		
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
		  <a class="navbar-brand" href="#">我的主页.<small>Blog</small></a>
		</div>
		<ul id="bs-example-navbar-collapse-1"class="nav navbar-nav navbar-right container-fluid collapse navbar-collapse">
			<li id=""class=""><a href="<?php echo base_url('index.php/welcome/addBlog');?>"title="添加博客"><span class="glyphicon glyphicon-plus-sign"></span></a></li>
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
	<div id=""class="row"style="margin-top:55px;">
		<div class="list-group col-sm-2 col-sm-offset-1">
		  <a href="#" class="list-group-item">PHP学习心得之面向对象（一）</a>
		  <a href="#" class="list-group-item">PHP学习心得之面向对象（二）</a>
		  <a href="#" class="list-group-item">PHP学习心得之面向对象（三）</a>
		  <a href="#" class="list-group-item">前端面试知识点总结</a>
		  <a href="#" class="list-group-item">我就想说说，什么也不做</a>
		  <a href="#" class="list-group-item">哈哈哈！武汉好大的风啊，不知道我们那边什么样了</a>
		  <a href="#" class="list-group-item">在自身修养很高的情况下人可以自我一点</a>
		  <a href="#" class="list-group-item active">
			更多内容...
		  </a>
		</div>
		<div class="panel panel-default col-sm-6">
		  <div class="panel-body">
			<ul class="list-group">
				<?php foreach($article as $art):;?>
					<li class="list-group-item">
						<a href="<?php echo base_url('index.php/welcome/eachBlog');?><?php echo "/".$art['articlesId'];?>" class="list-group-item">
							<h4 class="list-group-item-heading"><?php echo $art['title'];?> <small><?php echo $art['mail'];?> | <?php echo $art['lastTime'];?> | <?php echo $art['readNum'];?></small></h4>
							<hr/>
							<p class="list-group-item-text">
								<?php echo $art['content'];?>
							</p>
						</a>
					</li>
				<?php endforeach;?>
			</ul>
		  </div>
		</div>
		<div class="list-group col-sm-2">
		  <a href="#" class="list-group-item list-group-item-danger">
			<h4 class="list-group-item-heading">嘿！朋友：</h4>
			<p class="list-group-item-text">我每天辛辛苦苦，勤勤奋奋为了什么？只想让生活更好一点，少一点对未来的不安</p>
			
		  </a>
			<div class="input-group">
			  <input type="text" class="form-control" placeholder="我想说...">
			  <span class="input-group-btn">
				<button class="btn btn-primary" type="button">提交</button>
			  </span>
			</div>
		</div>
	</div>
	<!--添加博客输入框-->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">添加博客</h4>
		  </div>
		  <div class="modal-body">
				<form class="form-horizontal">
				  <div class="form-group">
					<label for="linkname" class="control-label sr-only">博客标题</label>
					<div class="col-sm-12">
					  <input type="text" class="form-control" id="linkname"name="linkname" value=""placeholder="写个标题">
					</div>
				  </div>
					<div class="col-sm-12">
						<label for="editor" class="control-label sr-only">博客标题</label>
						<textarea id="editor"class="form-control"row="5"placeholder="写点内容..."></textarea>
					</div>
				  </div>
				</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">放弃</button>
			<button type="button" class="btn btn-info"id="saveLinks"data-partId="">保 存</button>
		  </div>
		</div>
	  </div>
	</div>
</body>
</html>