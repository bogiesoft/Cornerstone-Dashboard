<?php require("header.php"); ?>

<style>
.dataTables_wrapper .dt-buttons {
  float:none;
  text-align:right;
}
th { font-size: 12px; }
td { font-size: 11px; }
	div.header {
			margin: 200px auto;
			line-height:30px;
			max-width:500px;
	}
	body {
			background: #f7f7f7;
			color: #333;
			font: 90%/1.45em "Helvetica Neue",HelveticaNeue,Verdana,Arial,Helvetica,sans-serif;
	}
</style>
<script type="text/javascript" language="javascript" >

	$(document).ready(function() {
		var dataTable = $('#crm-table').DataTable( {
			lengthMenu: [[25, 100, -1], [25, 100, "All"]],
			pageLength: 25,

			dom: 'Blfrtip',
			buttons: ['selectAll','selectNone',
				{
					extend: 'collection',
	        text: 'Export Selected',
	        buttons: [
					{
						extend: 'copy',
						exportOptions: {
						columns: ':visible:not(.not-exported)',
						 modifier: { selected: true }
						}
					},{
						extend: 'csv',
						exportOptions: {
						columns: ':visible:not(.not-exported)',
						 modifier: { selected: true }
						}
					},{
						extend: 'excel',
						exportOptions: {
						columns: ':visible:not(.not-exported)',
						 modifier: { selected: true }
						}
					},{
						extend: 'pdf',
						exportOptions: {
						columns: ':visible:not(.not-exported)',
						 modifier: { selected: true }
						}
					},{
						extend: 'print',
						exportOptions: {
						columns: ':visible:not(.not-exported)',
						 modifier: { selected: true }
						}
					}
				]
      }],
			select: {style: 'multi'},

			// "tableTools": {
      //   "sSwfPath": "swf/copy_csv_xls_pdf.swf",  // set swf path
			// 	"sRowSelect": "multi",
			// 	"aButtons": [
      //       "select_all",
      //       "select_none",
      //       {
      //           "sExtends":    "collection",
      //           "sButtonText": "Export",
      //           "aButtons":    [ "csv", "xls", "pdf","print" ]
      //       }
      //   ]
    	// },
			"processing": true,
			"serverSide": true,
			"scrollX": true,
			"bInfo": true,
			"ajax":{
				url :"server-side-CRM.php", // json datasource
				type: "post",  // method  , by default get
				error: function(){  // error handling
					$(".crm-table-error").html("");
					$("#crm-table").append('<tbody class="crm-table-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
					$("#crm-table_processing").css("display","none");
				}
			},
			"columnDefs": [ {
			    "targets": 0,
			    "render": function ( data, type, row) {
						var image = [row[0],row[1]];
						var serializedArray = JSON.stringify(image);
			      return '<a href="edit_client.php?client_info='+serializedArray+'">'+row[0]+'</a>';
			    }
			  } ]

		});


		$('.search-input-text').on( 'keyup click', function () {   // for text boxes
			var i =$(this).attr('data-column');  // getting column index
			var v =$(this).val();  // getting search input value
			dataTable.columns(i).search(v).draw();
		});
	$('.search-input-select').on( 'change', function () {   // for select box
			var i =$(this).attr('data-column');
			var v =$(this).val();
			dataTable.columns(i).search(v).draw();
		});

// //If any row selected change the counter of "Row selected".
		$('#crm-table tbody').on( 'click', 'tr', function () {
					updateCounter();
		});

//Select All button and select none button
	$('.buttons-select-all, .buttons-select-none').on( 'click', function () {
			updateCounter();
		});

		function updateCounter(){
			var len = dataTable.rows('.selected').data().length;
			if(len>0){
				$("#general i .counter").text('('+len+')');
			}
			else{$("#general i .counter").text('');}
		}
	});



</script>

<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
		<h1 class="pull-left">CRM</h1>
		<a title="Filter Category" id="general" class=""><i>Record selected <small class="counter"></small></i></a>
		<a class="pull-right" href="uploadForm.php" class="add_button">Upload</a>
	</div>
<div class="dashboard-detail">

			<div class="contacts-title">
				<a id = 'view_marked' name = 'view_marked' class="pull-right" class="add_button" href = "#" style = "background: #ff5c33">View Marked</a>
				<a id = 'advanced_search_button' class="pull-right" href="#" class="add_button" onclick = 'addField()'>Advanced Search</a>
				<a id = 'show_saved_search' class="pull-right" class="add_button" onclick = 'showSavedSearch()' href = "#" style = "background: #ff5c33">Show Saved Search</a>
				<form class = 'advanced_search_area' action = 'advanced_search_CRM.php' method = 'post'>
					<input id = 'advanced_search_submit' name = 'advanced_search_submit' style = 'display: none; margin-right: 5%; margin-bottom: 5%; background-color: #000000; color: #ffffff' type = 'submit' value = "Search">
					<input id = 'advanced_search_and_save' name = 'advanced_search_and_save' style = 'display: none; margin-bottom: 5%; background-color: #000000; color: #ffffff' type = 'submit' value = "Search and Save">
					<input id = 'advanced_save' name = 'advanced_save' style = 'display: none; margin-bottom: 5%; margin-left: 5%; background-color: #000000; color: #ffffff' type = 'submit' value = "Save">
					<input id = 'advanced_search_name' name = 'advanced_search_name' style = 'display: none; width: 200px; margin-left: 3%; margin-bottom: 3%' type = 'text' placeholder = 'Enter Saved Search Name'>
				</form>
			</div>
			<div id="saved_search_div">
				<table id="saved_search_table" style = 'display: none'>
					<tbody>
						<?php
						$result = mysqli_query($conn, "SELECT * FROM saved_search WHERE table_type = 'CRM' ORDER BY search_date DESC LIMIT 10");
						if (mysqli_num_rows($result) > 0) {
							// output data of each row
							while($row = $result->fetch_assoc()) {
								$search_id = $row["search_id"];
								$field1=$row["field1"];
								$value1=$row["value1"];
								$field2=$row["field2"];
								$value2=$row["value2"];
								$field3=$row["field3"];
								$value3=$row["value3"];
								echo "<tr id = 'row" . $search_id . "'><td class='data-cell'><a href = 'advanced_search_CRM.php?field1=$field1&value1=$value1&field2=$field2&value2=$value2&field3=$field3&value3=$value3&search_id=$search_id'>". $row["search_name"]."</a></td><td><button id = '" . $search_id . "'><img src = 'images/x_button.png' width = '25' height = '25'></button></tr>";
							}
						}
						else {
							echo "0 Saved Searches";
						}
						?>
					</tbody>
				</table>
			</div>
</div>
<div id = 'allcontacts-table' class='allcontacts-table'>

	<table id="crm-table"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
			<thead>
				<tr>
					<th>Client Name</th>
					<th>Business</th>
					<th>Address</th>
					<th>City</th>
					<th>State</th>
					<th>Zip Code</th>
					<th>Call Back Date</th>
					<th>Priority</th>
					<th>Title</th>
					<th>Phone</th>
					<th>Website</th>
					<th>Email</th>
					<th>Vertical 1</th>
					<th>Vertical 2</th>
					<th>Vertical 3</th>
				</tr>
			</thead>
			<thead>
			<tr>
				<td><input type="text" data-column="0"  placeholder = "Search Client Name" class="search-input-text"></td>
	      <td><input type="text" data-column="1"  placeholder = "Search Business" class="search-input-text"></td>
				<td><input type="text" data-column="2"  placeholder = "Search Address" class="search-input-text"></td>
				<td><input type="text" data-column="3"  placeholder = "Search City" class="search-input-text"></td>
				<td><input type="text" data-column="4"  placeholder = "Search State" class="search-input-text"></td>
				<td><input type="text" data-column="5"  placeholder = "Search Zip Code" class="search-input-text"></td>
				<td><input type="text" data-column="6"  placeholder = "Search Call Back Date" class="search-input-text"></td>

				<td>
            <select data-column="7"  class="search-input-select">
                <option value="">(Search Priority)</option>
								<option value="HIGH">HIGH</option>
                <option value="CALL">CALL</option>
                <option value="CALL BACK">CALL-BACK</option>
								<option value="MUST CALL">MUST CALL</option>
								<option value="LOW">LOW</option>
            </select>
        </td>
				<td><input type="text" data-column="8"  placeholder = "Search Title" class="search-input-text"></td>
				<td><input type="text" data-column="9"  placeholder = "Search Phone" class="search-input-text"></td>
				<td><input type="text" data-column="10"  placeholder = "Search Website" class="search-input-text"></td>
				<td><input type="text" data-column="11"  placeholder = "Search Email" class="search-input-text"></td>
				<td><input type="text" data-column="12"  placeholder = "Search Vertical1" class="search-input-text"></td>
				<td><input type="text" data-column="13"  placeholder = "Search Vertical2" class="search-input-text"></td>
				<td><input type="text" data-column="14"  placeholder = "Search Vertical3" class="search-input-text"></td>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
</div>
