<?php
require ("header.php");
?>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Add Popular Weights and Measures</h1>
	<a class="pull-right" href="vendors.php" style="margin-right:20px; background-color:#d14700;">Back to Vendors</a>
	<div class="clear"></div>
	</div>
<div class="dashboard-detail">
	<div class="newcontacts-tabs">
		<!---- Nav Tabs ---->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true">Primary Contact</a></li>
		</ul>
		<!--- Tab Panes --->
	<div class="newcontactstabs-outer">
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="home">
			<div class="newcontactstab-detail">
			<form action="add_p_wm.php" method="post">
				<div class="newcontacttab-inner">
				<?php
						require ("connection.php");

						$result = $conn->query("select vendor_name from vendors");
						echo("<div class='tabinner-detail'>");
						//getting vendor from vendor table
						echo "<label>Vendor </label><select name='vendor' class='contact-gender'>";
						while ($row = $result->fetch_assoc()) {
									  unset($vendor_name);
									  $vendor_name = $row['vendor_name']; 
									  echo '<option value="'.$vendor_name.'">'.$vendor_name.'</option>';
									 
						}
						echo "</select>";
						echo "<div class='clear'></div>";
						echo "</div>";
						//getting materials from weights and measure
						$result1 = $conn->query("select material from w_and_m");
						echo("<div class='tabinner-detail'>");
						echo "<label>Material</label><select name='material' class='contact-gender'>";
						
						while ($row1 = $result1->fetch_assoc()) {
									  unset($material);
									  $material = $row1['material']; 
									  echo '<option value="'.$material.'">'.$material.'</option>';
									 
						}
						echo "</select>";
						echo "<div class='clear'></div>";
						echo "</div>";
						?>
					<div class="tabinner-detail">
					<label>Based On</label>
					<select name="based_on" class="contact-gender" style="float:left;">
					  <option value="1">1</option>
					  <option value="5">5</option>
					  <option value="10">10</option>
					  <option value="20">20</option>
					  <option value="25">25</option>
					  <option value="50">50</option>
					  <option value="100">100</option>
					</select>
					<div class='clear'></div>
					</div>
				</div>
				<div class="newcontacttab-inner">
					<div class="tabinner-detail">
					<label>Height</label>
					<input name="height" type="text" class="contact-prefix">
					<div class='clear'></div>
					</div>
					<div class="tabinner-detail">
					<label>Weight</label>
					<input name="weight" type="text" class="contact-prefix">
					<div class='clear'></div>
					</div>
					<div class="tabinner-detail">
					<label>Size</label>
					<input name="size" type="text" class="contact-prefix">
					<div class='clear'></div>
					</div>
				</div>
			</div>
				<div class="newcontact-tabbtm">
					<input class="save-btn" type="submit" value="Save" name="submit_form" style="width:200px; font-size:16px; background-color:#356CAC; text-align:center; font-weight:400; transition:all 300ms 0s; color:white; padding:5px;">
				</div>
			</form>
			</div>
		</div>
	</div>
	</div>
</div>
</div>