/*
*
*@Daliu
*
*121.42.144.230
*/
/*配制*/
var config = {
	domain:"http://localhost/daohang/index.php/welcome/",
	share:"http://localhost/daohang/pages/index.php",
	currentPart:'',
	outTime:4000, 
	theme:classic
}
//全局id用于与后台数据交互，用户个人id用于前端界面效果控制
var system ={
	currentPartId:'',//当前正打开窗口的全局id
	zIndex:'',
	tool:'',
	toolstate:'off',
	openingWin:'',//当前正打开窗口的个人id
	openWin:new Array(),//记录打开窗口的用户个人id
	openWinpartId:new Array(),//记录打开窗口的全局id
	nickName:''
}
var lib = {
	getSession:getSession,
	select:select,
	drag:drag,
	drop:drop,
	close:close,
	open:open,
	getParts:getParts,
	getLinks:getLinks,
	openAddLinks:openAddLinks,
	trash:trash,
	activeWin:activeWin,
	openSetting:openSetting,
	resortLink:resortLink,
	edit:edit,
	//所有以set开始的函数均为设置面板中使用的函数
	setGetParts:setGetParts,
	setOpenEach:setOpenEach,
	setChange:setChange,
	setChangePrivate:setChangePrivate,
	setChangePassword:setChangePassword,
	setChangeFrom:setChangeFrom,
	setChangeFromPassword:setChangeFromPassword,
	//url处理
	getHost:getHost,
	getRequest:getRequest,
	//根据参数绘制结果视图
	drawView
}

$(document).ready(function(){
$("[name='state']").bootstrapSwitch();
lib.getSession();
lib.drag();
lib.drop();
lib.close();
lib.getParts();
lib.activeWin();
lib.openSetting();
lib.drawView();
});

/**
 * 解析url中的域名
 *
 *
 *
 *
 */
function getHost(url) {
        var host = "null";
        if(typeof url == "undefined"|| null == url)
		{
                url = window.location.href;
		}
        var regex = /.*\:\/\/([^\/]*).*/;
        var match = url.match(regex);
        if(typeof match != "undefined"
                        && null != match)
                host = match[1];
        return host;
}
//alert(getHost(location.href));


/**
 * 解析url中的参数
 *
 *
 *
 *
 */
function getRequest() {
	var url = location.search; //获取url中"?"符后的字串
	var theRequest = new Object();
	if (url.indexOf("?") != -1) {
	var str = url.substr(1);
	strs = str.split("&");
	for(var i = 0; i < strs.length; i ++) {
	theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);
	}
	}
	return theRequest;
}


/**
 * 对参数结果进行处理
 *
 *
 *
 *
 */

 function drawView()
 {
	 var paramObject = lib.getRequest();
	 var partId = paramObject['part'];
	 //没有参数则不打开分享模块
	 if(partId!=undefined)
	 {
		
		$("#win-share").show(300);
		
		$.post(config.domain+'shareGetPartInfo',{partsId:partId},function(data){
			var partInfo = JSON.parse(data);
			var title = partInfo[0]['title'];
			$("#win-share .title").html("<font color='red'>分享：</font>"+title);
			
			$.post(config.domain+"getLinks",{partsId:partId},function(data){
				var _data = JSON.parse(data);
				var length = _data.length;
				if(length!=0)
				{
					var html = '';
					for(var i=0;i<length;i++)
					{
						var icon = _data[i]['pic'];
						var png = '';
						var links = _data[i]['links'];
						if(icon==='')
						{
							icon = 'http://'+lib.getHost(links)+'/favicon.ico';
							png = links+'favicon.png';
						}
						html+='<a class="win-list"data-part="'+_data[i]['partId']+'"data-id="'+_data[i]['linksId']+'"data-url="" href="'+links+'"onclick=""target="_blank"><image src="'+icon+'"src="'+png+'"width="16px"height="16px"/>&nbsp'+_data[i]['name']+'</a>';
					}
					$("#win-share .win-content").html(html);
				}
				else
				{
					//$("#win-"+config.currentPart+" .win-content").html("<p class='hock-linkNull'>还没有添加任何内容哦！</p>");
				}
			});
		});
	 }
 }
 
