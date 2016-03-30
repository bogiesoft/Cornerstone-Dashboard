
<div class="sidebar">
  <div class="sidebar-toggle"></div>
  <ul class="sidebar-list">
    <a href=""><li>Post Offices</li></a>
    <a href="clients.php"><li>Clients</li></a>
    <a href=""><li>Vendors</li></a>
    <a href=""><li>Documentation</li></a>
    <a href=""><li>Weights and Measures</li></a>
	<a href=""><li>Archive Jobs</li></a>
  </ul>
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