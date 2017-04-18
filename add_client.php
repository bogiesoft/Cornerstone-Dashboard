<?php
require ("header.php");
?>
<script src="ClientSweetAlert.js"></script>
<script>
	function showClientInfo(){
		document.getElementById("alternate_fields").style.display = "none";
		document.getElementById("notes").style.display = "none";
		document.getElementById("mailing_history").style.display = "none";
		document.getElementById("crids").style.display = "none";
		document.getElementById("social_media").style.display = "none";
		document.getElementById("client_info").style.display = "block";

	};
	function showNotes(){
		document.getElementById("alternate_fields").style.display = "none";
		document.getElementById("mailing_history").style.display = "none";
		document.getElementById("client_info").style.display = "none";
		document.getElementById("crids").style.display = "none";
		document.getElementById("social_media").style.display = "none";
		document.getElementById("notes").style.display = "block";

	};
	function showMailingHistory(){
		document.getElementById("alternate_fields").style.display = "none";
		document.getElementById("notes").style.display = "none";
		document.getElementById("client_info").style.display = "none";
		document.getElementById("crids").style.display = "none";
		document.getElementById("social_media").style.display = "none";
		document.getElementById("mailing_history").style.display = "block";

	};
	function showCrid(){
		document.getElementById("alternate_fields").style.display = "none";
		document.getElementById("notes").style.display = "none";
		document.getElementById("mailing_history").style.display = "none";
		document.getElementById("client_info").style.display = "none";
		document.getElementById("social_media").style.display = "none";
		document.getElementById("crids").style.display = "block";

	};
	function showSocialMedia(){
		document.getElementById("notes").style.display = "none";
		document.getElementById("mailing_history").style.display = "none";
		document.getElementById("client_info").style.display = "none";
		document.getElementById("crids").style.display = "none";
		document.getElementById("alternate_fields").style.display = "none";
		document.getElementById("social_media").style.display = "block";

	};
	function showAltInfo(){
		document.getElementById("notes").style.display = "none";
		document.getElementById("mailing_history").style.display = "none";
		document.getElementById("client_info").style.display = "none";
		document.getElementById("crids").style.display = "none";
		document.getElementById("social_media").style.display = "none";
		$("#alternate_fields").show();

	};


