<?php
require ("header.php");
?>
<script src="ClientSweetAlert.js"></script>
<script>
	function showClientInfo(){
		document.getElementById("notes").style.display = "none";
		document.getElementById("mailing_history").style.display = "none";
		document.getElementById("client_info").style.display = "block";
	};
	function showNotes(){
		document.getElementById("notes").style.display = "block";
		document.getElementById("mailing_history").style.display = "none";
		document.getElementById("client_info").style.display = "none";
	};
	function showMailingHistory(){
		document.getElementById("notes").style.display = "none";
		document.getElementById("mailing_history").style.display = "block";
		document.getElementById("client_info").style.display = "none";
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
				<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true" onclick = 'showNotes()'>Notes</a></li>
				<li role="presentation" class="active"><a  role="tab" data-toggle="tab" aria-expanded="true" onclick = 'showMailingHistory()'>Mailing History</a></li>
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
										<label>Address Line 2</label>
										<input name="address_line_2" type="text"  class="contact-prefix">
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
										<label>Alternate Phone</label>
										<input name="alt_phone" type="text"  class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Home Phone</label>
										<input name="home_phone" type="text"  class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Email 1</label>
										<input name="email1" type="text"  class="contact-prefix">
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<label>Email 2</label>
										<input name="email2" type="text"  class="contact-prefix">
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
							<div class="newcontactstab-detail" id="notes" style = 'display:none;'>
								<div class="newcontacttab-inner">
									<div class="tabinner-detail">
										<label>Note</label>
										<textarea name="notes" class="contact-notes"></textarea>
										<div class="clear"></div>
									</div>
								</div>
							</div>
							<div class="newcontactstab-detail" id="mailing_history" style = 'display:none;'>
								<div class="newcontacttab-inner" style="width:700px;">
									<div class="tabinner-detail">
										<div class="clear"></div>
									</div>	
									<div class="tabinner-detail">
										<input type="checkbox" name="_2014_pie_day" class="contact-prefix" value='Y' style="width:10%; float:left><label style="width:30%; float:left">2014 Pie Day</label>
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<input type="checkbox" name="Non_Profit_Card_08_2013" class="contact-prefix" value='Y' style="width:10%; float:left;"><label style="width:30%; float:left">Non-Profit Card 08-2013</label>
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<input type="checkbox" name="Commercial_Card_08_2013" class="contact-prefix" value='Y' style="width:10%; float:left;"><label style="width:30%; float:left">Commercial Card 08-2013</label>
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<input type="checkbox" name="USPS_Post_Office_Mailing_03_2014" class="contact-prefix" value='Y' style="width:10%; float:left;"><label style="width:30%; float:left">USPS Post Office Mailing 03-2014</label>
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<input type="checkbox" name="Contractor_Small_Business_Select_Mailing_03_2014" class="contact-prefix" value='Y' style="width:10%; float:left;"><label style="width:30%; float:left">Contractor/Small Business Select Mailing 03-2014</label>
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<input type="checkbox" name="Contractor_SB_Select_Mailing_04_2014" class="contact-prefix" value='Y' style="width:10%; float:left;"><label style="width:30%; float:left">Contractor/SB Select Mailing 04-2014</label>
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<input type="checkbox" name="USPS_EDDM_Regs_brochure_Mailing_04_2014" class="contact-prefix" value='Y' style="width:10%; float:left;"><label style="width:30%; float:left">USPS EDDM + Regs brochure Mailing 04-2014</label>
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<input type="checkbox" name="USPS_9Y9_EDDM_Marketing_Card" class="contact-prefix" value='Y' style="width:10%; float:left;"><label style="width:30%; float:left">USPS 9Y9 EDDM Marketing Card</label>
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<input type="checkbox" name="SEPT_2014_3_5Y11_CRST_Marketing_Card" class="contact-prefix" value='Y' style="width:10%; float:left;"><label style="width:30%; float:left">SEPT 2014 3.5Y11 CRST Marketing Card</label>
										<div class="clear"></div>
									</div>
									<div class="tabinner-detail">
										<input type="checkbox" name="Contractor_Mailing_2016" class="contact-prefix" value='Y' style="width:10%; float:left;"><label style="width:30%; float:left">Contractor Mailing 2016</label>
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
