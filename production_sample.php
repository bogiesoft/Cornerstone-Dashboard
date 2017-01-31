<?php
	require("header.php");
	require("connection.php");
?>

<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Production</h1>
	<a class="pull-right" href="production_data.php">Time Tracking</a>
	<a class="pull-right" href="inventory.php" style="margin-right:20px; background-color:#d14700;">Inventory</a>
	</div>
<div class="dashboard-detail">
	<div class="search-cont">
	<div class="searchcont-detail">
		<div class="search-boxleft">
				<label>Quick Search</label>
				<input id="searchbox" name="frmSearch" type="text" placeholder="Search for a job">
		</div>
	</div>
	</div>
<div class="clear"></div>
<div class="block_area">
	<div class="project_block">
		<div class="project_block_left">
			<div class="project_row1">
				<p>Client Name</p>
				<p>Project Name</p>
			</div>
			<div class="project_row2">
				<p>Job ID</p>
				<p>Records Total</p>
				<p>Due Date</p>
				<p>Tasks</p>
			</div>
			<div class="graph_block">
				<img src="images/graph_sample.png">
				<select>
					<option select="selected" value="0"># of People</option>
					<option value="1">1</option>
					<option value="2">2</option>
				</select>
			</div>
			<div class="project_row3">
				<select>
					<option select="selected" value="0">Assign to</option>
					<option value="1">2</option>
					<option value="2">3</option>
				</select>
				<select>
					<option select="selected" value="0">Priority</option>
					<option value="1">High</option>
					<option value="2">Medium</option>
					<option value="3">Low</option>
				</select>
			</div>
		</div>
		<div class="project_row4">
			<a href="#" style="width:100%; background-color:#356CAC; float:left; text-align:center; color:white;">SPECIAL INSTRUCTIONS</a>
		</div>
		
	</div>
	<div class="project_block">
		<div class="project_block_left">
			<div class="project_row1">
				<p></p>
				<p></p>
			</div>
			<div class="project_row2">
				<p>Job ID</p>
				<p>Records Total</p>
				<p>Due Date</p>
				<p>Tasks</p>
			</div>
			<div class="graph_block">
				<img src="images/graph_sample.png">
				<select>
					<option select="selected" value="0"># of People</option>
					<option value="1">1</option>
					<option value="2">2</option>
				</select>
			</div>
			<div class="project_row3">
				<select>
					<option select="selected" value="0">Assign to</option>
					<option value="1">2</option>
					<option value="2">3</option>
				</select>
				<select>
					<option select="selected" value="0">Priority</option>
					<option value="1">High</option>
					<option value="2">Medium</option>
					<option value="3">Low</option>
				</select>
			</div>
		</div>
		<div class="project_row4">
			<a href="#" style="width:100%; background-color:#356CAC; float:left; text-align:center; color:white;">SPECIAL INSTRUCTIONS</a>
		</div>
		
	</div>
	
</div>
</div>
</div>