/**
 * 设置面板中修改模块内容来源
 *
 *
 *
 *
 */
function setChangeFrom(partsId,_this)
{
	$("#from").unbind("blur").bind("blur",function(){
		var from = $(this).val();
		_this.data("from",from);
		$.post(config.domain+'setChangeFrom',{partsId:partsId,from:from},function(data){
			if(data=="true"){
				var messageinfo = $("#messageinfo");
				messageinfo.html("新来源已保存").fadeIn(2000);
				function hide()
				{
					messageinfo.fadeOut(2000);
				}
				setTimeout(hide,1000);
			}
		});
	});
}


/**
 * 设置面板中修改来源密码
 *
 *
 *
 *
 */
function setChangeFromPassword(partsId,_this)
{
	$("#otherPassword").unbind("blur").bind("blur",function(){
		var otherPassword = $(this).val();
		_this.data("otherpassword",otherPassword);
		$.post(config.domain+'setChangeFromPassword',{partsId:partsId,fromPassword:otherPassword},function(data){
			if(data=="true"){
				var messageinfo = $("#messageinfo");
				messageinfo.html("新密码已保存").fadeIn(2000);
				function hide()
				{
					messageinfo.fadeOut(2000);
				}
				setTimeout(hide,1000);
			}
		});
	});
}

/**
 * 设置面板中修改密码
 *
 *
 *
 *
 */
function setChangePassword(partsId,_this)
{
	$("#password").unbind("blur").bind("blur",function(){
		var password = $(this).val();
		_this.data("password",password);
		$.post(config.domain+'setChangePassword',{partsId:partsId,password:password},function(data){
			if(data=="true"){
				var messageinfo = $("#messageinfo");
				messageinfo.html("新密码已保存").fadeIn(2000);
				function hide()
				{
					messageinfo.fadeOut(2000);
				}
				setTimeout(hide,1000);
			}
		});
	});
}

/**
 * 设置面板中修改隐私状态
 *
 *
 *
 *
 */
function setChangePrivate(partsId,_this,privates)
{
	privates.unbind('switchChange.bootstrapSwitch').bind('switchChange.bootstrapSwitch', function(event, state) {
		var state2='';
		
		if(state==true)
		{
			state2=1;
			//当模块对外开放时没必要设置密码，所以不允许修改密码
			document.getElementById("password").setAttribute("disabled","disabled");
			
		}
		else
		{
			state2=0;
			$("#password").removeAttr("disabled");
		}
		_this.data("private",state2);
		$.post(config.domain+'setChangePrivate',{partsId:partsId,private:state},function(data){
			var messageinfo = $("#messageinfo");
			messageinfo.html("隐私状态已修改").fadeIn(2000);
			function hide()
			{
				messageinfo.fadeOut(2000);
			}
			setTimeout(hide,1000);
		});
	});
	
	
}
/**
 * 设置面板中获取用户模块
 *
 *
 *
 *
 */
function setGetParts()
{
	
	$.post(config.domain+'getParts',function(data){
		var _data = JSON.parse(data);
		var html = '';
		var length = _data.length;
		for(var i= 0;i<length;i++)
		{
			html +='<li id=""class="" data-partsid="'
			     +_data[i]['partsId']+'"data-title="'
				 +_data[i]['title']+'"data-state="'
			     +_data[i]['state']+'"data-private="'
				 +_data[i]['private']+'"data-password="'
				 +_data[i]['password']+'"data-order="'
				 +_data[i]['order']+'"data-from="'
				 +_data[i]['from']+'"data-otherPassword="'
				 +_data[i]['otherPassword']+'"data-sort="'
				 +_data[i]['sort']+'">'
			     +_data[i]['title']+'</li>';
		}
		$(".win-part").html(html);
		
		//为每一个标题绑定点击事件
		lib.setOpenEach();
	});
}

/**
 * 设置面板中打开某一模块
 *
 *
 *
 *
 */
 
