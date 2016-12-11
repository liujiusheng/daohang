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
        <h3>文章详情</h3>
        <div>
        <?php foreach($details as $detail):;?>
            <h4><?php echo $detail['title'];?></h4>
            <p><small><?php echo $detail['mail'];?> <?php echo $detail['lastTime'];?></small></p>
            <p><?php echo $detail['content'];?></p>
        <?php endforeach;?>
        </div>
        <div>
            <form action="<?php echo base_url('index.php/weixin/addComment');?>" method="post">
            <input type="hidden" name="toUserId" value="<?php echo $details[0]['userId'];?>">
            <input type="hidden" name="id" value="<?php echo $details[0]['articlesId'];?>">
            <textarea name="content" placeholder="评论.."></textarea>
            <button type="submit">提交</button>
            </form>
        </div>
        <h3>评论</h3>
        <div>
            <?php foreach($comments as $key=>$comment):;?>
                <div class="list">
                    <div style="margin-bottom:5px;font-size:12px;color:grey;">
                        第<?php echo $key+1;?>条 <?php echo $comment['fromUserName'];?>
                    </div>
                    <div style="padding-top:4px;padding-bottom:4px;"><span style="color:#0c73c2;font-style:italic;"><?php if($comment['toUserName']!=''){echo '@'.$comment['toUserName'].' ';};?></span><?php echo $comment['content'];?></div>
                    <div style="margin-top:5px;padding-bottom:5px;">
                        <span style="float:left;font-size:12px;color:grey;"><?php echo $comment['lastTime'];?></span>
                        <span style="float:right;"><a href="<?php echo base_url('index.php/weixin/messagesToUser');?><?php echo '/'.$comment['fromUserId'].'/'.$comment['fromUserName'].'/'.$details[0]['articlesId'];?>">评论</a></span>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
    <div class="footer">
        <a href="<?php echo base_url('index.php/weixin/index');?>">首页</a> |
        <a href="<?php echo base_url('index.php/weixin/add');?>">发布</a> |
        <a href="<?php echo base_url('index.php/weixin/min');?>">我的</a>
    </div>
</body>
</html>