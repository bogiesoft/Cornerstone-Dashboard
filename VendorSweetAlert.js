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
		var vendor_name=$("#vendor_name").val();
		$.ajax({
			type: "POST",
			url: "checkVendorDup.php",
			data:{vendor_name:vendor_name,vendor_add:vendor_add},
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
		swal("Error!", "This vendor has already been added. Please update or delete old one.", "error");
	};

	function warnBeforeRedirect() {
		swal({   title: "Are you sure?",   text: "You will not be able to recover this vendor!",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   closeOnConfirm: false }, 
			function(){ swal({   title: "Deleted!",   text: "This vendor has been deleted.",   type: "success",      confirmButtonColor: "#4FD8FC",   confirmButtonText: "OK",   closeOnConfirm: true }, 
				function(){ deleteNotClicked=false; $( ".delete-btn" ).click();});  
		});
	};

	function showSaveMessage(){
		swal({   title: "Saved!",   text: "This vendor has been saved.",   type: "success",      confirmButtonColor: "#4FD8FC",   confirmButtonText: "OK",   closeOnConfirm: true }, 
			function(){ saveNotClicked=false; $( ".store-btn" ).click();});  
	};
});