<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>半命题作文-新建文章</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/>
    <link rel="Shortcut Icon"href="<?php echo base_url('sourse/images/icon.png');?>"/>
    <link href="<?php echo base_url('sourse/css/weixin.css');?>" rel="stylesheet">
</head>
<body>
    <h3>写作</h3>
    <div style="font-size:12px;color:#EA4335;"><?php if($username==''){echo '请先登录再写哦！';};?></div>
    <form action="<?php echo base_url('index.php/weixin/doAddBlog');?>"method="post">
    <div class="header">
        <input type="text" name="title" value="<?php if(isset($title)){$title;};?>" placeholder="标题">
    </div>
    <div class="content">
        <textarea name="content" value="<?php if(isset($content)){echo $content;};?>" placeholder="内容..."></textarea>
    </div>
    <button id="btn" type="submit">发布</button>
    </form>
    
    <div class="footer">
        <a href="<?php echo base_url('index.php/weixin/index');?>">首页</a> |
        <a href="<?php echo base_url('index.php/weixin/add');?>">发布</a> |
        <a href="<?php echo base_url('index.php/weixin/min');?>">我的</a>
    </div>
</body>
</html>