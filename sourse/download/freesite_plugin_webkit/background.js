chrome.contextMenus.create({
	title:"添加到我的主页",
	onclick:function(info,tab){
		chrome.tabs.create({
			index:0,
			url:'popup.html',
			active:true,
			pinned:false,
			openerTabId:tab.id
		});
		}
	},
function(){
	//alert("右键菜单创建成功！");
});

chrome.browserAction.onClicked.addListener(function(tab){
	chrome.tabs.create({
	index:0,
	url:'popup.html',
	active:true,
	pinned:false,
	openerTabId:tab.id
});
		
});