function setOpenEach()
{
	var _this;
	var partsId;
	var title;
	$(".win-part li").unbind("click").bind("click",function(){
		$(".win-detail").show();
		_this = $(this);
		title = _this.data("title");
		partsId = _this.data("partsid");
		$("#title").val(title);
		$('[type="checkbox"]').bootstrapSwitch();
		//state
		var state = $("#state");
		if(_this.data("state")===1)
		{
			state.bootstrapSwitch('state',true,true);
		}
		else
		{
			state.bootstrapSwitch('state',false,true);
		}
		//private
		var privates = $("#private");
		if(_this.data("private")===1)
		{
			privates.bootstrapSwitch('state',true,true);
		}
		else
		{
			privates.bootstrapSwitch('state',false,true);
		}
		//password
		var password = _this.data("password");
		var froms = _this.data("from");
		var otherPassword = _this.data("otherpassword");
		$("#password").val(password);
		$("#from").val(froms);
		$("#otherPassword").val(otherPassword);
		lib.setChange(partsId,_this);
		lib.setChangePrivate(partsId,_this,privates);
		//由于输入框中的内容是即时获取所以不用传入第三个参数
		lib.setChangePassword(partsId,_this);
		lib.setChangeFrom(partsId,_this);
		lib.setChangeFromPassword(partsId,_this);
	});
}

/**
 * 设置面板中修改模块设置
 *
 *
 *
 *
 */
 
function setChange(partsId,_this)
{
	
	$("#title").unbind("blur").bind("blur",function(){
		var title = $(this).val();
		_this.html(title);
		$.post(config.domain+"setChange",{partsId:partsId,title:title},function(data){
			
			var messageinfo = $("#messageinfo");
			messageinfo.html("标题已修改").fadeIn(2000);
			function hide()
			{
				messageinfo.fadeOut(2000);
			}
			setTimeout(hide,1000);
			$("#win-setting .closes").click(function(){
				window.location.reload();
			});
		});
	});
}

//重新为链接排序
//ui为$(this)
//model值为0或1，0代表两个模块状态下的第一个模块，1代表第二个模块
function resortLink(event,ui,model){
	var sort = ui.sortable("toArray",{attribute:"data-id"});
	var partId = system.openWinpartId[model];
	$.post(config.domain+"resortLink",{sort:sort,partId:partId},function(data){
		//alert(system.openWin[model]);
		//alert($("#win-"+system.openWin[model]+".win-content").html());
		//此处需要隐藏"还没有添加任何内容哦！"这句话
	});
}

