<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>半命题作文-与我相关</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/>
    <link rel="Shortcut Icon"href="<?php echo base_url('sourse/images/icon.png');?>"/>
    <link href="<?php echo base_url('sourse/css/weixin.css');?>" rel="stylesheet">
</head>
<body>
    <div class="content">
        <h3>与我相关</h3>
        <table>
            <tr>
                <td>昵称:</td>
                <td><?php if($mail != ''){echo $nickName;}else{echo '还没登录！';};?></td>
            </tr>
            <tr>
                <td>邮箱:</td>
                <td><?php if($mail != ''){echo $mail;}else{echo '还没登录！';};?></td>
            </tr>
            <tr>
                <td>当前积分:</td>
                <td><?php if(count($score)>0){echo $score[0]['score'];}else{echo '暂无记录，请联系管理员!';};?></td>
            </tr>
        </table>
        <div>
            <a href="<?php echo base_url('index.php/weixin/login');?>"><button class="btn-half">去登录</button></a>
            <a href="<?php echo base_url('index.php/weixin/registe');?>"><button class="btn-half">注册？</button></a>
        <div>
        <div>
            <h3>平台宗旨</h3>
            <p>我本一专业程序员，深感写作重要，遂16年3月开“半命题作文”公号，借读者之点击率勉励自己。</p>
            <p>业界多好友亦立志写作，交流甚广。</p>
            <p>然公号之规则，操作之繁琐，深碍读者之交流。</p>
            <p>11月又发奋建一社区。</p>
            <p>望朋友多在平台写作，</p>
            <p>不论文字多少，</p>
            <p>提升写作水平也记录下生活的点点滴滴。</p>
            <p>内测中...</p>
        </div>
        <div>
            <h3>积分规则</h3>
            <p>注册获得200积分</p>
            <p>发表文章消耗10积分</p>
            <p>评论消耗1积分</p>
            <p>被评论获得1积分</p>
        </div>

    </div>
    <div class="footer">
        <a href="<?php echo base_url('index.php/weixin/index');?>">首页</a> |
        <a href="<?php echo base_url('index.php/weixin/add');?>">发布</a> |
        <a href="<?php echo base_url('index.php/weixin/min');?>">我的</a>
    </div>
</body>
</html>