</script>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Add Client</h1>
	<a class="pull-right" href="clients.php" style="margin-right:20px; background-color:#d14700;">Back to Clients</a>
	<div class="clear"></div>
	</div>
	<div class="dashboard-detail">
		<div class="newcontacts-tabs">
			<!-- Nav Tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true" onclick = 'showClientInfo()'>Client Info</a></li>
				<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true" onclick = 'showAltInfo()'>Alternate Info</a></li>
				<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true" onclick = 'showNotes()'>Notes</a></li>
				<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true" onclick = 'showSocialMedia()'>Social Media</a></li>
				<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true" onclick = 'showMailingHistory()'>Mailing History</a></li>
				<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true" onclick = 'showCrid()'>CRIDS</a></li>
			</ul>

			<div class="newcontactstabs-outer">
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="home">
						<form action="add_new_client.php" method="post">
							<div class="newcontactstab-detail" id="client_info" style = 'display:block;'>
								
								<div class="newcontacttab-inner">
									<div class="tabinner-detail">
										<label>Client Name</label>
										<input name="full_name" type="text"  class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Prefix</label>
										<input name="prefix" type="text" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Suffix</label>
										<input name="suffix" type="text" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Title</label>
										<input name="title" type="text"  class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Business</label>
										<input name="business" type="text"  class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Address Line 1</label>
										<input name="address_line_1" type="text"  class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>City</label>
										<input name="city" type="text"  class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>State</label>
										<input name="state" type="text"  class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Zip</label>
										<input name="zipcode" type="text"  class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Country</label>
										<input name="country" type="text" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Mailing List</label>
										<input name="mailing_list" type="checkbox"  value='Y'>
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Pie Day</label>
										<input name="pie_day" type="checkbox"  value='Y'>
										<div class="clear"></div>
									</div>
								</div>
								<div class="newcontacttab-inner">
									<div class="tabinner-detail">
										<label>Phone Number</label>
										<input name="phone" type="text"  class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Cell Phone</label>
										<input name="cell_phone" type="text"  class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Home Phone</label>
										<input name="home_phone" type="text"  class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Work Phone</label>
										<input name="work_phone" type="text" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Email 1</label>
										<input name="email1" type="text"  class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>CC Email</label>
										<input name="cc_email" type="text" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Website</label>
										<input name="web_address" type="text"  class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Fax</label>
										<input name="fax" type="text"  class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Contact</label>
										<input name="contact_name" type="text" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Type</label>
											<select name='type'>
												<option value = ''>Select</option>
												<option value ='Client'>Client</option>
												<option value ='Prospect'>Prospect</option>
											</select>
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Second Contact</label>
										<input name="second_contact" type="text"  class="contact-prefix">
										<div class="clear"></div>
									</div>
								</div>
								<div class="newcontacttab-inner">
									<div class="tabinner-detail">
										<label>Rep</label>
										<input name="rep" type="text"  class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Quickbooks</label>
										<input name="quickbooks" type="text" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Call Back Date</label>
										<input name="call_back_date" type="date"  class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Priority Level</label>
										<input name="priority" type="text"  class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Date Added</label>
										<input name="date_added" type="date"  class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Status</label>
										<input name="status" type="text"  class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Source</label>
										<input name="source" type="text" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Vertical 1</label>
										<input name="vertical1" type="text"  class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Vertical 2</label>
										<input name="vertical2" type="text"  class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Vertical 3</label>
										<input name="vertical3" type="text" class="contact-prefix">
										<div class="clear"></div>
									</div>
								</div>
							</div>
							<div class="newcontactstab-detail" id="alternate_fields" style = 'display:none;'>
								<div class="newcontacttab-inner">
									<div class="tabinner-detail">
										<label>Alternate Phone</label>
										<input name="alt_phone" type="text" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Alternate Mobile</label>
										<input name="alt_cell_phone" type="text" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Alternate Fax</label>
										<input name="alt_fax" type="text" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Alternate URL 1</label>
										<input name="alt_website1" type="text" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Alternate URL 2</label>
										<input name="alt_website2" type="text" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Email 2</label>
										<input name="email2" type="text" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Address Line 2</label>
										<input name="address_line_2" type="text" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Address Line 3</label>
										<input name="address_line_3" type="text" class="contact-prefix">
										<div class="clear"></div>
									</div>
								</div>
							</div>
							<div class="newcontactstab-detail" id="notes" style = 'display:none;'>
								<div class="newcontacttab-inner">
									<div class="tabinner-detail">
										<label>Note</label>
										<textarea name="notes" class="contact-notes" style = "width: 800%"></textarea>
										<div class="clear"></div>
									</div>
								</div>
							</div>
							<div class="newcontactstab-detail" id="social_media" style = 'display:none;'>
								<div class="newcontacttab-inner">
									<div class="tabinner-detail">
										<label>LinkedIn</label>
										<input name="linkedin" type="text" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Facebook</label>
										<input name="facebook" type="text" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Twitter</label>
										<input name="twitter" type="text" class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Skype ID</label>
										<input name="skypeid" type="text" class="contact-prefix">
										<div class="clear"></div>
									</div>

								</div>
							</div>
							<div class="newcontactstab-detail" id="mailing_history" style = 'display:none; white-space: nowrap;'>
								<div class="newcontacttab-inner" style="width:700px;">
								<div class='allcontacts-table'><table border='0' cellspacing='0' cellpadding='0' class='table-bordered allcontacts-table' >
								<tbody>
								<tr valign='top'><th class='allcontacts-title'>Information<span class='allcontacts-subtitle'></span></th></tr>
								<tr valign='top'><td colspan='2'><table id = 'w_m_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list'><thead><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='vendor' data-index='4'>Description</th><th class='maintable-thtwo data-header' data-name='material' data-index='6'>Check</th></tr></thead><tbody>
								<tr><td>2014 Pie Day</td><td><input type="checkbox" name="_2014_pie_day" class="contact-prefix" value='Y'></td></tr>
								<tr><td>Non Profit Card 08 2013</td><td><input type="checkbox" name="Non_Profit_Card_08_2013" class="contact-prefix" value='Y'></td></tr>
								<tr><td>Commercial Card 08-2013</td><td><input type="checkbox" name="Commercial_Card_08_2013" class="contact-prefix" value='Y'></td></tr>
								<tr><td>USPS Post Office Mailing 03-2014</td><td><input type="checkbox" name="USPS_Post_Office_Mailing_03_2014" class="contact-prefix" value='Y'></td></tr>
								<tr><td>Contractor/Small Business Select Mailing 03-2014</td><td><input type="checkbox" name="Contractor_Small_Business_Select_Mailing_03_2014" class="contact-prefix" value='Y'></td></tr>
								<tr><td>Contractor/SB Select Mailing 04-2014</td><td><input type="checkbox" name="Contractor_SB_Select_Mailing_04_2014" class="contact-prefix" value='Y'></td></tr>
								<tr><td>USPS EDDM + Regs brochure Mailing 04-2014</td><td><input type="checkbox" name="USPS_EDDM_Regs_brochure_Mailing_04_2014" class="contact-prefix" value='Y'></td></tr>
								<tr><td>USPS 9Y9 EDDM Marketing Card</td><td><input type="checkbox" name="USPS_9Y9_EDDM_Marketing_Card" class="contact-prefix" value='Y'></td></tr>
								<tr><td>SEPT 2014 3.5Y11 CRST Marketing Card</td><td><input type="checkbox" name="SEPT_2014_3_5Y11_CRST_Marketing_Card" class="contact-prefix" value='Y'></td></tr>
								<tr><td>Contractor Mailing 2016</td><td><input type="checkbox" name="Contractor_Mailing_2016" class="contact-prefix" value='Y'></td></tr>
								</tbody></table></td></tr></tbody></table></div>
								</div>
							</div>
							<div class="newcontactstab-detail" id="crids" style = 'display:none;'>
								<div class="newcontacttab-inner">
									<div class="tabinner-detail">
										<label>CRID</label>
										<input name="crid" type="text"  class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Non-Profit</label>
										<input name="non-profit" type="text"  class="contact-prefix">
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
