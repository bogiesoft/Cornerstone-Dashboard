
<div class="dataconsulate-left" style="top:0px;">
  <div class="logo"><a href="dashboard.php"><img id="crst_logo" src="images/crstlogo.png"></a></div>
  <div class="menu">
  <ul>
    <li><a href="post_offices.php"><i><img src="images/web-icons/postoffice.png"></i>Post Offices</a><div class="clear"></div></li>
    <li><a href="clients.php"><i><img src="images/web-icons/clients.png"></i>Clients<span></span></a><div class="clear"></div></li>
    <li><a href="vendors.php"><i><img src="images/web-icons/vendors.png"></i>Vendors</a><div class="clear"></div></li>
    <li><a href="documentation.php"><i><img src="images/web-icons/documentation.png"></i>Documentation</a><div class="clear"></div></li>
	<li><a href="reminders.php"><i><img src="images/web-icons/reminders.png"></i>Calendar</a><div class="clear"></div></li>
    <li><a href="weights_and_measure.php"><i><img src="images/web-icons/w_m.png"></i>Weights and Measures</a><div class="clear"></div></li>
	<li><a href="archive.php"><i><img src="images/web-icons/archive.png"></i>Archive Jobs</a><div class="clear"></div></li>
	<li><a href="job_ticket.php"><i><img src="images/web-icons/archive.png"></i>Job Ticket</a><div class="clear"></div></li>
  </ul>
  <h3 style = 'text-align: center'>Live Updates</h3>
  <div id='edkoma'>

  <script type="text/javascript">
  $(document).ready(function(){
      auto_refresh();
    });
    function auto_refresh(){
        $('#edkoma').load('liveUpdates.php');
  };
  var refreshUpdates=setInterval(auto_refresh,3000);
  </script>
  </div>
  <div class="clear"></div>
  </div>
</div>

