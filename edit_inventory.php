<?php
require ("connection.php");
$material_id = $_GET["material_id"];
if(isset($_POST["submit_form"])){
	$material = $_POST["material"];
	$type = $_POST["type"];
	$vendor = $_POST["vendor"];
	$location = $_POST["location"];
	$material_color = $_POST["material_color"];
	$quantity = $_POST["quantity"];
	$per_box = $_POST["per_box"];
	
	mysqli_query($conn, "UPDATE inventory SET material = '$material', type = '$type', vendor = '$vendor', location = '$location', material_color = '$material_color', quantity = '$quantity', per_box = '$per_box' WHERE material_id = '$material_id'");
	header("location: inventory.php");
}
else if(isset($_POST["delete_form"])){
	mysqli_query($conn, "DELETE FROM inventory WHERE material_id = '$material_id'");
	header("location: inventory.php");
}
require ("header.php");

$result = mysqli_query($conn, "SELECT * FROM inventory WHERE material_id = '$material_id'");
$data = $result->fetch_assoc();

$material = $data["material"];
$type = $data["type"];
$vendor = $data["vendor"];
$location = $data["location"];
$material_color = $data["material_color"];
$quantity = $data["quantity"];
$per_box = $data["per_box"];
?>
<script>
var deleteNotClicked=true;
var saveNotClicked=true;
$(document).ready(function(){

	$(".save-btn").click(function(e){
		if(saveNotClicked)
		{ 
			showSaveMessage();
		}
	});
	
	function showSaveMessage(){
		swal({   title: "Updated!",   text: "Inventory has been saved.",   type: "success",      confirmButtonColor: "#4FD8FC",   confirmButtonText: "OK",   closeOnConfirm: true }, 
			function(){ saveNotClicked=false; $( ".store-btn" ).click();});  
	};
});
</script>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Edit Inventory</h1>
	<a class="pull-right" href="inventory.php" style="margin-right:20px; background-color:#d14700;">Back to Inventory</a>
	<div class="clear"></div>
	</div>
<div class="dashboard-detail">
	<div class="newcontacts-tabs">
		<!---- Nav Tabs ---->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true">Edit Info</a></li>
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
					<option value = "<?php echo $material; ?>" selected = "select"><?php echo $material; ?></option>
					<?php
					$result_materials = mysqli_query($conn, "SELECT DISTINCT material FROM materials WHERE vendor = 'CRST Inventory' AND material != '$material'");
					while($row_materials = $result_materials->fetch_assoc()){
						$material_id = $row_materials["material"];
						echo "<option value = '" . $material_id . "'>" . $material_id . "</option>";
					}
					?>
					</select>
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Type</label>
					<select id="type" name="type" class="contact-prefix">
					<option value = "<?php echo $type; ?>" selected = "select"><?php echo $type; ?></option>
					<?php
						$result_type = mysqli_query($conn, "SELECT DISTINCT type FROM materials WHERE vendor = 'CRST Inventory' AND material = '$material' AND type != '$type'");
						while($row_type = $result_type->fetch_assoc()){
							$type_id = $row_type["type"];
							echo "<option value = '" . $type_id . "'>" . $type_id . "</option>";
						}
					?>
					</select>
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Vendor</label>
					<select name = "vendor">
					<option select = "selected" value = "<?php echo $vendor;?>"><?php echo $vendor; ?></option>
					<?php
						$result = mysqli_query($conn, "SELECT * FROM vendors");
						while($row = $result->fetch_assoc()){
							$vendor = $row["vendor_name"];
							echo "<option value = '" . $vendor . "'>" . $vendor . "</option>";
						}
					?>
					</select>
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Location</label>
					<input name="location" type="text" class="contact-prefix" value = "<?php echo $location; ?>">
					<div class="clear"></div>
					</div>
				</div>
				<div class="newcontacttab-inner">
					<div class="tabinner-detail">
					<label>Color</label>
					<input name="material_color" type="text" class="contact-prefix" value = "<?php echo $material_color; ?>">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Quantity</label>
					<input name="quantity" type="text" class="contact-prefix" value = "<?php echo $quantity; ?>">
					<div class="clear"></div>
					</div>
					<div class="tabinner-detail">
					<label>Per Box</label>
					<input name="per_box" type="text" class="contact-prefix" value = "<?php echo $per_box; ?>">
					<div class="clear"></div>
					</div>
				</div>
				</div>
				<div class="newcontact-tabbtm">
					<input class="save-btn store-btn" type="submit" value="Save" name="submit_form" style="width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;">
					<input class="delete-btn store-btn" type="submit" value="Delete" name="delete_form" style="width:200px; font-size:16px; background-color:#d14700; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;">
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