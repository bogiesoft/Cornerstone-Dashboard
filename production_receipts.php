<?php require ("header.php"); ?>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Archived Jobs</h1>
	</div>
	<div class="dashboard-detail">
		<div class="search-cont search-boxleft searchcont-detail">
				<label>Quick Search</label>
				<input id="searchbox" name="frmSearch" type="text" placeholder="Search for a specific receipt">
		</div>
		<div class="clear"></div>

		<div id = 'allcontacts-table' class='allcontacts-table'>
			<table id="archived-table"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
					<thead>
						<tr>
							<th>Job ID</th>
							<th>Material ID</th>
							<th>Expected Date Received</th>
							<th>CRST Pickup</th>
							<th>Initial</th>
							<th>Location</th>
							<th>Vendor</th>
						</tr>
					</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>
<style>
.dataTables_filter {
   display: none;
}
select[name="archived-table_length"] { border: 1px solid black; }
</style>
<script>
	$(document).ready(function() {
	//====================create datatable==========================================
	var dataTable = $('#archived-table').DataTable( {
			dom: '<"toolbar">lfrtip',
			"order": [[ 0, "asc" ]],
			"processing": true,
			"serverSide": true,
			"deferRender": false,
			"scrollX": true,
			"ajax":{
				url :"server-side-production_receipts.php", // json datasource
				type: "POST",  // method  , by default get
				error: function(){  // error handling
					$(".archived-table-error").html("");
					$("#archived-table").append('<tbody class="archived-table-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
					$("#archived-table_processing").css("display","none");
				}
			},
			"columnDefs": [ {
					"targets": 0,
					"render": function ( data, type, row) {
						return row[0]; //link for each client name
					},
			}
		]
	});
//==============================================================================
	$("#searchbox").on("keyup search input paste cut", function() {
		dataTable.search(this.value).draw();
	});
});
</script>