//启动编辑功能，使链接可在模块间移动
function edit(){
	//1.先验证内存中的工具是不是当前点击工具
	//2.验证工具是打开还是关闭状态
	//3.绑定事件，在事件中再做一次验证
	//工具有两种状态，从第一次点击工具进入和从别的工具进入
	
		if(system.tool=='edit')
		{
			if(system.openWin.length<=2)
			{
				var clickList = $(".win-list");
				clickList.hover(function(){
					var _this = $(this);
					_this.css({"cursor":"move"});
						});
				var length = system.openWin.length;
				switch(length){
					case 1:
						$("#win-"+system.openWin[0]+" .win-content").sortable({
							revert: true,
							zIndex:2,
							cursor:"move",
							update:function(event,ui){
								lib.resortLink(event,$(this),0);
							}});
					break;
					case 2:
						$("#win-"+system.openWin[0]+" .win-content").sortable({
							"connectWith":"#win-"+system.openWin[1]+" .win-content",
							revert: true,
							zIndex:2,
							cursor:"move",
							update:function(event,ui){
								lib.resortLink(event,$(this),0);
							}});
						$("#win-"+system.openWin[1]+" .win-content").sortable({
							"connectWith":"#win-"+system.openWin[0]+" .win-content",
							revert: true,
							zIndex:2,
							cursor:"move",
							update:function(event,ui){
								lib.resortLink(event,$(this),1);
							}});
					break;
					default:
						$("#win-"+system.openWin[0]+" .win-content").sortable({
							revert: true,
							zIndex:2,
							cursor:"move",
							update:function(event,ui){
								lib.resortLink(event,$(this),0);
							}});
					break;
				}
			}
			else
			{
				//还需要关闭链接移动功能
				//通过限制后面的模块不打开保证其功能可用
				
				$("#win-"+system.openingWin).hide();
				var length = system.openWin.length;
				for(var i=0;i<length;i++)
				{
					if(system.openWin[i]==system.openingWin)
					{
						system.openWin.splice(i,1);
						system.openWinpartId.splice(i,1);
					}
				}
				//alert("目前只支持2个模块同时管理链接，您已经打开了两个模块！");
				jFade('两模块间可管理链接，您已经打开了两个模块！','提示!', config);
			}
		}
		var edit = $(".edit");
		edit.unbind("click").bind("click",function(){
			var tool = 'edit';
			if(system.tool===tool)
			{
				//相同则切换本工具状态，取消工具
				system.tool='';
				$(".win-content").sortable();
				$(".win-content").sortable("destroy");
				var clickList = $(".win-list");
				clickList.hover(function(){
					var _this = $(this);
					_this.css("cursor","pointer");
					});
			}
			else
			{
				if(system.openWin.length<=2)
				{
					//首先要关闭已经打开的功能，如：删除链接功能
					
					
					system.tool = tool;
					//不同，然后直接开始操作，取消之前的当前事件
					var clickList = $(".win-list");
					clickList.unbind();
					clickList.hover(function(){
						var _this = $(this);
						_this.css({"cursor":"move"});
						//取消链接上之前绑定的事件并还原url值
						//原定要在此处还原url值，经仔细分析决定在鼠标移出时即立刻还原url的值和去除事件
						/*var url = _this.data("url");
						if(url!='')
						{
							//alert(url);
							_this.attr({"href":url,"onclick":""});
						}*/
							});
							
					var length = system.openWin.length;
					switch(length){
							case 1:
								$("#win-"+system.openWin[0]+" .win-content").sortable({
									revert: true,
									zIndex:2,
									cursor:"move",
									update:function(event,ui){
										lib.resortLink(event,$(this),0);
									}});
							break;
							case 2:
								$("#win-"+system.openWin[0]+" .win-content").sortable({
									"connectWith":"#win-"+system.openWin[1]+" .win-content",
									revert: true,
									zIndex:2,
									cursor:"move",
									update:function(event,ui){
										lib.resortLink(event,$(this),0);
									}});
								$("#win-"+system.openWin[1]+" .win-content").sortable({
									"connectWith":"#win-"+system.openWin[0]+" .win-content",
									revert: true,
									zIndex:2,
									cursor:"move",
									update:function(event,ui){
										lib.resortLink(event,$(this),1);
									}});
							break;
							default:
								$("#win-"+system.openWin[0]+" .win-content").sortable({
									revert: true,
									zIndex:2,
									cursor:"move",
									update:function(event,ui){
										lib.resortLink(event,$(this),0);
									}});
							break;
						}
					}
				else
				{
					//alert("目前只支持2个模块同时管理链接，请先关闭多余的模块！");
					jFade('两模块间可管理链接，请先关闭多余的模块！','提示!', config);
				}
			}
		});
	
}
//向数据库提交调整顺序后的链接

