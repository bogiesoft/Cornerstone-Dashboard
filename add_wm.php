<?php
require ("header.php");
?>
<script src="W_MSweetAlert.js"></script>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Add Weights and Measures</h1>
	<a class="pull-right" href="weights_and_measure.php">Back to W/M</a>
	<div class="clear"></div>
	</div>
<div class="dashboard-detail">
	<div class="newcontacts-tabs">
		<!---- Nav Tabs ---->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true">New Weights and Measures</a></li>
		</ul>
		<!--- Tab Panes --->
	<div class="newcontactstabs-outer">
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="home">
			<div class="newcontactstab-detail">
				<form action="add_w_m.php" method="post">
					<div class="newcontacttab-inner">
						<?php
						require ("connection.php");
						$result = $conn->query("select vendor_name from vendors");
						echo("<div class='tabinner-detail' >");
						echo "<label>Vendor</label><select id='vendor' name='vendor' style='display:block;'>";
						while ($row = $result->fetch_assoc()) {
									  unset($vendor_name);
									  $vendor_name = $row['vendor_name']; 
									  echo '<option value="'.$vendor_name.'">'.$vendor_name.'</option>';
									 
						}
						echo "</select>";
						echo "</div>";
						?>
						<div class="tabinner-detail">
						<label>Product #</label>
						<input id="product_num" name="product_num" type="text" class="contact-prefix">
						</div>
					</div>
					
					<div class="newcontacttab-inner">
						<div class="tabinner-detail">
						<label>Material</label>
						<input id="material" name="material" type="text" class="contact-prefix">
						</div>
						<div class="tabinner-detail">
						<label>Type</label>
						<input id="type" name="type" type="text" class="contact-prefix">
						</div>
						<div class="tabinner-detail">
						<label>Height "in"</label>
						<input name="height" type="text" class="contact-prefix">
						</div>
					</div>
					<div class="newcontacttab-inner">
						<div class="tabinner-detail">
						<label>Weight "lbs"</label>
						<input name="weight" type="text" class="contact-prefix">
						</div>
						<div class="tabinner-detail">
						<label>Size "in"</label>
						<input name="size" type="text" class="contact-prefix">
						</div>
						<div class="tabinner-detail">
						<label>Based On</label>
						<input name="based_on" type="text" class="contact-prefix">
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
</div>