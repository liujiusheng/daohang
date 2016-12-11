<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>半命题作文-文章列表</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/>
    <link rel="Shortcut Icon"href="<?php echo base_url('sourse/images/icon.png');?>"/>
    <link href="<?php echo base_url('sourse/css/weixin.css');?>" rel="stylesheet">
</head>
<body>
    <div class="content">
        <h3>文章列表</h3>
        <div>
        <?php foreach($articles as $article):;?>
            <div class="list"><?php echo $article['articlesId'];?>. <a href="<?php echo base_url('index.php/weixin/each');?><?php echo "/".$article['articlesId'];?>"><?php echo $article['title'];?></a></div>
        <?php endforeach;?>
        </div>
        <div style="text-align:center;margin-top:15px;margin-bottom:15px;"><?php echo $pages;?></div>
    </div>
    <div class="footer">
        <a href="<?php echo base_url('index.php/weixin/index');?>">首页</a> |
        <a href="<?php echo base_url('index.php/weixin/add');?>">发布</a> |
        <a href="<?php echo base_url('index.php/weixin/min');?>">我的</a>
    </div>
</body>
</html>