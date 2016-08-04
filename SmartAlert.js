var deleteNotClicked=true;
$( function() {
	$( ".delete-btn" ).click(function(e) {
		if(deleteNotClicked)
		{ 
			e.preventDefault();
			warnBeforeRedirect();
			deleteNotClicked=false;
		}
	});
	function warnBeforeRedirect() {
		swal({   title: "Are you sure?",   text: "You will not be able to recover this record!",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   closeOnConfirm: false }, 
			function(){ swal({   title: "Deleted!",   text: "Your record has been deleted.",   type: "success",      confirmButtonColor: "#4FD8FC",   confirmButtonText: "OK",   closeOnConfirm: true }, 
				function(){ document.getElementsByClassName("delete-btn")[0].click();});  
		});
	};
});
