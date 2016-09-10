var deleteNotClicked=true;
$(document).ready(function(){
	var search_name;
	var field1;
	var value1;
	var field2;
	var value2;
	var field3;
	var value3;

	$(".store-btn").click(function(){
			checkDup();

	});

	$( ".delete-btn" ).click(function(e) {
		if(deleteNotClicked)
		{ 
			e.preventDefault();
			warnBeforeRedirect();
		}
	});

	function checkDup(){
		search_name = document.getElementById('search_name').value;
		field1 = $('#searchFields').attr("field1");
		value1 = $('#searchFields').attr("value1");
		field2 = $('#searchFields').attr("field2");
		value2 = $('#searchFields').attr("value2");
		field3 = $('#searchFields').attr("field3");
		value3 = $('#searchFields').attr("value3");
		$.ajax({
			type: "POST",
			url: "checkSearchDup.php",
			data:{field1:field1,value1:value1,field2:field2,value2:value2,field3:field3,value3:value3},
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
		swal("Error!", "This search has already been added.", "error");
	};

	function warnBeforeRedirect() {
		swal({   title: "Are you sure?",   text: "You will not be able to recover this search!",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   closeOnConfirm: false }, 
			function(){ swal({   title: "Deleted!",   text: "This search has been deleted.",   type: "success",      confirmButtonColor: "#4FD8FC",   confirmButtonText: "OK",   closeOnConfirm: true }, 
				function(){ deleteNotClicked=false; $( ".delete-btn" ).click();});  
		});
	};

	function showSaveMessage(){
		swal({   title: "Saved!",   text: "This search has been saved.",   type: "success",      confirmButtonColor: "#4FD8FC",   confirmButtonText: "OK",   closeOnConfirm: true }, 
			function(){
				$.ajax({
						type: "POST",
						url: "saveSearch.php",
						data:{search_name:search_name, field1:field1, value1:value1, field2:field2, value2:value2, field3:field3, value3:value3},
					});
			});  
	};
});