var deleteNotClicked=true;
var saveNotClicked=true;
$( function() {
	$( ".store-btn" ).click(function(e) {
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
			warnBeforeRedirect();
		}
	});

	function warnBeforeRedirect() {
		swal({   title: "Are you sure?",   text: "You will not be able to recover this record!",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   closeOnConfirm: false }, 
			function(){ swal({   title: "Deleted!",   text: "Your record has been deleted.",   type: "success",      confirmButtonColor: "#4FD8FC",   confirmButtonText: "OK",   closeOnConfirm: true }, 
				function(){ deleteNotClicked=false; $( ".delete-btn" ).click();});  
		});
	};

	function showSaveMessage(){
		swal({   title: "Saved!",   text: "Your changes have been saved.",   type: "success",      confirmButtonColor: "#4FD8FC",   confirmButtonText: "OK",   closeOnConfirm: true }, 
				function(){ saveNotClicked=false; $( ".store-btn" ).click();});  
	};
});
