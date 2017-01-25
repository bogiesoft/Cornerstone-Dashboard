<?php
require ("header.php");
?>
<div class="dashboard-cont" style="padding-top:110px;">
		<div class="contacts-title">
			<h1 class="pull-left">Documentation</h1>
			<a class="pull-right" href="add_doc.php" class="add_button">Add Doc</a>
		</div>
	<div class="dashboard-detail">
			<div class="search-cont">
				<div class="searchcont-detail">
					<div class="search-boxleft">
							<label>Quick Search</label>
							<input id="searchbox" name="frmSearch" type="text" placeholder="Search documentation by user, title etc.">
							<div style="text-align:right; display:inline-block; float: right; margin:5px 10px 0 0; line-height:24px;">
								<form name = "formSortBy" id = "formSortBy" action = "documentation.php?sortby=" method = "POST" enctype="multipart/form-data">
									<select id= "sortby" name = "sortby" style=" width: 150px; border: 1px solid #666; display: inline-block;" >
										<option value="">Sort by</option>
			  						<option value="date">Date</option>
			  						<option value="user">User</option>
			  						<option value="View Count">View Count</option>
									</select>
								</form>
							</div>
					</div>
				</div>
		
			</div>
			<div class="clear"></div>
			<div id = "documentation-detail" class="documentation-detail">
				<div class='doc-block'>
					<div class="doc-block-left">
						<img src="images/profiles/sayre.jpg">
						<div class="date-box">
							<p class="date-month">JAN</p>
							<p class="date-year">2017</p>
						</div>
					</div>
					<div class="doc-block-right">
						<div class="doc-block-right-top">
						<h1 class="doc-title">Title</h1>
						<a class='search-boxright pull-right' href='edit_doc.php?title=$temp'><img style='height:25px; width:25px;' src='images/web-icons/edit_pencil-blue.png'></img></a>
						</div>
						<div class="doc-block-right-bottom">
						<p class="doc-timestamp">by kmcready on 1-25-17 at 11:40 AM</p>
						<p class="doc-description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
						<p class="doc-exerpt">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in ...</p>
						</div>
					</div>
				</div>	
			</div>
	</div>
</div>