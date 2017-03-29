var deleteNotClicked=true;
var saveNotClicked=true;
$(document).ready(function(){

	$(".store-btn").click(function(e){
		if(saveNotClicked)
		{ 
			e.preventDefault();
			checkDup();
		}
	});

	$( ".delete-btn" ).click(function(e) {
		if(deleteNotClicked)
		{ 
			e.preventDefault();
			warnBeforeRedirect();
		}
	});

	function checkDup(){
		var full_name=$("#full_name").val();
		var address_line_1=$("#address_line_1").val();
		var business = $("#business").val();
		$.ajax({
			type: "POST",
			url: "checkClientDup.php",
			data:{full_name:full_name,address_line_1:address_line_1, business:business},
			success:function(data){
				if(data=='duplicate')
				{
					showDuplicateMessage();
				}
				else
				{
					showSaveMessage();
				}
			}
		});
	};

	function showDuplicateMessage(){
		swal("Error!", "This client has already been added.", "error");
	};

	function warnBeforeRedirect() {
		swal({   title: "Are you sure?",   text: "You will not be able to recover this client!",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   closeOnConfirm: false }, 
			function(){ swal({   title: "Deleted!",   text: "This client has been deleted.",   type: "success",      confirmButtonColor: "#4FD8FC",   confirmButtonText: "OK",   closeOnConfirm: true }, 
				function(){ deleteNotClicked=false; $( ".delete-btn" ).click();});  
		});
	};

	function showSaveMessage(){
		swal({   title: "Saved!",   text: "This client has been saved.",   type: "success",      confirmButtonColor: "#4FD8FC",   confirmButtonText: "OK",   closeOnConfirm: true }, 
			function(){ saveNotClicked=false; $( ".store-btn" ).click();});  
	};
});