<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/>
	<meta name="apple-mobile-web-app-capable"content="yes"/>
	<meta http-equiv="X-UA-Compatible"content="chrome=1">
	<meta name="author" content="Daliu"/>
	<meta name="keywords" content="手抖是病、游戏"/>
	<meta name="describe" content="手抖是病是一种病，得治啊！"/>
	<title>手抖是病，得治啊！</title>
	<link rel="Shortcut Icon"href="<?php echo base_url('sourse/images/icon.png');?>"/>
	<link rel="apple-touch-icon"href="<?php echo base_url('sourse/images/favicon.ico');?>"/>
	<link rel="apple-touch-icon-precomposed"href="<?php echo base_url('sourse/images/favicon.ico');?>"/>
	<script src="<?php echo base_url('sourse/js/jquery.1.11.3.min.js');?>"></script>
	<script>
		$(document).ready(function(){
			//alert("评论列表页");
			
		});
	</script>
	<style>
		body{text-align:center;}
		textarea{width:100%;height:100px;border-radius:3px;color:gray;-webkit-transition:box-shadow 2s ease-in-out;box-shadow:0 0 0 0 #33BAFF;}
		input{width:100%;height:40px;border:none;background:#3AC8EC;background:-webkit-linear-gradient(top,#3AC8EC,#337AB7);color:white;border-radius:3px;box-shadow:0 2px 1px 1px #28608F;}
		textarea:hover{box-shadow:0 0 5px 1px #33BAFF;border:solid 1px gray;}
		input:hover{box-shadow:0 0 5px 1px #33BAFF;height:42px;}
		#content{margin-top:10px;}
		.message-list{width:100%;height:auto !important;height:40px;min-height:40px;line-height:40px;border-bottom:solid 1px gray;text-align:left;}
		.message-list>.message{display:inline-block;width:60%;height:auto !important;height:40px;min-height:40px;}
		.message-list>.time{display:inline-block;width:40%;color:gray;font-size:small;position:abosolute;right:0;top:0;}
		.message-list:first-child{text-align:center;}
	</style>
</head>
<body>
	<div id=""class="">
		<form action="<?php echo base_url('index.php/lazy/addmessage');?>"method="post">
			<input type="hidden"name="from"value="<?php echo $from;?>"/>
			<textarea name="content"placeholder="说点什么呢..."></textarea>
			<input type="submit"value="提交"/>
		</form>
	</div>
	<div id="content"class="">
		<div class="message-list"><h4>所有评论</h4></div>
		<?php foreach($result as $data):;?>
			<div class="message-list"><span class="message"><?php echo $data['message'];?></span><span class="time"><?php echo $data['times'];?></span></div>
		<?php endforeach;?>
	</div>
</body>
</html>