//打开设置框
function openSetting(){
	$("#cog").click(function(){
		$("#win-setting").show();
		lib.setGetParts();
	});
}
//删除链接
//在获取模块链接功能中被调用
function trash(){
	//如果之前是打开的这个功能，则打开新窗口时还初始化删除功能
	if(system.tool==='trash')
	{
		var clickList = $(".win-list");
		clickList.hover(function(){
			var _this = $(this);
			_this.css({"cursor":"url(../sourse/images/delete.ico),auto"});
			var url = _this.attr("href");
			_this.attr({"href":"javascript:;","onclick":"return false;"});
			_this.unbind("mouseleave").bind("mouseleave",function(){
				$(this).attr({"href":url,"onclick":""});
			});
			clickList.unbind("click").bind("click",function(){
				var id = $(this).data("id");
				$(this).remove();
				$.post(config.domain+"delLinks",{id:id},function(data){//alert(data);
					
				});
			});
			});
	}
	var trash = $(".trash");
	//为工具按钮绑定删除链接功能
	trash.unbind("click").bind("click",function(){
		var tool = 'trash';
		
		if(system.tool===tool)
		{
			//若已经打开工具则切换本工具状态
			system.tool = '';
			var clickList = $(".win-list");
			clickList.css("cursor","pointer");
			//清除所有绑定事件
			clickList.unbind();
		}
		else
		{
			//取消排序功能
			$(".win-content").sortable();
			$(".win-content").sortable("destroy");
			
			//若还没打开工具则表示本次点击为打开此功能，进入删除链接功能
			system.tool = tool;
			var clickList = $(".win-list");
			clickList.hover(function(){
				var _this = $(this);
				//此处要针对单个链接设置才能保证鼠标效果不出错
				_this.css({"cursor":"url(../sourse/images/delete.ico),auto"});
				var url = _this.attr("href");
				_this.data("url",url);
				_this.attr({"href":"javascript:;","onclick":"return false;"});
				_this.unbind("mouseleave").bind("mouseleave",function(){
					$(this).attr({"href":url,"onclick":""});
					//alert($(this).attr("href"));
				});
				clickList.unbind("click").bind("click",function(){
					var id = $(this).data("id");
					$(this).remove();
					$.post(config.domain+"delLinks",{id:id},function(data){//alert(data);
						
					});
				});
				});
		}
	});
}
/*获取session*/
function getSession(){
	$.post(config.domain+"getSession",function(data){
		if(data==='')
		{
			data="您还未登录";
		}
		lib.select("#showUserName").innerHTML='<span class="glyphicon glyphicon-user"></span>&nbsp '+data+'<span class="caret"></span>';
	
	});
}
//选择器，目前只能选#id和.class
function select(string){
    var isId = new RegExp("#");
    var isClass = new RegExp(".");
    if(isId.test(string)===true)
    {
        var idArray = string.split("#");
        var id = idArray[1];
        return document.getElementById(id);
    }
    else if(isClass.test(string)===true)
    {
        var classArray = string.split(".");
        var thisClass = classArray[1];
        var btn = document.getElementsByTagName("*");
        for(var i=0 ; i<btn.length ; i++)
        {
            if(btn[i].className===thisClass)
            {
                return btn[i];
                break;
            }
        }
    }
    else
    {
        //alert("不是id选择");
		jFade('不是id选择！','提示!', config);
    }
}
//drag grid: [ 50, 20 ],
function drag(){
	$("body").droppable();
	$(".win").draggable({
  zIndex: 100
});
}
//drop
function drop(){
	
}
//关闭当前窗口
function close(){
	var window = $(".closes");
	window.on("click",function(){
		$(this).parent().parent().parent().parent().hide(300);
		var part = $(this).data("part");
		var length = system.openWin.length;
		for(var i=0;i<length;i++)
		{
			if(system.openWin[i]==part)
			{
				system.openWin.splice(i,1);
				system.openWinpartId.splice(i,1);
			}
		}
	});
}
//打开当前窗口
function open(){
	var graid = $(".graid-each");
	graid.on("click",function(){
		var object_this = $(this);
		var part = 	object_this.data("part");
		system.openingWin = part;
		var partsId = object_this.data("partsid");
		var title = object_this.children('.caption').html();
		config.currentPart = part;
		system.currentPartId = partsId;
		var id  = "#win-"+part;
		var win_this = $(id);
		win_this.show(300)
		$(id+" .title").html(title);
		$(id+" .closes").data("part",part);
		$(id+" .plus").data("partId",partsId);
		$(id+" .plus").data("part",part);
		lib.getLinks(partsId);
		lib.openAddLinks();
		
		
		
		
		
		//分享链接功能
		//由于无法实现复制到剪贴板功能并且通过其它方式分享很麻烦，目前直接弹出窗口提示用户复制自己发送
		$(".alt").unbind("click").bind("click",function(){
			//alert("ctrl+c复制链接："+config.share+"?part="+system.currentPartId);
			jFade("ctrl+c复制链接："+config.share+"?part="+system.currentPartId,'提示!', config);
		});
		
		
		
		
		
		$(".win").css("z-index","0");
		win_this.css("z-index","1");
		//用数组记录窗口是否打开，便于链接管理部分控制只有两个模块同时开启
		var length = system.openWin.length;
		var isIn = false;
		for(var i=0;i<length;i++)
		{
			if(part==system.openWin[i])
			{
				isIn =true;
				break;
			}
		}
		if(isIn==false)
		{
			system.openWin.push(part);
			system.openWinpartId.push(partsId);
		}
	});
}
//将当前活动窗口置顶
function activeWin()
{
	var win = $(".win");
	win.mousedown(function(){
		win.css("z-index","0");
		$(this).css("z-index","1");
	});
}
//获取窗口中的所有链接
function getLinks(partsId){
	$.post(config.domain+"getLinks",{partsId:partsId},function(data){
		var _data = JSON.parse(data);
		var length = _data.length;
		if(length!=0)
		{
			var html = '';
			for(var i=0;i<length;i++)
			{
				var icon = _data[i]['pic'];
				var png = '';
				var links = _data[i]['links'];
				if(icon==='')
				{
					icon = 'http://'+lib.getHost(links)+'/favicon.ico';
					png = links+'favicon.png';
				}
				html+='<a class="win-list"data-part="'+_data[i]['partId']+'"data-id="'+_data[i]['linksId']+'"data-url="" href="'+links+'"onclick=""target="_blank"><image src="'+icon+'"width="16px"height="16px"/>&nbsp'+_data[i]['name']+'</a>';
			}
			$("#win-"+config.currentPart+" .win-content").html(html);
		}
		else
		{
			//$("#win-"+config.currentPart+" .win-content").html("<p class='hock-linkNull'>还没有添加任何内容哦！</p>");
		}
		//检查是否进入链接移动功能
		lib.edit();
		//检查是否进入链接删除功能
		lib.trash();
	});
}
//打开添加链接模态框提交链接
function openAddLinks(){
	
	$(".plus").unbind("click").bind("click",function(){
		
		$('#myModal').modal('show');
		system.currentPartId = $(this).data("partId");
		config.currentPart = $(this).data("part");
		var saveLinks = $("#saveLinks");
		saveLinks.unbind("click").bind('click',function(){
			var linkName = $("#linkname").val();
			var links = $("#links").val();
			var partsId = system.currentPartId;
			$.post(config.domain+"addLinks",{partsId:partsId,linkName:linkName,links:links},function(data){
				if(data==='true')
				{
					//alert("添加成功！");
					jFade("添加成功！",'提示!', config);
					$('#myModal').modal('hide');
					$("#links").val('');
					$("#linkname").val('');
					//刷新窗口中的链接列表
					//alert(system.tool);
					lib.getLinks(config.currentPart);
				}
				else if(data==='notlogin')
				{
					
				}
				else
				{
					
				}
			});
		});
	});
	
}
//获取所有用户已经打开的模块
function getParts()
{
	$.post(config.domain+'getParts',function(data){
		var _data = JSON.parse(data);
		var html = '';
		var length = _data.length;
		for(var i= 0;i<length;i++)
		{
			html+='<a href="javascript:;"class="graid-each" data-part="'+_data[i]['sort']+'"data-partsid="'+_data[i]['partsId']+'"><div class="caption">'+_data[i]['title']+'</div></a>';
		}
		$(".graid").html(html);
		lib.open();
		});
}

//使用百度搜索时记录关键词
recordeKeyWord();
function recordeKeyWord(){
	$("#search-button").on('click',function(){
		var keyWord = $('#word').val();
		$.post(config.domain+'recordKeyWord',{keyWord:keyWord},function(data){
			
		});
	});
}