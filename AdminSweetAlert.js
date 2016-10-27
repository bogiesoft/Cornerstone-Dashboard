var deleteNotClicked=true;
var saveNotClicked=true;
$(document).ready(function(){

	$(".save-btn").click(function(e){
		if(saveNotClicked)
		{ 
			e.preventDefault();
			showSaveMessage();
		}
	});

	$( ".delete-btn" ).click(function(e) {
		if(deleteNotClicked)
		{ 
			e.preventDefault();
			warnBeforeDelete();
		}
	});

	function showSaveMessage() {
		swal({   title: "Are you sure?",   text: "Account will be created",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#42f46b",   confirmButtonText: "Yes, save it!",   closeOnConfirm: false }, 
			function(){ swal({   title: "Saved!",   text: "Account created.",   type: "success",      confirmButtonColor: "#4FD8FC",   confirmButtonText: "OK",   closeOnConfirm: true }, 
				function(){ saveNotClicked=false; $( ".save-btn" ).click();});  
		});
	};
	
	function warnBeforeDelete() {
		swal({   title: "Are you sure?",   text: "You will not be able to recover this account!",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   closeOnConfirm: false }, 
			function(){ swal({   title: "Deleted!",   text: "This account has been deleted.",   type: "success",      confirmButtonColor: "#4FD8FC",   confirmButtonText: "OK",   closeOnConfirm: true }, 
				function(){ deleteNotClicked=false; $( ".delete-btn" ).click();});  
		});
	};
});