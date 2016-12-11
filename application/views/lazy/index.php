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
			alert("我按了屏幕10分钟，不服来战");
			var self = "<?php echo $self;?>";
			var fromId = "<?php echo $from;?>";
			//alert(self);
			var start = 0;
			var end = 0;
			var message = '';
			var html = '';
			var node = document.getElementById("img");
			var share = $("#share");
			var content = $("#content");
			var background =$("#background");
			var shareToZones = $("#shareToZone");
			var help = $("#help");
			var abort = $("#abort");
			
			node.addEventListener("touchstart",function(event){
				var date = new Date();
				event.preventDefault();
				start = date.getTime();
			},false);
			node.addEventListener("touchend",touchEnd,false);
			node.addEventListener("touchmove",touchMove,false);
			
			help.on("click",function(){alert("跟朋友比，你唯一要做的就是点着屏幕不要动。无脑的人才玩的游戏，正常人请无视。");});
			
			abort.on("click",function(){
				background.hide();
				share.hide();
				node.addEventListener("touchend",touchEnd,false);
				node.addEventListener("touchmove",touchMove,false);
			});
//触摸停止事件
function touchEnd(){
	var date = new Date();
	end = date.getTime();
	var time = end-start;
	var second = Math.round(time/1000);
	var more = time-second*1000;
	if(more<0)
	{
		more = 1000-more;
		second =second-1;
	}
	if(time>=60000)
	{
		message = "秒,好厉害!";
	}
	else
	{
		message = "秒,好搓哦！";
	}
	html = "你坚持了"+second+"."+more+message;
	background.show();
	share.show();
	var desc = "我知道我这么大孩子了不该玩这种弱智游戏还分享，但事实证明我的手不抖，我按着屏幕坚持了"+second+"."+more+"秒不抖，不服来战啊。";
	shareToZone(desc,self);
	content.html(html);
	score(time);
	node.removeEventListener("touchmove",touchMove,false);
	node.removeEventListener("touchend",touchEnd,false);
}
//手指移动事件
function touchMove()
{
	//
	var date = new Date();
	end = date.getTime();
	var time = end-start;
	var second = Math.round(time/1000);
	var more = time-second*1000;
	if(more<0)
	{
		more = 1000-more;
		second =second-1;
	}
	if(time>=60000)
	{
		message = "秒,好厉害!";
	}
	else
	{
		message = "秒,好搓！";
	}
	html = "你坚持了"+second+"."+more+message;
	background.show();
	share.show();
	var desc = "我知道我这么大孩子了不该玩这种弱智游戏还分享，但事实证明我的手不抖，我按着屏幕坚持了"+second+"."+more+"秒不抖，不服来战啊。";
	shareToZone(desc,self);
	content.html(html);
	score(time);
	node.removeEventListener("touchmove",touchMove,false);
	node.removeEventListener("touchend",touchEnd,false);
}
//分享到QQ空间代码
function shareToZone(desc,self){
	//alert(location.href+"/"+self);
	var p = {
	url:location.href+"/"+self,
	showcount:'1',/*是否显示分享总数,显示：'1'，不显示：'0' */
	desc:desc,/*默认分享理由(可选)*/
	summary:'考研的，上班的，上课的，睡觉的，无聊的，当你什么事都不想做的时候就把它按着吧，你会发现你真的很无聊真的很傻逼。',/*分享摘要(可选)*/
	title:'手抖是病，测测看你的手抖不抖吧',/*分享标题(可选)*/
	site:'QQ空间',/*分享来源 如：腾讯网(可选)*/
	pics:'http://121.42.144.230/daohang/sourse/images/finger.jpg', /*分享图片的路径(可选)*/
	style:'101',
	width:400,
	height:300
	};
	var s = [];
	for(var i in p){
	s.push(i + '=' + encodeURIComponent(p[i]||''));
	}
	shareToZones.html(['<a version="1.0" class="qzOpenerDiv"href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?',s.join('&'),'" target="_blank">分享到QQ空间</a>'].join(''));
}
//记录每一次玩的分数
function score(time){
	$.post("<?php echo base_url('index.php/lazy/addScore');?>",{seconds:time,self:self,fromId:fromId},function(data){
		if(data!==false)
		{
			//分享统计
			shareToZones.unbind("click").bind("click",function(){
				$.post("<?php echo base_url('index.php/lazy/updateLog');?>",{id:data},function(data){
		
				});
			});
		}
	});
}
		});
	</script>
	<style>
	#main{width:100%;}
	#img{
		display:block;width:100%;margin:0 auto;
		background:url(<?php echo base_url('sourse/images/finger.jpg');?>);background-repeat:no-repeat;background-size:100%;
		
	}
	img{width:100%;}
	#ads{width:100%;}
	button{width:100%;}
	#share{
		width:90%;margin-left:5%;height:120px;box-shadow:0 0 5px 1px gray;display:none;
		z-index:1;position:absolute;left:0;top:45%;
		text-align:center;background:white;border-radius:3px;
	}
	#content{margin-bottom:5%;margin-top:7%;}
	#share>button{width:45%;height:40px;background:#3AC8EC;background:-webkit-linear-gradient(top,#3AC8EC,#337AB7);border-radius:3px;color:white;border:solid 0 gray;box-shadow:0 2px 1px 1px #28608F;}
	#share>button:hover{box-shadow:0 0 5px 1px #33BAFF;height:42px;}
	#background{background:black;opacity:0.8;width:100%;height:150%;position:absolute;left:0;top:0;display:none;}
	#message{height:40px;}
	</style>
</head>
<body>
	<div id="main"class="">
		<div id="">最高记录：<?php echo $maxTime;?>秒</div>
		<img id="img"class=""src="<?php echo base_url('sourse/images/finger.jpg');?>"alt="开无图模式干嘛？你把图片功能打开呀，不然怎么玩？"/>
		<div id="ads"class=""><a href="http://mp.weixin.qq.com/s?__biz=MjM5ODQzMDk3Mw==&mid=400876678&idx=1&sn=77fb133ce5b9c7aba8731e6d7df64051&scene=0#wechat_redirect"title="广告链接"><img src="<?php echo base_url('sourse/images/wenquan.jpg');?>"alt="此处是广告"/></a></div>
		<div id=""class=""><a href="javascript:;"id="help">规则</a>  CopyRight Daliu Mail:891599396@qq.com</div>
		<div id="">总访问量：<?php echo $totalLog;?>人次 &nbsp&nbsp 总使用量：<?php echo $totalList;?>人次</div>
	</div>
	<div id=""class=""><a href="<?php echo base_url('index.php/lazy/message');?><?php echo "/".$from;?>"><button id="message">查看所有评论</button></a></div>
	<div id="share">
		<div id="content"></div>
		<button id="abort">重玩</button>
		<button id="shareToZone">分享到QQ空间</button>
	</div>
	<div id="background"></div>
</body>
<script src="http://qzonestyle.gtimg.cn/qzone/app/qzlike/qzopensl.js#jsdate=20111201" charset="utf-8"></script>
</html>