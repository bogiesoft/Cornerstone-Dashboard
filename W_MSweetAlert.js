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
		var material=$("#material").val();
		var type=$("#type").val();
		var vendor=$("#vendor").val();

		$.ajax({
			type: "POST",
			url: "checkW_MDup.php",
			data:{material:material,type:type,vendor:vendor},
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
		swal("Error!", "This Weights and Measures has already been added.", "error");
	};

	function warnBeforeRedirect() {
		swal({   title: "Are you sure?",   text: "You will not be able to recover this Weights and Measures!",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   closeOnConfirm: false }, 
			function(){ swal({   title: "Deleted!",   text: "This Weights and Measures has been deleted.",   type: "success",      confirmButtonColor: "#4FD8FC",   confirmButtonText: "OK",   closeOnConfirm: true }, 
				function(){ deleteNotClicked=false; $( ".delete-btn" ).click();});  
		});
	};

	function showSaveMessage(){
		swal({   title: "Saved!",   text: "This Weights and Measures has been saved.",   type: "success",      confirmButtonColor: "#4FD8FC",   confirmButtonText: "OK",   closeOnConfirm: true }, 
			function(){ saveNotClicked=false; $( ".store-btn" ).click();});  
	};
});