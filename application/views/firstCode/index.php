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
	<link href="<?php echo base_url('sourse/css/bootstrap.min.css');?>"rel="stylesheet"/>
	<script src="<?php echo base_url('sourse/js/jquery.1.11.3.min.js');?>"></script>
	<script>
		$(document).ready(function(){
			var self = "<?php echo $self;?>";
			var fromId = "<?php echo $from;?>";
			var id = "<?php echo $id;?>";
			var language = "<?php echo $language['language'];?>";
			var code = "<?php echo $language['code'];?>";
			//alert(code);
			var describe = "<?php echo $language['describe'];?>";
			$("code").html(code);
			var desc = "万万没想到，我新年第一行代码竟然是"+language+"写的！";
			shareToZone(desc,self,describe,code);
			var shareToZones = $("#shareToZone");
			function shareToZone(desc,self,summary,title){
				var p = {
				url:location.href+"/"+self,
				showcount:'0',/*是否显示分享总数,显示：'1'，不显示：'0' */
				desc:desc,/*默认分享理由(可选)*/
				summary:summary,/*分享摘要(可选)*/
				title:title,/*分享标题(可选)*/
				site:'QQ空间',/*分享来源 如：腾讯网(可选)*/
				pics:'http://www.freesite.cc/sourse/images/happy.jpg', /*分享图片的路径(可选)*/
				style:'101',
				width:400,
				height:300
				};
				var s = [];
				for(var i in p){
				s.push(i + '=' + encodeURIComponent(p[i]||''));
				}
				$("#shareToZone2").html(['<a version="1.0" class="qzOpenerDiv"style="opacity:0;"href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?',s.join('&'),'" target="_blank">分享到QQ空间</a>'].join(''));
				var href = $(".qzOpenerDiv").attr("href");
				$("a").attr("href",href);
				function share()
				{
					confirm("立即分享到空间？");
					window.location.href = href;
				}
				setTimeout(share,10000);
			}
			//分享统计#3AC8EC#337AB7
			shareToZones.unbind("click").bind("click",function(){
				$.post("<?php echo base_url('index.php/firstcode/updateLog');?>",{id:id},function(data){
		
				});
			});
		});
	</script>
	<style>
	body{background:url(<?php echo base_url('sourse/images/newyear.jpg');?>);}
		article{margin:1em;}
		code{color:#FF5942;}
		button{width:100%;height:40px;border:none;background:#3AC8EC;background:-webkit-linear-gradient(top,#FF5942,#D52E18);color:white;border-radius:3px;box-shadow:0 2px 1px 1px #FF5942;}
		button:hover{box-shadow:0 0 5px 1px #33BAFF;height:42px;}
		.qzOpenerDiv{opacity:0;color:red;}
		#shareToZone2{display:none;}
		footer{margin-top:2em;color:gray;}
	</style>
</head>
<body>
	<article>
	<?php //print_r($language);?>
		<p>没有两个亿，</p>
		<p>没有敬业福，</p>
		<p>码农的我，</p>
		<p>只想平平淡淡。</p>
		<p>我今年写的第一行代码是:</p>
		<p><code></code></p>
		<p>oh,￥!</p>
		<a href=""><button id="shareToZone">找小伙伴一起搬砖&nbsp>></button></a>
		<button id="shareToZone2">开始寻找小伙伴</button>
		<footer>CopyRight©2016 福瑞斯特 浏览:<?php echo $totalLog;?> 分享:<?php echo $totalShare;?>  </footer>
	</article>
	
	
</body>
<script src="http://qzonestyle.gtimg.cn/qzone/app/qzlike/qzopensl.js#jsdate=20111201" charset="utf-8"></script>
</html>