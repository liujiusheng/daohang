<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>半命题作文-文章详情</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/>
    <link rel="Shortcut Icon"href="<?php echo base_url('sourse/images/icon.png');?>"/>
    <link href="<?php echo base_url('sourse/css/weixin.css');?>" rel="stylesheet">
</head>
<body>
    <div class="content">
        <h3>评论</h3>
        <div>
            向<?php echo $toUserName;?>评论
        </div>
        <div>
            <form action="<?php echo base_url('index.php/weixin/doAddMessage');?>" method="post">
            <input type="hidden" name="toUserId" value="<?php echo $toUserId;?>">
            <input type="hidden" name="toUserName" value="<?php echo $toUserName;?>">
            <input type="hidden" name="articlesId" value="<?php echo $articlesId;?>">
            <textarea name="content" placeholder="评论.."></textarea>
            <button type="submit">提交</button>
            </form>
        </div>
    </div>
    <div class="footer">
        <a href="<?php echo base_url('index.php/weixin/index');?>">首页</a> |
        <a href="<?php echo base_url('index.php/weixin/add');?>">发布</a> |
        <a href="<?php echo base_url('index.php/weixin/min');?>">我的</a>
    </div>
</body>
</html>