$.post("http://www.freesite.cc/index.php/Plugin/getName",function(data){
	if(data!='notlogin')
	{
		var data = JSON.parse(data);
		var html = '';
		var length = data.length;
		for(var i=0;i<length;i++)
		{
			html+="<option value='"+data[i]['partsId']+"'>"+data[i]['title']+"</option>";
		}
		var select = window.document.getElementById("part");
		select.innerHTML = html;
		//获取当前标签的id，并根据它获取父标签的id，父标签id在backgrond.js中有设置
		chrome.tabs.getCurrent(function(tab){
			var openerTabId = tab.openerTabId;
			chrome.tabs.get(openerTabId,function(tab2){
				window.document.getElementById("name").value = tab2.title;
				window.document.getElementById("link").value = tab2.url;
				//
				$("#btn").click(function(){
					var partId = window.document.getElementById("part").value;
					var title = window.document.getElementById("name").value;
					var link = window.document.getElementById("link").value;
					$.post("http://www.freesite.cc/index.php/Plugin/addLink",{menupopup:partId,link_name:title,link:link},function(data){
						if(data=="添加成功")
						{
							alert("添加成功！");
							chrome.tabs.remove(tab.id,function(){});
						}
						else
						{
							alert("添加失败，请重试");
						}
						
					});
				});
			});
			
			//
			});
		}
		else
		{
			alert("您还没有登录哦！请先登录");
			chrome.tabs.getCurrent(function(tab){
				chrome.tabs.update(tab.id,{url:"http://www.freesite.cc/index.php/welcome/loadlogin",selected:true,pinned:false}, function(){});
			});
		}
		});