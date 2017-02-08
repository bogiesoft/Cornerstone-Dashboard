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
			  						<option value="view_count">View Count</option>
									</select>
								</form>
							</div>
					</div>
				</div>
			</div>
		<div class="clear"></div>
			<?php
				require ("connection.php");
				$sql = "SELECT * FROM documentation";
				if(isset($_GET['sortby'])){
					if($_GET['sortby'] == 'date'){
						$sql = $sql . " ORDER BY timestamp DESC";
					}
				}
				if(isset($_GET["sortby"])){
					if($_GET['sortby'] == 'user'){
						$sql = $sql . " ORDER BY user ASC";
					}
				}
				if(isset($_GET["sortby"])){
					if($_GET['sortby'] == 'view_count'){
						$sql = $sql . " ORDER BY view_count DESC";
					}
				}
				$result = mysqli_query($conn,$sql) or die (mysqli_error($conn));
				echo "<div id = 'paginator'>";
				if ($result->num_rows > 0) {
				    // output data of each row
					$doc_count = 1;
						while($row = $result->fetch_assoc()) {
							echo '<div id = "documentation-detail" class="doc-block">';
							echo '<div class="doc-block-left">';
							$user = $row["user"];
							$temp = $row['title'];
							$string_date = $row["timestamp"];
							$new_date = strtotime($string_date);
							$new_format_month_to_day = date("M d", $new_date);
							$new_format_year = date("Y", $new_date);
							
							if(file_exists("images/profiles/" . $user . ".jpg") || file_exists("images/profiles/" . $user . ".JPG") || file_exists("images/profiles/" . $user . ".png")){
								if(file_exists("images/profiles/" . $user . ".jpg")){
									echo "<img src = 'images/profiles/" . $user . ".jpg' width = '100' height = '100'>";
								}
								else if(file_exists("images/profiles/" . $user . ".JPG")){
									echo "<img src = 'images/profiles/" . $user . ".JPG' width = '100' height = '100'>";
								}
								else{
									echo "<img src = 'images/profiles/" . $user . ".png' width = '100' height = '100'>";
								}
							}
							else{
								echo "<img src = 'images/web-icons/user.png' width = '100' height = '100'>";
							}
							echo '<div class="date-box">';
								echo '<p class="date-month">' . $new_format_month_to_day . '</p>';
								echo '<p class="date-year">' . $new_format_year . '</p>';
							echo "</div>";
							$view_count = $row["view_count"];
							echo '<p style="color:#356CAC; font-style:italic; text-align:center; margin-top:5px;">Views: ' . $view_count . '</p>';
							echo "</div>";
							echo '<div class="doc-block-right">';
							echo '<div class="doc-title">';
							$title = $row["title"];
							echo "<a href='view_doc.php?title=$title'><p>" . $title .  "</p></a>";
							echo "<a href='edit_doc.php?title=$title'><img src='images/web-icons/edit_pencil-blue.png'></a>";
							echo '</div>';
							echo '<div class="doc-text">';
							echo "<p><i>by ".$user." on " . $string_date . "</i></p>";
							echo "<p><i>".$row['description']."</i></p>";
							echo "<p class = 'text'>" . $row["text"] . "</p>";
							echo "</div>";
							echo "</div>";
							echo "</div>";
							
							$doc_count = $doc_count + 1;
						}
					} else {
						echo "0 results";
					}
					echo "</div>";
				$conn->close();
			?>
</div>
</div>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="doc_paginator/lib/jquery.easyPaginate.js"></script>
<script type="text/javascript" src="micromarkdown/micromarkdown.js"></script>
<script>
(function($) {

	$.fn.easyPaginate = function(options){

		var defaults = {
			step: 5,
			delay: 100,
			numeric: true,
			nextprev: true,
			auto:false,
			loop:false,
			pause:4000,
			clickstop:true,
			controls: 'pagination',
			current: 'current',
			randomstart: false
		};

		var options = $.extend(defaults, options);
		var step = options.step;
		var lower, upper;
		var children = $(this).children();
		var count = children.length;
		var obj, next, prev;
		var pages = Math.floor(count/step);
		var page = (options.randomstart) ? Math.floor(Math.random()*pages)+1 : 1;
		var timeout;
		var clicked = false;

		function show(){
			clearTimeout(timeout);
			lower = ((page-1) * step);
			upper = lower+step;
			$(children).each(function(i){
				var child = $(this);
				child.hide();
				if(i>=lower && i<upper){ setTimeout(function(){ child.fadeIn('fast') }, ( i-( Math.floor(i/step) * step) )*options.delay ); }
				if(options.nextprev){
					if(upper >= count) { next.fadeOut('fast'); } else { next.fadeIn('fast'); };
					if(lower >= 1) { prev.fadeIn('fast'); } else { prev.fadeOut('fast'); };
				};
			});
			$('li','#'+ options.controls).removeClass(options.current);
			$('li[data-index="'+page+'"]','#'+ options.controls).addClass(options.current);

			if(options.auto){
				if(options.clickstop && clicked){}else{ timeout = setTimeout(auto,options.pause); };
			};
		};

		function auto(){
			if(options.loop) if(upper >= count){ page=0; show(); }
			if(upper < count){ page++; show(); }
		};

		this.each(function(){

			obj = this;

			if(count>step){

				if((count/step) > pages) pages++;

				var ol = $('<ol id="'+ options.controls +'"></ol>').insertAfter(obj);

				if(options.nextprev){
					prev = $('<li class="prev">Previous</li>')
						.hide()
						.appendTo(ol)
						.click(function(){
							clicked = true;
							page--;
							show();
						});
				};

				if(options.numeric){
					for(var i=1;i<=pages;i++){
					$('<li data-index="'+ i +'">'+ i +'</li>')
						.appendTo(ol)
						.click(function(){
							clicked = true;
							page = $(this).attr('data-index');
							show();
						});
					};
				};

				if(options.nextprev){
					next = $('<li class="next">Next</li>')
						.hide()
						.appendTo(ol)
						.click(function(){
							clicked = true;
							page++;
							show();
						});
				};

				show();
			};
		});

	};

})(jQuery);

