<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>我的主页，QQ登录页面</title>
<script src="http://www.freesite.cc/sourse/js/jquery.1.11.3.min.js"></script>
<script type="text/javascript" src="http://qzonestyle.gtimg.cn/qzone/openapi/qc_loader.js" data-appid="101281766" data-redirecturi="http://www.freesite.cc/index.php/welcome/loadQQLogin"charset="utf-8" ></script>
<script type="text/javascript">
//QQ登录验证
	//从页面收集OpenAPI必要的参数。get_user_info不需要输入参数，因此paras中没有参数
var paras = {};
var nickName = '';
var openIds = '';
var accessTokens = '';
if(QC.Login.check()){//如果已登录
QC.api("get_user_info", paras).success(function(s){
		nickName = s.data.nickname;
		$.post("http://www.freesite.cc/index.php/welcome/QQLogin",{nickName:nickName,unionId:openIds,accessToken:accessTokens},function(data){
			if(data==='true')
			{
				var html = "<a id='hock_close'href='http://www.freesite.cc/pages/index.php'target='_blank'>登录成功，返回主页</a>";
				$("body").html(html);
				$("#hock_close").on("click",function(){
					window.close();
				});
			}
		});
	}).error(function(f){
		//失败回调
		alert("获取用户信息失败！");
	}).complete(function(c){
		//完成请求回调
		alert("获取用户信息完成！");
	});
	QC.Login.getMe(function(openId, accessToken){
		openIds = openId;
		accessTokens = accessToken;
		//alert(["当前登录用户的", "openId为："+openId, "accessToken为："+accessToken].join("\n"));
	});
	//这里可以调用自己的保存接口
	//...
}

</script>
</head>
<body>

</body>
</html>