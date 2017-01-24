<div class="dataconsulate-left" style="top:0px;">
  <div class="logo"><a href="dashboard.php"><img id="crst_logo" src="images/crstlogo.png"></a></div>
  <div class="menu">
  <ul style = "list-style-type: none; padding: 0; margin: 0">
    <li class = "sidelink"><a href="clients.php"><i><img src="images/web-icons/user.png"></i>Clients<span></span></a><div class="clear"></div></li>
    <li class = "sidelink"><a href="vendors.php"><i><img src="images/web-icons/funnel.png"></i>Vendors</a><div class="clear"></div></li>
    <li class = "sidelink"><a href="documentation.php"><i><img src="images/web-icons/notepad-1.png"></i>Documentation</a><div class="clear"></div></li>
	<li class = "sidelink"><a href="reminders.php"><i><img src="images/web-icons/calendar-1.png"></i>Calendar</a><div class="clear"></div></li>
    <li class = "sidelink"><a href="weights_and_measure.php"><i><img src="images/web-icons/windows-3.png"></i>Weights and Measures</a><div class="clear"></div></li>
	<li class = "sidelink"><a href="archive.php"><i><img src="images/web-icons/archive-1.png"></i>Archive Jobs</a><div class="clear"></div></li>
	<li class = "sidelink" style="margin-bottom:20px;"><a href="job_ticket.php"><i><img src="images/web-icons/document.png"></i>Job Ticket</a><div class="clear"></div></li>
  </ul>
  </div>
  <div id='live_updates'>
  <script type="text/javascript">
  $(document).ready(function(){
      auto_refresh();
    });
    function auto_refresh(){
        $('#live_updates').load('liveUpdates.php');
  };
  var refreshUpdates=setInterval(auto_refresh,3000);
  </script>
  </div>
</div>

