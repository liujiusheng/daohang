<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/>
	<meta name="apple-mobile-web-app-capable"content="yes"/>
	<meta http-equiv="X-UA-Compatible"content="chrome=1">
	<meta name="author" content="Daliu"/>
	<meta name="keywords" content="刘久胜、在线简历、刘久胜在线简历"/>
	<meta name="describe" content="这是我的在线简历，我是刘久胜"/>
	<title>刘久胜在线简历</title>
	<link rel="Shortcut Icon"href="<?php echo base_url('sourse/images/icon.png');?>"/>
	<link rel="apple-touch-icon"href="<?php echo base_url('sourse/images/favicon.ico');?>"/>
	<link rel="apple-touch-icon-precomposed"href="<?php echo base_url('sourse/images/favicon.ico');?>"/>
	<script src="<?php echo base_url('sourse/js/jquery.1.11.3.min.js');?>"></script>
	<script>
		$(document).ready(function(){
			
			var section = $("section");
			var body = $("body");
			var page2 = $("#page-2");
			//section.css({"width":screen.availWidth/system.DPI,"height":screen.availHeight});
			//alert("这是我的在线简历————刘久胜");
			var DPI = window['devicePixelRatio'];
			//alert(DPI);
			var system = { 
				DPI:DPI,
				currentPage:1,
				touchStartX:'',
				touchStartY:'',
				touchMoveX:'',
				touchMoveY:'',
				touchEndX:'',
				touchEndY:'',
				screenWidth:$("body").width(),//window.screen.availWidth/DPI,
				screenHeight:$(window).height(),//window.screen.availHeight-100,//()/DPI,
				top:0,
				changeTem:changeTem,//更改温度显示函数
				changePage:changePage,//翻页函数
				touchEnd:touchEnd,//触摸结束函数
				startTime:'',//温度计触摸开始时间
				endTime:'',//温度计触摸结束时间
				rightTime:'',
				degree:'',//温度
				degree2:1//触摸结束时计算温度
			}
			system.changePage($("body"),$("#main"),$("section"));
			//outer包函滑动元素的节点，inner被滑动元素的节点
			function changePage(outer,inner,page)
			{
				//调整页面各部分到标准状态width(system.screenWidth)..width(system.screenWidth).width(system.screenWidth)
				outer.height(system.screenHeight);
				inner.height(4*system.screenHeight);
				page.height(system.screenHeight);
				
				outer.unbind("touchstart").bind("touchstart",function(event){
				//event.preventDefault();
				system.touchEndX=0;
				system.touchEndY=0;
				system.touchStartX = event.originalEvent.touches[0].pageX;
				system.touchStartY = event.originalEvent.touches[0].pageY;
				});
				outer.unbind("touchmove").bind("touchmove",function(event){
					event.preventDefault();
					system.touchMoveX = event.originalEvent.touches[0].pageX;
					system.touchMoveY = event.originalEvent.touches[0].pageY;
					system.touchEndX = system.touchMoveX-system.touchStartX;
					system.touchEndY = system.touchMoveY-system.touchStartY;
					//目前只支持上下翻页
					if(system.touchEndY>0)
					{
						//手指向下翻页
						inner.css({"top":-(system.currentPage-1)*system.screenHeight+system.touchEndY});
					}
					if(system.touchEndY<0)
					{
						//手指向上翻页
						inner.css({"top":-(system.currentPage-1)*system.screenHeight+system.touchEndY});
					}
				});
				outer.unbind("touchend").bind("touchend",function(event){
					if(system.touchEndY>50)
					{
						//手指向下翻页
						inner.css({"top":-(system.currentPage-1)*system.screenHeight+system.touchEndY});
						if(system.currentPage>1)
						{
							var time = system.screenHeight-system.touchEndY;
							inner.animate({"top":-(system.currentPage-2)*system.screenHeight},time);
							var nextpage = system.currentPage-1;
							system.currentPage = nextpage;
						}
						else
						{
							inner.animate({"top":0});
						}
					}
					if(system.touchEndY<-50)
					{
						//手指向上翻页
						inner.css({"top":-(system.currentPage-1)*system.screenHeight+system.touchEndY});
						if(system.currentPage<4)
						{
							var time = system.screenHeight-system.touchEndY;
							inner.animate({"top":-system.currentPage*system.screenHeight},time);
							var nextpage = system.currentPage+1;
							system.currentPage = nextpage;
						}
						else
						{
							inner.animate({"top":-3*system.screenHeight});
						}
					}
					else
					{
						//如果手指滑动距离不够则回到原来的状态
						inner.animate({"top":-(system.currentPage-1)*system.screenHeight});
					}
				});
			}
			
			$("#avatar").unbind("touchstart").bind("touchstart",function(event){event.preventDefault();})
			$(".skill").unbind("touchstart").bind("touchstart",function(event){event.preventDefault();});
			
/*个人项目列表
|--------------------------------------------------------------------------------------------------
|
*/
			var project = $(".project-list");
			var current = $(".project-list:first-child");
			current.children("p").slideDown(500);
			project.click(function(){
					current.children("p").slideUp(500);
					current = $(this);//alert(current);
					current.children("p").slideDown(500);
				
				
			});
/*个人经历canvas动画
|--------------------------------------------------------------------------------------------------
|
*/
createTem();
function createTem()
{
	var baseX = system.screenWidth/2;
	var baseY = system.screenHeight;
	var c=document.getElementById("temp");
	c.width = system.screenWidth;
	c.height = system.screenHeight;
	
var num = c.getContext("2d");
num.font="30px Verdana";
num.fillStyle = "white";
num.fillText("20℃",10,50);


var ctx=c.getContext("2d");
// 创建渐变
var gradient=ctx.createLinearGradient(baseX,baseY-100,baseX+25,baseY-60);
gradient.addColorStop("0","white");
gradient.addColorStop("1.0","gray");
// 用渐变填色
ctx.fillStyle = gradient;
ctx.beginPath();
//ctx.globalAlpha = "0.9";
ctx.arc(baseX,baseY-100,20,0,2*Math.PI);
ctx.closePath();
ctx.fill();

/*画温度计杆*/
var back = c.getContext("2d");
back.beginPath();
back.fillStyle = "white";
back.strokeStyle = "white";
back.lineWidth = 10;
back.moveTo(baseX,20);
back.lineTo(baseX,baseY-119);
back.closePath();
back.fill();
back.stroke();




var inner = c.getContext("2d");
inner.fillStyle = "red";
ctx.beginPath();
inner.arc(baseX,baseY-103,5,0,2*Math.PI);
inner.fill();

/*画刻度*/
var degree = c.getContext("2d");
degree.beginPath();
degree.fillStyle = "white";
degree.strokeStyle = "white";
degree.lineWidth = 1;
degree.font="16px Verdana";

var k = 130;
for(var i=0;i<25;i=i+5)
{
	degree.fillText(i,baseX+20,baseY-k);
	for(var j=0;j<5;j++)
	{
		if(j===4)
		{
			degree.moveTo(baseX+5,baseY-k);
			degree.lineTo(baseX+30,baseY-k);
		}
		else
		{
			degree.moveTo(baseX+5,baseY-k);
			degree.lineTo(baseX+20,baseY-k);
		}
		k=k+10;
	}
	
}
degree.fillText("25℃",baseX+20,baseY-k);

degree.closePath();
degree.fill();
degree.stroke();
var temp = $("#temp");
var interval = '';
var interval2 = '';
	temp.unbind("touchstart").bind("touchstart",function(event){
		event.preventDefault();
		//system.touchStart();
		var date = new Date();
		system.startTime = date.getTime();
		interval = setInterval(system.changeTem,100);

		});
	temp.unbind("touchend").bind("touchend",function(event){
		clearInterval(interval);
		interval2 = setInterval(system.touchEnd,100);
		});	
	
}
//修改显示温度长度
function changeTem()
{
	var c=document.getElementById("temp");
	var baseX = system.screenWidth/2;
	var baseY = system.screenHeight;
	var date = new Date();
	system.endTime = date.getTime();
	var time = system.endTime-system.startTime;
	system.degree = Math.floor(time/1000);
	/*画中心红色温度条*/
	var line = c.getContext("2d");
	line.beginPath();
	line.fillStyle = "red";
	line.strokeStyle = "red";
	line.lineWidth = 1;
	line.moveTo(baseX,baseY-100);
	line.lineTo(baseX,baseY-system.degree-130);
	line.closePath();
	line.fill();
	line.stroke();
	var num = baseY-system.degree-180;
	//console.log(time+":"+num);
}

function touchEnd()
{
	if(system.degree2>0)
	{
	/*画温度计杆*/
	var c=document.getElementById("temp");
	var baseX = system.screenWidth/2;
	var baseY = system.screenHeight;
	var back = c.getContext("2d");
	back.beginPath();
	back.fillStyle = "white";
	back.strokeStyle = "white";
	back.lineWidth = 10;
	back.moveTo(baseX,20);
	back.lineTo(baseX,baseY-119);
	back.closePath();
	back.fill();
	back.stroke();
	
	var date = new Date();
	system.rightTime = date.getTime();
	var time = system.rightTime-system.endTime;
	system.degree2 = system.degree - Math.floor(time/1000);
	
	/*画中心红色温度条*/
	var line = c.getContext("2d");
	line.beginPath();
	line.fillStyle = "red";
	line.strokeStyle = "red";
	line.lineWidth = 1;
	line.moveTo(baseX,baseY-100);
	line.lineTo(baseX,baseY-system.degree2-130);
	line.closePath();
	line.fill();
	line.stroke();
	
	}
	console.log(system.degree);
}

		});
	</script>
	<style>
		*{margin:0;padding:0;}
		#main{position:absolute;top:0;}
		body{background:url(<?php echo base_url('sourse/images/myself_background2.jpg');?>);background-size:100% auto;color:white;overflow:hidden;}
		.hidden{display:none;}
		section{width:100%;overflow:hidden;}
		.avatar-outer2{width:7em;height:7em;border-radius:50%;border:solid 1em rgba(255,255,255,0.3);margin:0 auto;line-height:7em;margin-top:4em;
				-webkit-animation:avatar1 3700ms ease-in-out infinite alternate;
		}
		.avatar-outer1{width:5em;height:5em;border-radius:50%;border:solid 1em rgba(255,255,255,0.5);margin:0 auto;line-height:5em;
				
		}
		#avatar{width:5em;height:5em;margin:0 auto;border:solid 1px white;background:url(<?php echo base_url('sourse/images/avatar.jpg');?>);
				border-radius:50%;background-size:cover;
				-webkit-animation:avatar2 3700ms ease-in-out infinite alternate;
				}
		.base-info{width:100%;text-align:center;color:black;margin-top:2em;}
		.skill{display:inline-block;width:5em;height:5em;border-radius:50%;border:solid 1px rgba(255,255,255,0.4);text-align:center;line-height:5em;
			position:absolute;background:none;background:rgba(0,0,0,0.2);
			-webkit-animation:skill 2700ms ease-in-out infinite alternate;
		}
		#skill-1{position:absolute;right:6em;top:15em;width:2em;height:2em;line-height:2em;}
		#skill-2{position:absolute;right:6em;top:0.2em;width:3em;height:3em;line-height:3em;
				-webkit-animation:skill2 3700ms ease-in-out 2s infinite alternate;
		}
		#skill-3{position:absolute;left:0.8em;top:4em;width:4em;height:4em;line-height:4em;
				-webkit-animation:skill1 4700ms ease-in-out 1s infinite alternate;
		}
		#skill-4{position:absolute;right:1em;top:3em;
				-webkit-animation:skill3 2700ms ease-in-out 0.1s infinite alternate;
		}
		#skill-5{position:absolute;left:0.5em;top:10em;
				-webkit-animation:skill 3200ms ease-in-out 3s infinite alternate;
		}
		#skill-6{position:absolute;right:1em;top:10em;width:3em;height:3em;line-height:3em;
				-webkit-animation:skill 3000ms ease-in-out 0s infinite alternate;
		}
		#skill-7{position:absolute;left:4em;top:16em;width:4em;height:4em;line-height:4em;
				-webkit-animation:skill3 3900ms ease-in-out 0.2s infinite alternate;
		}
		#skill-8{
				position:absolute;left:4em;top:0em;
		}
		@-webkit-keyframes skill{
			0%{-webkit-transform:translate(0em,0em);}
			100%{-webkit-transform:translate(0.5em,0.5em);}
		}
		@-webkit-keyframes skill1{
			0%{-webkit-transform:translate(0em,0em);}
			100%{-webkit-transform:translate(0em,0.2em);}
		}
		@-webkit-keyframes skill2{
			0%{-webkit-transform:translate(0em,0em);}
			100%{-webkit-transform:translate(1em,2em);}
		}
		@-webkit-keyframes skill3{
			0%{-webkit-transform:translate(0em,0em);}
			100%{-webkit-transform:translate(1em,-2em);}
		}
		@-webkit-keyframes avatar1{
			0%{-webkit-transform:scale(1,1);}
			100%{-webkit-transform:scale(1.1,1.1);}
		}
		@-webkit-keyframes avatar2{
			0%{-webkit-transform:scale(1.1,1.1);}
			100%{-webkit-transform:scale(1,1);}
		}
		
		.project-list{
			width:98%;line-height:3em;border-radius:4px;
			background:-webkit-linear-gradient(top,rgba(0,0,0,0.3),rgba(0,0,0,0.6));margin:0.3em;text-align:center;
		}
		.project-list a{
			
			}
		.project-list p{display:none;background:white;color:gray;text-shadow:0 -1px 1px white;text-align:left;line-height:1em;padding:5px;}
		
		textarea{width:94%;height:8em;margin:4px;padding:2%;border-radius:3px;color:gray;-webkit-transition:box-shadow 2s ease-in-out;box-shadow:0 0 0 0 #33BAFF;}
		textarea:hover{border:solid 1px #33BAFF;box-shadow:0 0 5px 1px #33BAFF;border:solid 1px gray;}
		#btn{
			width:98%;height:40px;margin:4px;border:none;background:#3AC8EC;background:-webkit-linear-gradient(top,#3AC8EC,#337AB7);color:white;border-radius:3px;box-shadow:0 2px 1px 1px #28608F;
		}
		#btn:hover{box-shadow:0 0 5px 1px #33BAFF;height:42px;}
		footer{text-align:center;margin-top:1em;}
	</style>
</head>
<body>
<div id="main">
	<section id="page-1"style="">
		<div id=""class="">
			<div id=""class="">
				<div id=""class="avatar-outer2">
					<div id=""class="avatar-outer1">
						<div id="avatar"class="">
							
						</div>
					</div>
				</div>
				<div id=""class="base-info">
					刘久胜 男 重庆 开县
				</div>
				<div id=""class="base-info">
					<p>Tel:13036146797</p>
					<p>Mail:891599396@qq.com</p>
				</div>
			</div>
			<div id=""class="">
				<span id="skill-1"class="skill">PHP</span>
				<span id="skill-2"class="skill">TP</span>
				<span id="skill-3"class="skill">CI</span>
				<span id="skill-4"class="skill">Jquery</span>
				<span id="skill-5"class="skill">JavaScript</span>
				<span id="skill-6"class="skill">CSS3</span>
				<span id="skill-7"class="skill">HTML5</span>
				<span id="skill-8"class="skill">BootStrap</span>
			</div>
		</div>
		<div id=""class="">
			<table id=""class="">
				<tr>
					<td>学校：</td>
					<td>部属211工程重点大学 华中农业大学</td>
				</tr>
				<tr>
					<td>专业：</td>
					<td>地理信息系统(GIS)</td>
				</tr>
			</table>
		</div>
	</section>
	<section id="page-2">
		<ul>
			<li class="project-list">
				<a>我的主页</a>
				<p>
				我的主页是一个书签类在线导航网站，专用于收藏各类书签，从此用户不再担心跨平台工作和多设备协同工作造成书签难以同步的问题。
				<br/><a href="#">我的主页</a>
				</p>
			</li>
			<li class="project-list">
				<a>聚派</a>
				<p>这是光派信息技术有限公司核心产品之一</p>
			</li>
			<li class="project-list">
				<a>Wang's Lab</a>
				<p>华中农业大学一实验室展示网站</p>
			</li>
			<li class="project-list">
				<a>经管院官网</a>
				<p>华中农业大学经济管理学院官方网站</p>
			</li>
			<li class="project-list">
				<a>Js代码库</a>
				<p>大学多年开发经验总结，集成了常用模块（标签页、选择器、事件添加等），能有效提高自己的开发效率</p>
			</li>
			<li class="project-list">
				<a>PHP MVC框架</a>
				<p>通过深入分析CodeIgniter框架编写的一款PHP MVC代码库，能轻松扩展，有效提高开发效率（不断更新优化中...）</p>
			</li>
		</ul>
	</section>
	<section id="page-3">
		<canvas id="temp">
			你的浏览器不支持canvas,请换chrome试试
		</canvas>
	</section>
	<section id="page-4">
		<div id=""class="">
			<h3>自述：</h3>
			<p>我是刘久胜，我并不想为自己代言，因为我说我自己很懒。</p>
			<p>我不想成为技术大牛</p>
			<p>我不想成为商业巨头</p>
			<p>但我想挣好多好多的钱</p>
			<p>我想过好清闲的生活</p>
		</div>
		<div id=""class="">
			<form action=""method="">
				<textarea name=""placeholder="我装了逼没想跑，你打我啊"></textarea>
				<button id="btn">提交</button>
			</form>
		</div>
		<footer id=""class="">CopyRight © Daliu 2015-2016</footer>
	</section>
</div>
</body>
<script src="http://qzonestyle.gtimg.cn/qzone/app/qzlike/qzopensl.js#jsdate=20111201" charset="utf-8"></script>
</html>