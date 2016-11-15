<?php require("header.php"); ?>

<style>

  #crm-table tr td {
      height: 20px;
  }
  .dataTables_wrapper { font-size: 12px }
  .dataTables_wrapper .dt-buttons {
    float:none;
    text-align:right;
  }

  	div.header {
  			margin: 200px auto;
  			line-height:30px;
  			max-width:500px;
  	}
  	body {
  			background: #f7f7f7;
  			color: #333;
  			font: 90%/1.45em "Helvetica Neue",HelveticaNeue,Verdana,Arial,Helvetica,sans-serif;
  	}
</style>
<script type="text/javascript" language="javascript" >

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
  		var dataTable = $('#crm-table').DataTable( {

  			dom: 'B<"toolbar">lfrtip',
        select: {style: 'multi'},
  			buttons: ['selectAll','selectNone',
          {
              extend: 'selected',
              text: 'Show selected rows only',
              action: function ( e, dt, button, config ) {
                  if (button.text() == 'Show selected rows only') {
                      dt.rows({ selected: false }).nodes().to$().css({"display":"none"});
                      button.text('Show all');
                  }
                  else {
                      dt.rows({ selected: false }).nodes().to$().css({"display":"table-row"});
                      button.text('Show selected rows only');
                  }
              }
          },
          {
  					extend: 'collection',
  	        text: 'Export Selected',
  	        buttons: [
  					{
  						extend: 'copy',
  						exportOptions: {
  						columns: ':visible:not(.not-exported)',
  						 modifier: { selected: true }
  						}
  					},{
  						extend: 'csv',
  						exportOptions: {
  						columns: ':visible:not(.not-exported)',
  						 modifier: { selected: true }
  						}
  					},{
  						extend: 'excel',
  						exportOptions: {
  						columns: ':visible:not(.not-exported)',
  						 modifier: { selected: true }
  						}
  					},{
  						extend: 'pdfHtml5',
  						orientation: 'landscape',
              pageSize: 'LEGAL',
  						exportOptions: {
  						//columns: ':visible:not(.not-exported)',
              //columns: ':not(.no-print)',
  						 modifier: { selected: true }
  						}
  					},{
  						extend: 'print',
  						exportOptions: {
  						columns: ':visible:not(.not-exported)',
  						 modifier: { selected: true }
  						}
  					}
  				]
        }],
  			"processing": true,
  			"serverSide": true,
        "deferRender": false,
  			"scrollX": true,
  			"ajax":{
  				url :"server-side-CRM.php", // json datasource
  				type: "post",  // method  , by default get
  				error: function(){  // error handling
  					$(".crm-table-error").html("");
  					$("#crm-table").append('<tbody class="crm-table-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
  					$("#crm-table_processing").css("display","none");
  				}
  			},
  			"columnDefs": [ {
  			    "targets": 1,
  			    "render": function ( data, type, row) {
              var str = serialize([row[1], row[3]]);
              var stren = urlencode(str);
  			      return '<a href="edit_client.php?client_info='+stren+'">'+row[1]+'</a>'; //link for each client name
  			    },
  			  },{
         'targets': 0,
         'searchable': false,
         'orderable': false,
         'className': 'dt-body-center',
         'render': function (data, type, row){
           //console.log(row);
           if (row[0] == 1) {
             return '<input type="checkbox" id = "checkbox" name="id[]" checked>';
           }else {
             return '<input type="checkbox" id = "checkbox" name="id[]">';
           }
         }
       }
        ],
        'select': {
            style: 'multi',
          },
          "order": [[ 1, "asc" ]]
  	});
//save search button
$("div.toolbar").html('<button id = "save_button" class = "dt-button" style = "margin-left: 150px;">Save search</button>');
//==============================================================================
$.fn.DataTable.TableTools.buttons.download = $.extend(
    true,
    {},
    $.fn.DataTable.TableTools.buttonBase,
    {
        "sButtonText": "Download",
        "sUrl":      "",
        "sType":     "POST",
        "fnData":    false,
        "fnClick": function( button, config ) {
            var dt = new $.fn.DataTable.Api( this.s.dt );
            var data = dt.ajax.params() || {};

            // Optional static additional parameters
            // data.customParameter = ...;

            if ( config.fnData ) {
                config.fnData( data );
            }

            var iframe = $('<iframe/>', {
                    id: "RemotingIFrame"
                }).css( {
                    border: 'none',
                    width: 0,
                    height: 0
                } )
                .appendTo( 'body' );

            var contentWindow = iframe[0].contentWindow;
            contentWindow.document.open();
            contentWindow.document.close();

            var form = contentWindow.document.createElement( 'form' );
            form.setAttribute( 'method', config.sType );
            form.setAttribute( 'action', config.sUrl );

            var input = contentWindow.document.createElement( 'input' );
            input.name = 'json';
            input.value = JSON.stringify( data );

            form.appendChild( input );
            contentWindow.document.body.appendChild( form );
            form.submit();
        }
    }
);
$('.buttons-csv').on('click', function(){
  console.log("hello");
  confirm("Are you sure you want to export to CSV?");

});

$('#crm-table').on('page.dt', function(){
  console.log("page");
});

    $('#export').on('click', function() {
      var sqlsend = dataTable.ajax.json().sql;
      window.location.href="server-side-CSV.php?val="+sqlsend;
    });

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


// If any row selected change the counter of "Row selected".
		$('#crm-table tbody').on( 'click', 'tr', function () {
					updateCounter();
		});


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
      updateCounter();
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
  			updateCounter();
  	});

  	function updateCounter(){
  		var len = dataTable.rows('.selected').data().length;
  		if(len>0){
  			$("#general i .counter").text('('+len+')');
  		}
  		else{$("#general i .counter").text('');}
  	}

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

    $('#crm-table tbody').on('click','tr',function() {
        var checked = $(this).find('input[type="checkbox"]').prop('checked');
        var clientName = $(this).find('td').eq(1).text();
        var Address = $(this).find('td').eq(3).text();
        $.ajax({
          type:'POST',
          url: 'CRM_updateMarked.php',
          data: {
            'function': 1,
            'checked': checked,
            'CName': clientName,
            'address': Address
          }
        });

    });

	});
