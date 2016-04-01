
<div class="sidebar">
  <div class="sidebar-toggle"><i><img src="images/web-icons/close.png"></i></div>
  <ul class="sidebar-list">
    <li><a href=""><i class="icon"><img src="images/web-icons/postoffice.png"></i>Post Offices</a></li>
    <li><a href="clients.php"><i class="icon"><img src="images/web-icons/clients.png"></i>Clients</a></li>
    <li><a href=""><i class="icon"><img src="images/web-icons/vendors.png"></i>Vendors</a></li>
    <li><a href=""><i class="icon"><img src="images/web-icons/documentation.png"></i>Documentation</a></li>
	<li><a href=""><i class="icon"><img src="images/web-icons/reminders.png"></i>Reminders</a></li>
    <li><a href=""><i class="icon"><img src="images/web-icons/w_m.png"></i>Weights and Measures</a></li>
	<li><a href=""><i class="icon"><img src="images/web-icons/archive.png"></i>Archive Jobs</a></li>
  </ul>
  <div class="crst_circle">
	<img id="circle-logo" src="images/crst_circle-logo.png">
	</div>
</div>


<script src="jquery.js"></script>
<script>
$(document).ready(function() {
  sidebarStatus = true;
   $('.sidebar').css({
        marginLeft: "0px",
        opacity: "1"
      });
      $('.content').css({
        marginLeft: "350px",
        opacity: "1"
      });
  $('.sidebar-toggle').click(function() {
    if (sidebarStatus == false) {
      $('.sidebar').animate({
        marginLeft: "0px",
        opacity: "1"
      }, 1000);
      $('.content').animate({
        marginLeft: "350px",
        opacity: "1"
      }, 1000);
      sidebarStatus = true;
    }
    else {
      $('.sidebar').animate({
        marginLeft: "-325px",
        opacity: "1"
      }, 1000);
      $('.content').animate({
        marginLeft: "25px",
        opacity: "1"
      }, 1000);
      sidebarStatus = false;
    }
  });
});
</script>