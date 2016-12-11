<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>我的主页</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/>
	<meta property="qc:admins" content="05553646176625531456337017537164506000" />
	<meta name="apple-mobile-web-app-capable"content="yes"/>
	<meta http-equiv="X-UA-Compatible"content="chrome=1">
	<meta name="author" content="Daliu"/>
	<meta name="keywords" content="我的主页、个人书签、在线书签、个人主页"/>
	<meta name="describe" content="属于每个人自己的主页"/>
	<link rel="Shortcut Icon"href="../sourse/images/icon.png"/>
	<link rel="apple-touch-icon"href="../sourse/images/favicon.ico"/>
	<link rel="apple-touch-icon-precomposed"href="../sourse/images/favicon.ico"/>
	<link href="../sourse/css/bootstrap.min.css"rel="stylesheet"/>
	<link href="../sourse/css/bootstrap-switch.min.css"rel="stylesheet"/>
	<link href="../sourse/css/init.css"rel="stylesheet"/>
	
</head>
<body id="main"><!--http://121.42.144.230/daohang/-->
<?php $domain = "http://localhost/daohang/";?>
	<div id=""class="navbar navbar-inverse navbar-fixed-top">
		<!--导航栏-->
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="true">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="#">我的主页</a>
		</div>
		<ul id="bs-example-navbar-collapse-1"class="nav navbar-nav navbar-right container-fluid collapse navbar-collapse">
			<li id=""class=""><a href="<?php echo $domain;?>index.php/welcome/blog">博客</a></li>
			<li id=""class=""><a href="<?php echo $domain;?>index.php/welcome/help">帮助</a></li>
			<li id=""class="dropdown">
			<a id="showUserName"href="#"class="dropdown-toggle" data-toggle="dropdown"role="button"aria-haspopup="true"aria-expanded="false">
			<span class="glyphicon glyphicon-user"></span>&nbsp <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li id=""class=""><a href="<?php echo $domain;?>index.php/welcome/loadlogin"><span class="glyphicon glyphicon-lock"></span>&nbsp 登录</a></li>
					<li id=""class=""><a href="<?php echo $domain;?>index.php/welcome/loadRegiste"><span class="glyphicon glyphicon-plus"></span>&nbsp 注册</a></li>
					<li id=""class=""><a href="<?php echo $domain;?>index.php/welcome/logout"><span class="glyphicon glyphicon-off"></span>&nbsp 注销</a></li>
				</ul>
			</li>
			<li id=""class=""><a href="#"><span class="glyphicon glyphicon-heart"></span></a></li>
			<li id="cog"class=""><a href="#"><span class="glyphicon glyphicon-cog"></span></a></li>
		</ul>
	</div>
	<div id=""class="graid"style="margin-top:80px;">
		<!--九宫格-->
	</div>
	<!--搜索框-->
	<form action="http://www.baidu.com/baidu"target="blank" id=""class="baidu-search">
		<input type="text"id="word" autofocus  name="word" class=""placeholder="搜你喜欢的..."><button id="search-button"class="">搜索</button>
	</form>
	<?php 
	for($i=1;$i<17;$i++){
		echo '<div id="win-'.$i.'"class="win win-info">
		<!--窗口-->
		<div id=""class="win-header">
			<div id=""class="win-sign">
				<div id=""class="title">Web前端</div>
				<div id=""class="change-size">
					<span id=""class="smalls">一</span>
					<span id=""class="big">口</span>
					<span id=""class="closes"data-part="">X</span>
				</div>
			</div>
			<div id=""class="win-tools">
				<div id=""class="input-group input-group-xs win-search">
					<input type="search"id=""class="form-control"/>
					<span class="input-group-btn">
						<button id=""class="btn btn-default"><span id=""class="glyphicon glyphicon-search"></span></button>
					</span>
				</div>
				<div class="win-toolbars">
					<span class="btn-group" data-toggle="buttons"><label class="btn btn-default btn-xs"><span id=""class="glyphicon glyphicon-sort-by-attributes"></span></label><label class="btn btn-default btn-xs"><span id=""class="glyphicon glyphicon-sort-by-attributes-alt"></span></label></span>
					<span class="btn-group" data-toggle="buttons"><label class="btn btn-default btn-xs"><span id=""class="glyphicon glyphicon-th"></span></label><label class="btn btn-default btn-xs"><span id=""class="glyphicon glyphicon-th-list"></span></label></span>
					<span class="btn-group" data-toggle="buttons">
						<label class="btn btn-default btn-xs" data-toggle="modal" data-target=""><span id=""data-partId=""data-part=""class="plus glyphicon glyphicon-plus-sign"></span></label>
						<label class="btn btn-default btn-xs"><span id=""class="disk glyphicon glyphicon-floppy-disk"></span></label>
						<label class="btn btn-default btn-xs"><span id=""class="edit glyphicon glyphicon-edit"></span></label>
						<label class="btn btn-default btn-xs"><span id=""class="trash glyphicon glyphicon-trash"></span></label>
						<label class="btn btn-default btn-xs"><span id=""class="refresh glyphicon glyphicon-refresh"></span></label>
						<label class="btn btn-default btn-xs"><span id=""class="alt glyphicon glyphicon-share-alt"></span></label>
					</span>
				</div>
			</div>
		</div>
		<div id=""class="win-content">
			
		</div>
	</div>';
	}
	?>
	<div id="win-setting"class="win win-info">
		<!--设置窗口-->
		<div id=""class="win-header">
			<div id=""class="win-sign">
				<div id=""class="title">设置&管理</div>
				<div id=""class="change-size">
					<span id=""class="smalls">一</span>
					<span id=""class="big">口</span>
					<span id=""class="closes">X</span>
				</div>
			</div>
			<div id=""class="win-tools">
				<div id=""class="input-group input-group-xs win-search">
					<input type="search"id=""class="form-control"/>
					<span class="input-group-btn">
						<button id=""class="btn btn-default"><span id=""class="glyphicon glyphicon-search"></span></button>
					</span>
				</div>
				<div class="win-toolbars">
					<span class="btn-group" data-toggle="buttons"><label class="btn btn-default btn-xs"><span id=""class="glyphicon glyphicon-sort-by-attributes"></span></label><label class="btn btn-default btn-xs"><span id=""class="glyphicon glyphicon-sort-by-attributes-alt"></span></label></span>
					<span class="btn-group" data-toggle="buttons"><label class="btn btn-default btn-xs"><span id=""class="glyphicon glyphicon-th"></span></label><label class="btn btn-default btn-xs"><span id=""class="glyphicon glyphicon-th-list"></span></label></span>
					<span class="btn-group" data-toggle="buttons">
						<label class="btn btn-default btn-xs"><span id=""class="glyphicon glyphicon-plus-sign"></span></label>
						<label class="btn btn-default btn-xs"><span id=""class="glyphicon glyphicon-floppy-disk"></span></label>
						<label class="btn btn-default btn-xs"><span id=""class="edit glyphicon glyphicon-edit"></span></label>
						<label class="btn btn-default btn-xs"><span id=""class="trash glyphicon glyphicon-trash"></span></label>
						<label class="btn btn-default btn-xs"><span id=""class="glyphicon glyphicon-refresh"></span></label>
						<label class="btn btn-default btn-xs"><span id=""class="glyphicon glyphicon-share-alt"></span></label>
					</span>
				</div>
			</div>
		</div>
		<div id=""class="win-content">
			<ul id=""class="win-nav">
				<li id=""class="">界面</li>
				<li id=""class="">账号</li>
				<li id=""class="">布局</li>
				<li id=""class="">广场</li>
				<li id=""class="">留言</li>
				<li id=""class="">好友</li>
			</ul>
			<ul id=""class="win-part">
				<!--此处为用户所有模块格式为<li id=""class="">常用</li>-->
				
			</ul>
			<table id=""class="win-detail">
				<tr id=""class="">
					<td id=""class="">状态：</td>
					<td id=""class="">
						<div  id="" class="">
							<input type="checkbox" checked name="state"id = "state"data-on-text="已开"data-off-text="已关"/>
						</div>
					</td>
				</tr>
				<tr id=""class="">
					<td id=""class="">名称：</td>
					<td id=""class=""><input type="text"id="title"class=""/></td>
				</tr>
				<tr id=""class="">
					<td id=""class="">背景：</td>
					<td id=""class=""><input type="text"id="background"class=""/></td>
				</tr>
				<tr id=""class="">
					<td id=""class="">隐私：</td>
					<td id=""class="">
						<div class="">
							<input type="checkbox" checked name="private"id="private"data-on-text="公有"data-off-text="私有"/>
						</div>
					</td>
				</tr>
				<tr id=""class="">
					<td id=""class="">密码：</td>
					<td id=""class=""><input type="text"id="password"class=""disabled="disabled"/></td>
				</tr>
				<tr id=""class="">
					<td id=""class="">订阅数：</td>
					<td id="order"class="">22</td>
				</tr>
				<tr id=""class="">
					<td id=""class="">订阅：</td>
					<td id=""class=""><input type="text"id="from"class=""placeholder=""/></td>
				</tr>
				<tr id=""class="">
					<td id=""class="">订阅码：</td>
					<td id=""class=""><input type="text"id="otherPassword"class=""placeholder=""/></td>
				</tr>
			</table>
		</div>
	</div>