</script>

<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
		<h1 class="pull-left">CRM</h1>
		<a class="pull-right" href="add_client.php" class="add_button">Upload</a>
	</div>
<div class="dashboard-detail">

			<div class="contacts-title">
        <a title="Filter Category" id="general" class=""><i>Record selected <small class="counter"></small></i></a>

				<a id = 'show_saved_search' class="pull-right" class="add_button" onclick = 'showSavedSearch()' href = "#" style = "background: #ff5c33">Show Saved Search</a>
				<form class = 'advanced_search_area' action = 'advanced_search_CRM.php' method = 'post'>
					<input id = 'advanced_search_submit' name = 'advanced_search_submit' style = 'display: none; margin-right: 5%; margin-bottom: 5%; background-color: #000000; color: #ffffff' type = 'submit' value = "Search">
					<input id = 'advanced_search_and_save' name = 'advanced_search_and_save' style = 'display: none; margin-bottom: 5%; background-color: #000000; color: #ffffff' type = 'submit' value = "Search and Save">
					<input id = 'advanced_save' name = 'advanced_save' style = 'display: none; margin-bottom: 5%; margin-left: 5%; background-color: #000000; color: #ffffff' type = 'submit' value = "Save">
					<input id = 'advanced_search_name' name = 'advanced_search_name' style = 'display: none; width: 200px; margin-left: 3%; margin-bottom: 3%' type = 'text' placeholder = 'Enter Saved Search Name'>
				</form>
			</div>
			<div id="saved_search_div">

				<table id="saved_search_table" style = 'display: none'>
					<tbody>
						<?php
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
								echo "<tr id = 'row" . $search_id . "'><td class='data-cell'><a href = 'advanced_search_CRM.php?field1=$field1&value1=$value1&field2=$field2&value2=$value2&field3=$field3&value3=$value3&search_id=$search_id'>". $row["search_name"]."</a></td><td><button id = '" . $search_id . "'><img src = 'images/x_button.png' width = '25' height = '25'></button></tr>";
							}
						}
						else {
							echo "0 Saved Searches";
						}
						?>
					</tbody>
				</table>
			</div>
</div>
<div id = 'allcontacts-table' class='allcontacts-table'>
  <div class='button DTTT_button'>
  <a href="#" class="form_button csv1"  id ="export" role='button'>Export</a>
</div>
	<table id="crm-table"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
			<thead>
				<tr>
          <th>Mark</th>
					<th>Client Name</th>
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
				<td><input type="text" data-column="1"  placeholder = "Search Client Name" class="search-input-text"></td>
	      <td><input type="text" data-column="2"  placeholder = "Search Business" class="search-input-text"></td>
				<td><input type="text" data-column="3"  placeholder = "Search Address" class="search-input-text"></td>
				<td><input type="text" data-column="4"  placeholder = "Search City" class="search-input-text"></td>
				<td><input type="text" data-column="5"  placeholder = "Search State" class="search-input-text"></td>
				<td><input type="text" data-column="6"  placeholder = "Search Zip Code" class="search-input-text"></td>
				<td><input type="text" data-column="7"  placeholder = "Search call_back_date" class="search-input-text"></td>

				<td>
            <select data-column="8"  class="search-input-select">
                <option value="">(Search Priority)</option>
								<option value="HIGH">HIGH</option>
                <option value="CALL">CALL</option>
                <option value="CALL BACK">CALL-BACK</option>
								<option value="MUST CALL">MUST CALL</option>
								<option value="LOW">LOW</option>
            </select>
        </td>
				<td><input type="text" data-column="9"  placeholder = "Search Title" class="search-input-text"></td>
				<td><input type="text" data-column="10"  placeholder = "Search Phone" class="search-input-text"></td>
				<td><input type="text" data-column="11"  placeholder = "Search Website" class="search-input-text"></td>
				<td><input type="text" data-column="12"  placeholder = "Search Email" class="search-input-text"></td>
				<td><input type="text" data-column="13"  placeholder = "Search Vertical1" class="search-input-text"></td>
				<td><input type="text" data-column="14"  placeholder = "Search Vertical2" class="search-input-text"></td>
				<td><input type="text" data-column="15"  placeholder = "Search Vertical3" class="search-input-text"></td>
			</tr>
		</tfoot>
		<tbody>
		</tbody>
	</table>
</div>
</div>
