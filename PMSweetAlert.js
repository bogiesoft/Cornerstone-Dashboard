function checkPercent(percentValue, formID){
	if(percentValue < 100){
		showSaveMessage();
	}
	else{
		document.getElementById(formID).submit();
	}
}

function warnBeforeRedirect() {
		swal({   title: "Are you sure?",   text: "You will not be able to recover this documentation!",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   closeOnConfirm: false }, 
			function(){ swal({   title: "Deleted!",   text: "This vendor has been deleted.",   type: "success",      confirmButtonColor: "#4FD8FC",   confirmButtonText: "OK",   closeOnConfirm: true }, 
				function(){ deleteNotClicked=false; $( ".delete-btn" ).click();});  
		});
	}

function showSaveMessage(){
	swal({   title: "Not Complete",   text: "This Yellow Sheet Isn't Complete",   type: "warning",      confirmButtonColor: "#4FD8FC",   confirmButtonText: "OK",   closeOnConfirm: true }, 
		function(){ saveNotClicked=false; $( ".store-btn" ).click();});  
}