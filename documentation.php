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
						<form id = "form-id" action = "documentation.php?p=0" method="post">
							<label>Quick Search</label>
							<input id="searchbox" name="frmSearch" type="text" placeholder="Search documentation by user, title etc.">
						</form>
						<div class="search-boxright pull-right"><a href = "#" onclick = "document.getElementById('form-id').submit()">Submit</a>
					</div>
				</div>
			</div>
		<div class="clear"></div>
		<div id = "documentation-detail" class="documentation-detail">
			<?php
				require ("connection.php");
				$result = mysqli_query($conn,"SELECT * FROM documentation");

				if ($result->num_rows > 0) {
				    // output data of each row

				    while($row = $result->fetch_assoc()) {
						$temp = $row['title'];
						echo "<div class='doc-block'>";
						echo "<nav class='search-boxright pull-right'><a href='edit_doc.php?title=$temp'>Edit</a></nav>";
						echo "<a href='view_doc.php?title=$temp'><h2>".$row['title']."</h2></a>"."<p>Written by <b>".$row['user']."</b> on ".$row['timestamp']."</p><br>";
						echo "<p>".$row['description']."</p>";
						echo "</div>";
				    }
				} else {
				    echo "0 results";
				}

				$conn->close();
			?>
		</div>
	</div>
</div>

<script>
(function($) {

	$.fn.easyPaginate = function(options){

		var defaults = {
			step: 4,
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

jQuery(function($){

	$('div#documentation-detail').easyPaginate({
		step:3
	});

});


	$(document).ready(function(){
		$("#searchbox").on("keyup input paste cut", function() {
			//searchbox value
			var search_val = $(this).val();
			//compare the searchbox value with each job id
			$("div.doc-block").each(function(){
				//if title.text OR username.text OR paragraphText.text contains the string in searchbox
				if($(this).children("a").text().toLowerCase().search(search_val)!=-1 || $(':nth-child(2)', this).children().text().toLowerCase().search(search_val)!=-1 || $(':nth-child(4)', this).text().toLowerCase().search(search_val)!=-1){
					//show div
					$(this).show();
				}
				else{
					//hide div
					$(this).hide();
				}
			});
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