$('#paginator').easyPaginate({
    paginateElement: 'div',
    elementsPerPage: 3,
    effect: 'climb'
});

//quick search textbox
	$(document).ready(function(){
		$("#searchbox").on("keyup input paste cut", function() {
			//searchbox value
			var search_val = $(this).val();
			//compare the searchbox value with each job id
			$(".doc-block").each(function(){
				//if title.text OR username.text OR paragraphText.text contains the string in searchbox
				if($(this).text().toLowerCase().search(search_val)!=-1){
					//show div
					$(this).show();
				}
				else{
					//hide div
					$(this).hide();
				}
			});
		});

		$("#sortby").val(localStorage.getItem("select_val"));
//sort according to date and user
		$('#sortby').on('change', function(){
			localStorage.setItem("select_val", $(this).val());
			$('#formSortBy').attr('action',$('#formSortBy').attr('action')+$(this).val());
			document.getElementById("formSortBy").submit();
		});

	});


$(document).ready(function(){
	$('.text').each(function(){
		var input = $(this).text();
		$(this).html(micromarkdown.parse(input));
		$("form").show();
	});
});
</script>

<style>

	ul#items{
		margin:1em 0;
		width:auto;
		height:245px;
		overflow:hidden;
		}
	ul#items li{
		list-style:none;
		float:left;
		height:240px;
		overflow:hidden;
		margin:0 4px;
		background:#DBDAE0;
		color:#fff;
		text-align:center;
		-moz-border-radius:5px;
		-webkit-border-radius:5px;
		border-radius:5px;
		-moz-box-shadow:0 1px 1px #777;
		-webkit-box-shadow:0 1px 1px #777;
		box-shadow:0 1px 1px #777;
		color:#555;
		}
	ul#items li:hover{color:#333;}
	ul#items li .image{
		margin:20px 20px 10px 20px;
		width:220px;
		height:150px;
		overflow:hidden;
		border:2px solid #fff;
		-moz-box-shadow:0 1px 1px #bbb;
		-webkit-box-shadow:0 1px 1px #bbb;
		box-shadow:0 1px 1px #bbb;
		}
	ul#items h3{text-transform:uppercase;font-size:14px;font-weight:bold;margin:.25em 0;text-shadow:#f1f1f1 0 1px 0;}
	ul#items .info{color:#999;text-shadow:#f1f1f1 0 1px 0;}
	ol#pagination{position:relative;text-align:center;}
	ol#pagination li{
		display:inline-block;
		width:16px;
		height:16px;
		background:url(http://cssglobe.com/lab/easypaginate//images/bg_buttons.png) no-repeat 0 0;
		text-align:left;
		text-indent:-8000px;
		list-style:none;
		cursor:pointer;
		margin:0 2px;
		}
	ol#pagination li:hover{background:url(http://cssglobe.com/lab/easypaginate//images/bg_buttons.png) no-repeat 0 -16px;}
	ol#pagination li.current{color:#f00;font-weight:bold;background:url(http://cssglobe.com/lab/easypaginate//images/bg_buttons.png) no-repeat 0 -32px;}
	ol#pagination li.prev, ol#pagination li.next{
		position:absolute;
		top:-150px;
		}
	ol#pagination li.prev{left:-30px;background:url(http://cssglobe.com/lab/easypaginate//images/bg_buttons.png) no-repeat 0 -64px;}
	ol#pagination li.next{right:-30px;background:url(http://cssglobe.com/lab/easypaginate//images/bg_buttons.png) no-repeat 0 -48px;}

	/* // content */
</style>
