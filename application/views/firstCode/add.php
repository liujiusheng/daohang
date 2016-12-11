<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/>
	<meta name="apple-mobile-web-app-capable"content="yes"/>
	<meta http-equiv="X-UA-Compatible"content="chrome=1">
	<meta name="author" content="Daliu,彭老师，老黄"/>
	<meta name="keywords" content="程序员的新年签，新年第一行代码"/>
	<meta name="describe" content="不是程序员也可以装逼"/>
	<title>新年第一行代码</title>
	<link rel="Shortcut Icon"href="<?php echo base_url('sourse/images/icon.png');?>"/>
	<link rel="apple-touch-icon"href="<?php echo base_url('sourse/images/favicon.ico');?>"/>
	<link rel="apple-touch-icon-precomposed"href="<?php echo base_url('sourse/images/favicon.ico');?>"/>
	<style>
	
	</style>
</head>
<body>
	<form action="<?php echo base_url('index.php/firstcode/inputStorage');?>"method="post">
		<input type="text"placeholder="语言名称"name="language"/>
		<input type="text"placeholder="hello world代码"name="code"/>
		<textarea name="describe"></textarea>
		<input type="submit"/>
	</form>
	
	
</body>

</html>