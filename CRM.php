<?php require("header.php"); 
$_SESSION["table_type_save_search"] = "CRM"; 
?>

<style>


  .dataTables_filter {
     display: none;
  }

  .allcontacts-table{
    background-color: #fff;
  }
  .dataTables_wrapper .dt-buttons {
    float:none;
    text-align:right;
  }

</style>
<script type="text/javascript" language="javascript" >
    var dataTable = null;
    var myData = {function: 1};
    var FilteredRecords = 0;
	$(document).ready(function() {
    //on page load set the 'mark' column in database to 0
    $.ajax({
      type:'POST',
      url: 'CRM_updateMarked.php',
      data: {
        'function': 0
      }
    });

   //====================create datatable==========================================
  	dataTable = $('#crm-table').DataTable( {
  			dom: '<"toolbar">lfrtip',
        "order": [[ 1, "asc" ]],
  			"processing": true,
  			"serverSide": true,
        "deferRender": false,
  			"scrollX": true,
  			"ajax":{
  				url :"server-side-CRM.php", // json datasource
  				type: "POST",  // method  , by default get
          data: function ( d ) {
                   return  $.extend(d, myData);
                },
  				error: function(){  // error handling
  					$(".crm-table-error").html("");
  					$("#crm-table").append('<tbody class="crm-table-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
  					$("#crm-table_processing").css("display","none");
  				}
  			},
  			"columnDefs": [ {
  			    "targets": 1,
  			    "render": function ( data, type, row) {
  			      return '<a href="edit_client.php?client_info='+row[1]+'">'+row[1]+'</a>'; //link for each client name
  			    }
  			  },{
  			    "targets": 2,
  			    "render": function ( data, type, row) {
  			      return '<a href="edit_client.php?client_info='+row[1]+'">'+row[2]+'</a>'; //link for each business name
  			    }
  			  },{
           'targets': 0,
           'searchable': false,
           'orderable': false,
           'className': 'dt-body-center',
           'render': function (data, type, row){
             if (row[0] == 1) {
               return '<input type="checkbox" id = "check_box" name="id[]" onclick = "rowMarkedClick(\'' + row[0] + '\',\'' + row[1] + '\')" checked>';
             }else {
               return '<input type="checkbox" id = "check_box" name="id[]" onclick = "rowMarkedClick(\'' + row[0] + '\',\'' + row[1] + '\')">';
             }
           }
         }
      ]
  	});
//buttons above table
  $("div.toolbar").html('<div class="dt-buttons"><a href="#" class="dt-button csv1"  id ="export" role="button">Export CSV</a><a class="dt-button buttons-select-all" tabindex="0" aria-controls="crm-table" href="#"><span>Select all</span></a><a class="dt-button buttons-select-none" tabindex="0" aria-controls="crm-table" href="#"><span>Deselect all</span></a><a class="dt-button filterRow buttons-showMarked" tabindex="0" aria-controls="crm-table" href="#">Show selected rows only</a></div>')
  //==============================================================================


    $('#export').on('click', function() {
      if (FilteredRecords == 0) {
        swal({   title: "Warning",   text: "Cannot export an empty table. Please select some rows to export.",  text: "Your file will begin downloading if you choose to Export.", type: "warning",      confirmButtonColor: "#4FD8FC",   confirmButtonText: "OK",   closeOnConfirm: true },
    			function(){ saveNotClicked=false; $( ".store-btn" ).click();});
      }else{
        swal({
            title: "Are you sure you want to export "+FilteredRecords+" Records?",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Export it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
          },
          function(isConfirm){
            if (isConfirm) {
              var sqlsend = dataTable.ajax.json().sql;
              window.location.href="server-side-CSV.php?val="+sqlsend+"&NumRecords="+FilteredRecords;
              swal({title:"Nice!", text:"Saved as: ", type:"success"});
            } else {
              swal("Cancelled", "Export stopped", "error");
            }
        });
      }
    });


  //====Column Search ======
	$('.search-input-text').on( 'keyup click', function () {   // for text boxes
		var i =$(this).attr('data-column');  // getting column index
		var v =$(this).val();  // getting search input value
		dataTable.columns(i).search(v).draw();
	});

	$('.search-input-select').on( 'change', function () {   // for select box
			var i =$(this).attr('data-column');
			var v =$(this).val();
			dataTable.columns(i).search(v).draw();
	});
  //====!Column Search!======

	$('.buttons-select-all').on( 'click', function () {
    // Check checkboxes for all rows in the table
    var sqlsend = dataTable.ajax.json().sql;
    $.ajax({
      type:'POST',
      url: 'CRM_updateMarked.php',
      data: {
        'function': 2,
        'Select': 'all',
        'sql': sqlsend
      }
    });
    $('input[type="checkbox"]').each(function(){
        $(this).attr('checked', true);
    });
    FilteredRecords = dataTable.ajax.json().recordsFiltered;
    updateCounter();
    dataTable.ajax.reload(null, false);
  });

  //Select All button and select none button
  	$('.buttons-select-none').on( 'click', function (event) {
      console.log(this);
      var sqlsend = dataTable.ajax.json().sql;
      $.ajax({
        type:'POST',
        url: 'CRM_updateMarked.php',
        data: {
          'function': 2,
          'Select': 'none',
          'sql': sqlsend
        }
      });
      $('input[type="checkbox"]').each(function(){
          $(this).attr('checked', false);
      });
      $("#general i .counter").text('');

  	});

  //'show selected row' button
    $('.filterRow').on('click', function(event){
      // Check if the clicked button has class `btn_s`
      if ($(this).hasClass('buttons-showMarked')) {
        $(this).html('Display All').toggleClass('buttons-showMarked buttons-hideMarked');
        myData.function = 0;
        dataTable.ajax.reload();
      } else {
        console.log("in else");
        $(this).html('Show selected rows only').toggleClass('buttons-hideMarked buttons-showMarked ');
        myData.function = 1;
        dataTable.ajax.reload();
      }
    });


    function serialize (mixedValue) {
      //  discuss at: http://locutus.io/php/serialize/
      // original by: Arpad Ray (mailto:arpad@php.net)
      // improved by: Dino
      // improved by: Le Torbi (http://www.letorbi.de/)
      // improved by: Kevin van Zonneveld (http://kvz.io/)
      // bugfixed by: Andrej Pavlovic
      // bugfixed by: Garagoth
      // bugfixed by: Russell Walker (http://www.nbill.co.uk/)
      // bugfixed by: Jamie Beck (http://www.terabit.ca/)
      // bugfixed by: Kevin van Zonneveld (http://kvz.io/)
      // bugfixed by: Ben (http://benblume.co.uk/)
      // bugfixed by: Codestar (http://codestarlive.com/)
      //    input by: DtTvB (http://dt.in.th/2008-09-16.string-length-in-bytes.html)
      //    input by: Martin (http://www.erlenwiese.de/)
      //      note 1: We feel the main purpose of this function should be to ease
      //      note 1: the transport of data between php & js
      //      note 1: Aiming for PHP-compatibility, we have to translate objects to arrays
      //   example 1: serialize(['Kevin', 'van', 'Zonneveld'])
      //   returns 1: 'a:3:{i:0;s:5:"Kevin";i:1;s:3:"van";i:2;s:9:"Zonneveld";}'
      //   example 2: serialize({firstName: 'Kevin', midName: 'van'})
      //   returns 2: 'a:2:{s:9:"firstName";s:5:"Kevin";s:7:"midName";s:3:"van";}'

      var val, key, okey
      var ktype = ''
      var vals = ''
      var count = 0

      var _utf8Size = function (str) {
        var size = 0
        var i = 0
        var l = str.length
        var code = ''
        for (i = 0; i < l; i++) {
          code = str.charCodeAt(i)
          if (code < 0x0080) {
            size += 1
          } else if (code < 0x0800) {
            size += 2
          } else {
            size += 3
          }
        }
        return size
      }

      var _getType = function (inp) {
        var match
        var key
        var cons
        var types
        var type = typeof inp

        if (type === 'object' && !inp) {
          return 'null'
        }

        if (type === 'object') {
          if (!inp.constructor) {
            return 'object'
          }
          cons = inp.constructor.toString()
          match = cons.match(/(\w+)\(/)
          if (match) {
            cons = match[1].toLowerCase()
          }
          types = ['boolean', 'number', 'string', 'array']
          for (key in types) {
            if (cons === types[key]) {
              type = types[key]
              break
            }
          }
        }
        return type
      }

      var type = _getType(mixedValue)

      switch (type) {
        case 'function':
          val = ''
          break
        case 'boolean':
          val = 'b:' + (mixedValue ? '1' : '0')
          break
        case 'number':
          val = (Math.round(mixedValue) === mixedValue ? 'i' : 'd') + ':' + mixedValue
          break
        case 'string':
          val = 's:' + _utf8Size(mixedValue) + ':"' + mixedValue + '"'
          break
        case 'array':
        case 'object':
          val = 'a'
          /*
          if (type === 'object') {
            var objname = mixedValue.constructor.toString().match(/(\w+)\(\)/);
            if (objname === undefined) {
              return;
            }
            objname[1] = serialize(objname[1]);
            val = 'O' + objname[1].substring(1, objname[1].length - 1);
          }
          */

          for (key in mixedValue) {
            if (mixedValue.hasOwnProperty(key)) {
              ktype = _getType(mixedValue[key])
              if (ktype === 'function') {
                continue
              }

              okey = (key.match(/^[0-9]+$/) ? parseInt(key, 10) : key)
              vals += serialize(okey) + serialize(mixedValue[key])
              count++
            }
          }
          val += ':' + count + ':{' + vals + '}'
          break
        case 'undefined':
        default:
          // Fall-through
          // if the JS object has a property which contains a null value,
          // the string cannot be unserialized by PHP
          val = 'N'
          break
      }
      if (type !== 'object' && type !== 'array') {
        val += ';'
      }

      return val
    }

    function urlencode (str) {
      //       discuss at: http://locutus.io/php/urlencode/
      //      original by: Philip Peterson
      //      improved by: Kevin van Zonneveld (http://kvz.io)
      //      improved by: Kevin van Zonneveld (http://kvz.io)
      //      improved by: Brett Zamir (http://brett-zamir.me)
      //      improved by: Lars Fischer
      //         input by: AJ
      //         input by: travc
      //         input by: Brett Zamir (http://brett-zamir.me)
      //         input by: Ratheous
      //      bugfixed by: Kevin van Zonneveld (http://kvz.io)
      //      bugfixed by: Kevin van Zonneveld (http://kvz.io)
      //      bugfixed by: Joris
      // reimplemented by: Brett Zamir (http://brett-zamir.me)
      // reimplemented by: Brett Zamir (http://brett-zamir.me)
      //           note 1: This reflects PHP 5.3/6.0+ behavior
      //           note 1: Please be aware that this function
      //           note 1: expects to encode into UTF-8 encoded strings, as found on
      //           note 1: pages served as UTF-8
      //        example 1: urlencode('Kevin van Zonneveld!')
      //        returns 1: 'Kevin+van+Zonneveld%21'
      //        example 2: urlencode('http://kvz.io/')
      //        returns 2: 'http%3A%2F%2Fkvz.io%2F'
      //        example 3: urlencode('http://www.google.nl/search?q=Locutus&ie=utf-8')
      //        returns 3: 'http%3A%2F%2Fwww.google.nl%2Fsearch%3Fq%3DLocutus%26ie%3Dutf-8'

      str = (str + '')

      // Tilde should be allowed unescaped in future versions of PHP (as reflected below),
      // but if you want to reflect current
      // PHP behavior, you would need to add ".replace(/~/g, '%7E');" to the following.
      return encodeURIComponent(str)
        .replace(/!/g, '%21')
        .replace(/"/g, '%22')
        .replace(/\(/g, '%28')
        .replace(/\)/g, '%29')
        .replace(/\*/g, '%2A')
        .replace(/%20/g, '+')
    }
    //quick search box
    $("#searchbox").on("keyup search input paste cut", function() {
   		dataTable.search(this.value).draw();
		});

  //save search button
    $('#save_button').on('click', function(){
      var val = '';
      var col_name ='';
      var search_name = '';
      $( '.search_col' ).each(function() {
        if ($(this).val()!=(null || '')) {    //when column search input field is not empty
            val =val+","+$(this).val();
            col_name = col_name+","+$(this).attr("text");
        }
      });
      if (val == '') {
        swal({   title: "Warning",   text: "You did not search anything. Please search for some input to save.",   type: "warning",      confirmButtonColor: "#4FD8FC",   confirmButtonText: "OK",   closeOnConfirm: true },
    		function(){ saveNotClicked=false; $( ".store-btn" ).click();});
      }
      else{
        swal({
            title: "Are you sure you want to save the searches you made?",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Save it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
          },
          function(isConfirm){
            if (isConfirm) {
              swal({
                title: "Search name",
                text: "Please enter a name for the search:",
                type: "input",
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
                inputPlaceholder: "Write something"
              },
              function(inputValue){
                if (inputValue === false) return false;

                if (inputValue === "") {
                  //default name for the search
                  var d = new Date();

                  var month = d.getMonth()+1;
                  var day = d.getDate();

                  var output = d.getFullYear() + '/' +
                      (month<10 ? '0' : '') + month + '/' +
                      (day<10 ? '0' : '') + day;
                  search_name = "Saved Search "+output;
                }else
                  search_name = inputValue;
                 swal({title:"Nice!", text:"Saved as: " + search_name, type:"success"},
                 function(){
                    $.ajax({
                     type:'POST',
                     url: 'CRM_updateMarked.php',
                     data: {
                       'function': 3,
                       'search_name': search_name,
                       'val': val,
                       'col_name': col_name,
                     }
                   });
                   window.location.reload();
                 });
              });

            } else {
              swal("Cancelled", "Save stopped", "error");
            }
        });
      }
    });

    $('.delete_button').on('click', function(){
      var del_id = $(this).attr("id");
      var info = del_id;
      swal({
        title: "Are you sure you want to delete?",
        text: "You will not be able to recover this data!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel plx!",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm){
        if (isConfirm) {
          $.ajax({
        		url: 'CRM_updateMarked.php',
        		type: 'POST',
        		data: {
        			id: info,
              'function': 4
        		},
        		success: function(){
        			document.getElementById("cell" + del_id).style.display = "none";
        		}
        	});
          swal("Deleted!", "Your search has been deleted.", "success");
        } else {
          swal("Cancelled", "Your search is safe :)", "error");
        }
      });
    });
	});


  //when 'Show saved button' pressed
  function SavedSearch(field1, value1, field2, value2, field3, value3, field4, value4, field5, value5){
    var search_field = [field1, field2, field3, field4, field5];
    var search_value = [value1, value2, value3, value4, value5];
	var error_subtract = 0;
	var check_dup = 0;
	for(var j = 1; j <= 15; j++)
	{
		$(".minus_button" + j).hide();
		$(".add_button" + j).show();
	}
	$(".search-input-text").val("");
	$(".search-input-text").css("visibility", "hidden");
	$('.search_col').click();
    for (i = 0; i < search_field.length; i++) {
      if (search_field[i]!= "$$$") {
        $( '.search_col' ).each(function() {
          if ($(this).attr("text") == search_field[i]) {
            $(this).val(search_value[i]);
            $(this).css('visibility','visible');                          //input text field
            var plusbutton = $(this).siblings().nextAll().eq(0).attr('class');
            var minusbutton = $(this).siblings().attr('class');
            $('.'+plusbutton).hide();   //+ button
            $('.'+minusbutton).show();   //- button
			search_counter--;
			if(check_dup % 2 == 0){
				error_subtract++;
			}
			check_dup++;
          }
        });
      }
    }
	search_counter = search_counter + error_subtract;
    $( '.search_col' ).click();
  }

  function showSavedSearch(){
    if(document.getElementById('show_saved_search').innerHTML == "Show Saved Search"){
	  $("#saved_search_table").show(600);
      document.getElementById('show_saved_search').innerHTML = "Hide Saved Search";
    }
    else{
      $("#saved_search_table").hide(600);
      document.getElementById('show_saved_search').innerHTML = "Show Saved Search";
    }
  }

  //When input checkbox is clicked this function is called
  function rowMarkedClick(checked, client_id){
    MarkChecked = (checked == 0)?true:false;
    $.ajax({
      type:'POST',
      url: 'CRM_updateMarked.php',
      data: {
        'function': 1,
        'checked': MarkChecked,
        'CID': client_id
      }
    });
    FilteredRecords = (MarkChecked)?FilteredRecords+=1:FilteredRecords-=1;
    updateCounter();
    dataTable.ajax.reload(null, false);
  }

  function updateCounter(){
		if(FilteredRecords>0){
			$("#general i .counter").text('('+FilteredRecords+')');
		}
		else{$("#general i .counter").text('');}
	}

  var search_counter = 5;
  function addSearchCounter(search, add_button, minus_button){
    	if(search_counter != 0){
    		$(add_button).hide();
    		$(search).css('visibility','visible');
        $(search).show().focus()
    		$(minus_button).show();
    		search_counter--;
    	}
    	else{
    		showErrorMessage();
    	}

    	function showErrorMessage(){
        swal({   title: "Limit",   text: "Only 5 search boxes allowed. Press '-' button to choose another column.",   type: "warning",      confirmButtonColor: "#4FD8FC",   confirmButtonText: "OK",   closeOnConfirm: true },
    			function(){ saveNotClicked=false; $( ".store-btn" ).click();});
    	};
  }
   function minusSearchCounter(search, add_button, minus_button){
		$(minus_button).hide();
		$(search).css('visibility','hidden');
		$(search).val("");
		$(add_button).show();
		search_counter++;
		$('.search_col').click();
}
</script>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
		<h1 class="pull-left">CRM</h1>
		<a style = "margin-right: 2px"class="pull-right" href="uploadForm.php" class="add_button">Upload</a>
		<a style = "margin-right: 2px"class="pull-right" href="add_client.php" class="add_button">Add Client</a>
	</div>
<div class="dashboard-detail">
    <div class ="search-cont">
      <div class="searchcont-detail">
        <div class="search-boxleft">
    			<div class="contacts-title">
				<label>Quick Search</label>
					<input id="searchbox" name="frmSearch" type="text" placeholder="Search for a specific client">
					<a id = 'save_button' class="pull-right" href="#" class="add_button" style = "vertical-align: middle">Save search</a>
    				<a id = 'show_saved_search' class="pull-right" class="add_button" onclick = 'showSavedSearch()' href = "#" style = "background: #ff5c33">Show Saved Search</a>
    			</div>
        </div>
			<div id="saved_search_div">
				<table id="saved_search_table" style = 'display: none; border: 1px solid; width: 50%'>
					<tbody style = 'border: 1px solid; width: 100%'>
			        <tr valign='top'><td colspan='2'><table id = 'w_m_table' border='0' cellspacing='0' cellpadding='0' class='table-striped main-table contacts-list' style = "width: 100%"><thead><tr valign='top' class='contact-headers'><th class='maintable-thtwo data-header' data-name='vendor' data-index='4'>Saved Search</th><th class='maintable-thtwo data-header' data-name='material' data-index='6'>Delete</th></tr></thead><tbody>
						<?php
						$columnIntable = 0;
						$result = mysqli_query($conn, "SELECT * FROM saved_search WHERE table_type = 'CRM' ORDER BY search_date DESC LIMIT 10");
						if (mysqli_num_rows($result) > 0) {
							// output data of each row
							while($row = $result->fetch_assoc()) {
								$search_id = $row["search_id"];
								$field1=$row["field1"];
								$value1=$row["value1"];
								$field2=$row["field2"];
								$value2=$row["value2"];
								$field3=$row["field3"];
								$value3=$row["value3"];
								$field4=$row["field4"];
								$value4=$row["value4"];
								$field5=$row["field5"];
								$value5=$row["value5"];
								echo "<tr><td id = 'cell" . $search_id . "' class='data-cell'><a id = '" . $search_id . "' class = 'saved_search_button' onClick = 'SavedSearch(\"$field1\", \"$value1\",\"$field2\", \"$value2\",\"$field3\", \"$value3\",\"$field4\", \"$value4\",\"$field5\", \"$value5\")'>". $row["search_name"]."</a></td><td><img id = '" . $search_id . "' class = 'delete_button' src = 'images/x_button.png' width = '25' height = '25' style = 'background: #989b9a'></td></tr>";
							}
						}
						else {
							echo "0 Saved Searches";
						}
						?>
					</tbody></table></td></tr></tbody></table>
			</div>
    </div>
</div>
<div class="clear"></div>

<div id = 'allcontacts-table' class='allcontacts-table'>

	<table id="crm-table"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
			<thead>
				<tr>
          <th>Mark</th>
					<th>Client ID</th>
					<th>Contact Name</th>
					<th>Business</th>
					<th>Address</th>
					<th>City</th>
					<th>State</th>
					<th>Zip Code</th>
					<th>Call Back Date</th>
					<th>Priority</th>
					<th>Title</th>
					<th>Phone</th>
					<th>Website</th>
					<th>Email</th>
					<th>Vertical 1</th>
					<th>Vertical 2</th>
					<th>Vertical 3</th>
				</tr>
			</thead>
			<tfoot>
        <tr>
          <td></td>
				<td><input type="text" text = "full_name" data-column="1"  placeholder = "Search Client Name" class="search-input-text search_col search_box0" style = "visibility: hidden"><button style = 'display: none' class = 'minus_button0' onclick = "minusSearchCounter('.search_box0', '.add_button0', '.minus_button0')">Clear Client ID</button><button class = "add_button0" onclick = "addSearchCounter('.search_box0', '.add_button0', '.minus_button0')">Search by Client ID</button></td>
  				<td><input type="text" text = "full_name" data-column="2"  placeholder = "Search Client Name" class="search-input-text search_col search_box1" style = "visibility: hidden"><button style = 'display: none' class = 'minus_button1' onclick = "minusSearchCounter('.search_box1', '.add_button1', '.minus_button1')">Clear Client</button><button class = "add_button1" onclick = "addSearchCounter('.search_box1', '.add_button1', '.minus_button1')">Search by Client</button></td>
  				<td><input type="text" text = "business" data-column="3"  placeholder = "Search Business" class="search-input-text search_col search_box2" style = "visibility: hidden"><button style = 'display: none' class = 'minus_button2' onclick = "minusSearchCounter('.search_box2', '.add_button2', '.minus_button2')">Clear business</button><button class = "add_button2" onclick = "addSearchCounter('.search_box2', '.add_button2', '.minus_button2')">Search by business</button></td>
  				<td><input type="text" text = "address_line_1" data-column="4"  placeholder = "Search Address" class="search-input-text search_col search_box3" style = "visibility: hidden"><button style = 'display: none' class = 'minus_button3' onclick = "minusSearchCounter('.search_box3', '.add_button3', '.minus_button3')">Clear Address</button><button class = "add_button3" onclick = "addSearchCounter('.search_box3', '.add_button3', '.minus_button3')">Search by Address</button></td>
  				<td><input type="text" text = "city" data-column="5"  placeholder = "Search City" class="search-input-text search_col search_box4" style = "visibility: hidden"><button style = 'display: none' class = 'minus_button4' onclick = "minusSearchCounter('.search_box4', '.add_button4', '.minus_button4')">Clear City</button><button class = "add_button4" onclick = "addSearchCounter('.search_box4', '.add_button4', '.minus_button4')">Search by city</button></td>
  				<td><input type="text" text = "state" data-column="6"  placeholder = "Search State" class="search-input-text search_col search_box5" style = "visibility: hidden"><button style = 'display: none' class = 'minus_button5' onclick = "minusSearchCounter('.search_box5', '.add_button5', '.minus_button5')">Clear state</button><button class = "add_button5" onclick = "addSearchCounter('.search_box5', '.add_button5', '.minus_button5')">Search by state</button></td>
  				<td><input type="text" text = "zipcode" data-column="7"  placeholder = "Search Zip Code" class="search-input-text search_col search_box6" style = "visibility: hidden"><button style = 'display: none' class = 'minus_button6' onclick = "minusSearchCounter('.search_box6', '.add_button6', '.minus_button6')">Clear Zipcode</button><button class = "add_button6" onclick = "addSearchCounter('.search_box6', '.add_button6', '.minus_button6')">Search by zipcode</button></td>
  				<td><input type="text" text = "call_back_date" data-column="8"  placeholder = "Search call_back_date" class="search-input-text search_col search_box7" style = "visibility: hidden"><button style = 'display: none' class = 'minus_button7' onclick = "minusSearchCounter('.search_box7', '.add_button7', '.minus_button7')">Clear Call Back Date</button><button class = "add_button7" onclick = "addSearchCounter('.search_box7', '.add_button7', '.minus_button7')">Search by Call Back Date</button></td>

  				<td>
              <select text = "priority" data-column="9"  class="search-input-select search_col search_box8" style = "visibility: hidden">
                  <option value="">(Search Priority)</option>
  								<option value="HIGH">HIGH</option>
                  <option value="CALL">CALL</option>
                  <option value="CALL BACK">CALL-BACK</option>
  								<option value="MUST CALL">MUST CALL</option>
  								<option value="LOW">LOW</option>
              </select>
  			<button style = 'display: none' class = 'minus_button8' onclick = "minusSearchCounter('.search_box8', '.add_button8', '.minus_button8')">Clear priority</button><button class = "add_button8" onclick = "addSearchCounter('.search_box8', '.add_button8', '.minus_button8')">Search by priority</button>
          </td>
  				<td><input type="text" text = "title" data-column="10"  placeholder = "Search Title" class="search-input-text search_col search_box9" style = "visibility: hidden"><button style = 'display: none' class = 'minus_button9' onclick = "minusSearchCounter('.search_box9', '.add_button9', '.minus_button9')">Clear title</button><button class = "add_button9" onclick = "addSearchCounter('.search_box9', '.add_button9', '.minus_button9')">Search by title</button></td>
  				<td><input type="text" text = "phone" data-column="11"  placeholder = "Search Phone" class="search-input-text search_col search_box10" style = "visibility: hidden"><button style = 'display: none' class = 'minus_button10' onclick = "minusSearchCounter('.search_box10', '.add_button10', '.minus_button10')">Clear Phone</button><button class = "add_button10" onclick = "addSearchCounter('.search_box10', '.add_button10', '.minus_button10')">Search by Phone</button></td>
  				<td><input type="text" text = "web_address" data-column="12"  placeholder = "Search Website" class="search-input-text search_col search_box11" style = "visibility: hidden"><button style = 'display: none' class = 'minus_button11' onclick = "minusSearchCounter('.search_box11', '.add_button11', '.minus_button11')">Clear WebAddress</button><button class = "add_button11" onclick = "addSearchCounter('.search_box11', '.add_button11', '.minus_button11')">Search by WebAddress</button></td>
  				<td><input type="text" text = "email1" data-column="13"  placeholder = "Search Email" class="search-input-text search_col search_box12" style = "visibility: hidden"><button style = 'display: none' class = 'minus_button12' onclick = "minusSearchCounter('.search_box12', '.add_button12', '.minus_button12')">Clear Email</button><button class = "add_button12" onclick = "addSearchCounter('.search_box12', '.add_button12', '.minus_button12')">Search by Email</button></td>
  				<td><input type="text" text = "vertical1" data-column="14"  placeholder = "Search Vertical1" class="search-input-text search_col search_box13" style = "visibility: hidden"><button style = 'display: none' class = 'minus_button13' onclick = "minusSearchCounter('.search_box13', '.add_button13', '.minus_button13')">Clear Vertical 1</button><button class = "add_button13" onclick = "addSearchCounter('.search_box13', '.add_button13', '.minus_button13')">Search by Vertical 1</button></td>
  				<td><input type="text" text = "vertical2" data-column="15"  placeholder = "Search Vertical2" class="search-input-text search_col search_box14" style = "visibility: hidden"><button style = 'display: none' class = 'minus_button14' onclick = "minusSearchCounter('.search_box14', '.add_button14', '.minus_button14')">Clear Vertical 2</button><button class = "add_button14" onclick = "addSearchCounter('.search_box14', '.add_button14', '.minus_button14')">Search by Vertical 2</button></td>
  				<td><input type="text" text = "vertical3" data-column="16"  placeholder = "Search Vertical3" class="search-input-text search_col search_box15" style = "visibility: hidden"><button style = 'display: none' class = 'minus_button15' onclick = "minusSearchCounter('.search_box15', '.add_button15', '.minus_button15')">Clear Vertical 3</button><button class = "add_button15" onclick = "addSearchCounter('.search_box15', '.add_button15', '.minus_button15')">Search by Vertical 3</button></td>
  			</tr>
		</tfoot>
		<tbody>
		</tbody>
	</table>
</div>
</div>

