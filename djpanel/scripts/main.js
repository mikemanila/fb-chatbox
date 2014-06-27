$(document).ready(function(){	
	Timer = setTimeout(function(){
			$(".error").fadeOut(3000);
			$(".success").fadeOut(3000);
		},3000);
	$("div#RequestList").load('reqlist.php');
	
	$('#RefreshReqList').click(function(){
		 $("#RequestList").load("reqlist.php")
	});
	/** var auto_refresh = setInterval(
	function()
	{
	$('#RequestList').load('reqlist.php');
	}, 10000);
	**/
	
	$('span.unban').click(function(){
		if (confirm("Do you really want to Unban this person?")){
			var ban_id = $(this).parent().parent().attr('id');
			var data = 'ban_id=' + ban_id ;
			var parent = $(this).parent().parent();
			$.ajax({
				type: "GET",
				url: "unban.php",
				data: data,
				cache: false,
					
				success: function()
					{
						parent.fadeOut('slow', function() {$(this).remove();});
					}
			});				
		}
	});
	
	

	$('span#removedj').click(function(){
		if (confirm("Remove DJ to the list?")){
			var dj_id = $(this).parent().parent().attr('id');
			var data = 'dj_id=' + dj_id ;
			var parent = $(this).parent().parent();
			$.ajax({
				type: "GET",
				url: "removedj.php",
				data: data,
				cache: false,
					
				success: function()
					{
						parent.fadeOut('slow', function() {$(this).remove();});
					}
			});				
		}
	});

	$('span#removeacc').click(function(){
		if (confirm("Remove account?")){
			var acc_id = $(this).parent().parent().attr('id');
			var data = 'acc_id=' + acc_id ;
			var parent = $(this).parent().parent();
			$.ajax({
				type: "GET",
				url: "deleteacc.php",
				data: data,
				cache: false,
					
				success: function()
					{
						parent.fadeOut('slow', function() {$(this).remove();});
					}
			});				
		}
	});
	
	$('span#clearList').click(function(){
		if (confirm("Are you sure you want to clear all the requested songs?")){
			$.ajax({
				type: "POST",
				url: "reqclear.php",
				cache: false,
					
				success: function()
					{
						$('div#RequestList').remove();
					}
			});				
		}
	});
});
function updateReqStatus(stat){
  $.get("updatesongreq.php", {stat: stat}, 
  function(){
    //in here you can do you stuff when the call returns
    alert("Song Request Status Has Been Changed!");
  });
}