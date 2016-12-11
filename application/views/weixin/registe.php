<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>半命题作文-注册</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/>
    <link rel="Shortcut Icon"href="<?php echo base_url('sourse/images/icon.png');?>"/>
    <link href="<?php echo base_url('sourse/css/weixin.css');?>" rel="stylesheet">
</head>
<body>
    <div class="content">
        <h3>注册</h3>
        <form action="<?php echo base_url('index.php/weixin/doRegiste');?>" method="post">
            <input name="username"type="text" placeholder="昵称">
            <input name="mail"type="mail" placeholder="邮箱">
            <input name="password"type="password" placeholder="密码">
            <button type="submit">注册</button>
        </form>
    </div>
    <div class="footer">
        <a href="<?php echo base_url('index.php/weixin/index');?>">首页</a> |
        <a href="<?php echo base_url('index.php/weixin/add');?>">发布</a> |
        <a href="<?php echo base_url('index.php/weixin/min');?>">我的</a>
    </div>
</body>
</html>