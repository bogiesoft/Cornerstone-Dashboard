<?php
require ("header.php");
?>
<div class="content">
<div class="contacts-title">
	<h2>New Weights and Measure</h2>
	<a class="save-button" href="#">Save</a>
</div>
<div class="dashboard-detail">
	<div class="newcontacts-outer">
		<div class="tab-content">
			<form action="add_p_wm.php" method="post">
				<div class="newclienttab-inner">
				<?php
						$servername = "localhost";
						$username = "root";
						$password = "";
						$dbname= "crst_dashboard";
						// Create Connection
						$conn = new mysqli($servername, $username, $password, $dbname);
						$result = $conn->query("select vendor_name from vendors");
						echo("<div class='tabinner detail'>");
						//getting vendor from vendor table
						echo "<label>Vendor   </label><select name='vendor'>";
						while ($row = $result->fetch_assoc()) {
									  unset($vendor_name);
									  $vendor_name = $row['vendor_name']; 
									  echo '<option value="'.$vendor_name.'">'.$vendor_name.'</option>';
									 
						}
						echo "</select>";
						echo "</div>";
						//getting materials from weights and measure
						$result1 = $conn->query("select material from w_and_m");
						echo("<div class='tabinner detail'>");
						echo "<label>Material   </label><select name='material'>";
						
						while ($row1 = $result1->fetch_assoc()) {
									  unset($material);
									  $material = $row1['material']; 
									  echo '<option value="'.$material.'">'.$material.'</option>';
									 
						}
						echo "</select>";
						echo "<input name='material' type='text' class='contact-prefix'>";
						echo "</div>";
						?>
					<div class="tabinner detail">
					<label>Size</label>
					<input name="size" type="text" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Height</label>
					<input name="height" type="text" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Weight</label>
					<input name="weight" type="text" class="contact-prefix">
					</div>
					<div class="tabinner detail">
					<label>Based On</label>
					<select name="based_on" class="contact-prefix">
					  <option value="1">1</option>
					  <option value="5">5</option>
					  <option value="10">10</option>
					  <option value="20">20</option>
					  <option value="25">25</option>
					  <option value="50">50</option>
					  <option value="100">100</option>
					</select>
					</div>
				</div>
				<div class="form-bottom">
					<input id="btn" type="submit" value="Save" name="submit_form" onclick = "return confirm('Add weight and measure?')">
				</div>
			</form>
		</div>
	</div>
	
</div>
</div>
				
