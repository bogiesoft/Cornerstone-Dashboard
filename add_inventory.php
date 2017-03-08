<?php
require ("connection.php");
if(isset($_POST["submit_form"])){
	$material = $_POST["material"];
	$type = $_POST["type"];
	$vendor = $_POST["vendor"];
	$location = $_POST["location"];
	$material_color = $_POST["material_color"];
	$quantity = $_POST["quantity"];
	$per_box = $_POST["per_box"];
	
	mysqli_query($conn, "INSERT INTO inventory (material, type, vendor, location, material_color, quantity, per_box) VALUES ('$material', '$type', '$vendor', '$location', '$material_color', '$quantity', '$per_box')");
	header("location: inventory.php");
}
require ("header.php");
?>
<script>
var deleteNotClicked=true;
var saveNotClicked=true;
$(document).ready(function(){

	$(".store-btn").click(function(e){
		if(saveNotClicked)
		{ 
			showSaveMessage();
		}
	});
	
	function showSaveMessage(){
		swal({   title: "Saved!",   text: "Inventory has been saved.",   type: "success",      confirmButtonColor: "#4FD8FC",   confirmButtonText: "OK",   closeOnConfirm: true }, 
			function(){ saveNotClicked=false; $( ".store-btn" ).click();});  
	};
});
</script>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Add Inventory</h1>
	<a class="pull-right" href="inventory.php" style="margin-right:20px; background-color:#d14700;">Back to Inventory</a>
	<div class="clear"></div>
	</div>
<div class="dashboard-detail">
	<div class="newcontacts-tabs">
		<!---- Nav Tabs ---->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true">Add Info</a></li>
		</ul>
		<!--- Tab Panes --->
	<div class="newcontactstabs-outer">
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="home">
			<div class="newcontactstab-detail">
			<form action="" method="post">
				<div class="newcontacttab-inner">
					<div class="tabinner-detail">
					<label>Material</label>
					<select id="material" name="material" class="contact-prefix" onchange = "generateTypes()">
					<option value = "0" select = "selected">--Select Material--</option>
					<?php
						$result = mysqli_query($conn, "SELECT DISTINCT material FROM materials WHERE vendor = 'CRST Inventory'");
						while($row = $result->fetch_assoc()){
							$material = $row["material"];
							echo "<option value = '$material'>$material</option>";
						}
					?>
					</select>
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Type</label>
					<select id = "type" name = "type" class = "contact-prefix">
					<option selected = "selected" value = "0">--Select Type--</option>
					</select>
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Vendor</label>
					<select name = "vendor">
					<?php
						$result2 = mysqli_query($conn, "SELECT * FROM vendors WHERE vendor_name != 'CRST Inventory'") or die("error");
						while($row2 = $result2->fetch_assoc()){
							$vendor_name = $row2["vendor_name"];
							echo "<option value = '" . $vendor_name . "'>" . $vendor_name . "</option>";
						}
						
						echo "</select>";
					?>
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Location</label>
					<input name="location" type="text" class="contact-prefix">
					<div class="clear"></div>
					</div>
				</div>
				<div class="newcontacttab-inner">
					<div class="tabinner-detail">
					<label>Color</label>
					<input name="material_color" type="text" class="contact-prefix">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Quantity</label>
					<input name="quantity" type="text" class="contact-prefix">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Per Box</label>
					<input name="per_box" type="text" class="contact-prefix">
					<div class="clear"></div>
					</div>
				</div>
				</div>
				<div class="newcontact-tabbtm">
					<input class="save-btn store-btn" type="submit" value="Save" name="submit_form" style="width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;">
				</div>
			</form>
			
			</div>
		</div>
	</div>
	</div>
</div>
</div>
<script>
function generateTypes(){
	var material_id = $("#material").val()
	$.ajax({
    type: "POST",
    url: "create_type_list.php",
    data: 'material=' + material_id,
    dataType: "json", // Set the data type so jQuery can parse it for you
    success: function (data) {
        $("#type").empty();
		$('#type').append($('<option>', {select: "selected", value:0, text:"--Choose Type--"}));
		for(var i = 0; i < data.length; i++){
			$('#type').append($('<option>', {value:data[i], text:data[i]}));
		}
    }
});
}
</script>