<!--添加链接输入框-->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">添加链接</h4>
		  </div>
		  <div class="modal-body">
				<form class="form-horizontal">
				  <div class="form-group">
					<label for="linkname" class="col-sm-2 control-label">链接名称</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" id="linkname"name="linkname" value="百度"placeholder="百度">
					</div>
				  </div>
				  <div class="form-group">
					<label for="links" class="col-sm-2 control-label">链接地址</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" id="links"name="links" value="http://www.baidu.com/"placeholder="http://www.baidu.com/">
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
	<div id="messageinfo"></div>
	<div id="win-share"class="win win-info">
		<!--窗口-->
		<div id=""class="win-header">
			<div id=""class="win-sign">
				<div id=""class="title">Web前端</div>
				<div id=""class="change-size">
					<span id=""class="smalls">一</span>
					<span id=""class="big">口</span>
					<span id=""class="closes"data-part="">X</span>
				</div>
			</div>
			<div id=""class="win-tools">
				<div id=""class="input-group input-group-xs win-search">
					<input type="search"id=""class="form-control"/>
					<span class="input-group-btn">
						<button id=""class="btn btn-default"><span id=""class="glyphicon glyphicon-search"></span></button>
					</span>
				</div>
				<div class="win-toolbars">
					<span class="btn-group" data-toggle="buttons"><label class="btn btn-default btn-xs"><span id=""class="glyphicon glyphicon-sort-by-attributes"></span></label><label class="btn btn-default btn-xs"><span id=""class="glyphicon glyphicon-sort-by-attributes-alt"></span></label></span>
					<span class="btn-group" data-toggle="buttons"><label class="btn btn-default btn-xs"><span id=""class="glyphicon glyphicon-th"></span></label><label class="btn btn-default btn-xs"><span id=""class="glyphicon glyphicon-th-list"></span></label></span>
					<span class="btn-group" data-toggle="buttons">
						<label class="btn btn-default btn-xs" data-toggle="modal" data-target=""><span id=""data-partId=""data-part=""class="plus glyphicon glyphicon-plus-sign"></span></label>
						<label class="btn btn-default btn-xs"><span id=""class="disk glyphicon glyphicon-floppy-disk"></span></label>
						<label class="btn btn-default btn-xs"><span id=""class="edit glyphicon glyphicon-edit"></span></label>
						<label class="btn btn-default btn-xs"><span id=""class="trash glyphicon glyphicon-trash"></span></label>
						<label class="btn btn-default btn-xs"><span id=""class="refresh glyphicon glyphicon-refresh"></span></label>
						<label class="btn btn-default btn-xs"><span id=""class="alt glyphicon glyphicon-share-alt"></span></label>
					</span>
				</div>
			</div>
		</div>
		<div id=""class="win-content">
			
		</div>
	</div>
	<canvas id="backcanvas"width="800px"height="800px"></canvas>
</body>
<script src="../sourse/js/jquery.2.1.4.min.js"></script>
<script src="../sourse/js/bootstrap.js"></script>
<script src="../sourse/js/bootstrap-switch.min.js"></script>
<script src="../sourse/js/jquery-ui.min.js"></script>
<script src="../sourse/js/jFade.min.js"></script>
<script src="../sourse/js/init.js"></script>
<script src="../sourse/js/three.min.js"></script>
<script src="../sourse/js/3d.js"></script>

</html>