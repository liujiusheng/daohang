$(document).ready(function(){
	var contentNode = $("#content");
	contentNode.Editor({'togglescreen':false}); 
	$("#hock_submit").click(function(){
		var content  = contentNode.Editor("getText"); 
		contentNode.val(content);
		});
	var addBlog = document.getElementById("hook-add-blog");
	$("#hook-add-blog").unbind("click").bind("click",function(){
		$('#myModal').modal('show');
	});
	
});