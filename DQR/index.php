<html>

  <head>
    <title>Drag drop Images, PDF, Docs and other files Example : PHP + Dropzone.js</title>
    <style type="text/css">
      #container {
        position:relative;
         top: 30%;
         padding-top: 50px;
         left: 50%;
         width:30em;
         height:18em;
         margin-top: -9em; /*set to a negative number 1/2 of your height*/
         margin-left: -15em; /*set to a negative number 1/2 of your width*/
      }
      .drop-zone-table{
        display: inline-block;
        position: relative;
        padding: 10px;
        width: 100%;
        float:left;
        height: 80px;
        top: 20px;
      }
        #drop-zone {
          display: block;
          /*Sort of important*/
          width: 100%;
          /*Sort of important*/
          height: 200px;
          border: 2px dashed rgba(0,0,0,.3);
          border-radius: 20px;
          font-family: Arial;
          text-align: center;
          line-height: 180px;
          font-size: 20px;
          color: rgba(0,0,0,.3);
        }


        /*Important*/
        #drop-zone.mouse-over {
            border: 2px dashed rgba(0,0,0,.5);
            color: rgba(0,0,0,.5);
        }


        /*If you dont want the button*/
        #clickHere{
          position: absolute;
          cursor: pointer;
          left: 50%;
          top: 50%;
          margin-left: -70px;
          margin-top: 20px;
          line-height: 26px;
          color: white;
          font-size: 13px;
          width: 130px;
          height: 26px;
          border-radius: 4px;
          background-color: #3b85c3;
          font-family: sans-serif;
        }

        #submit{
          margin-top: 20px;
          line-height: 15px;
          color: white;
          font-size: 12px;
          width: 100px;
          height: 26px;
          border-radius: 4px;
          background-color: #3b85c3;
        }

        #clickHere:hover {
            background-color: #4499DD;

        }
    </style>
    <link href="table.css" rel='stylesheet' />
  </head>
  <body>
    <label style="display: block; font-size: 1.65em; text-align: center;">Welcome to DQR generator. Drop some excel files into the box below and press merge button<br> to get DQR file with seperate color coded values.</label>
    <div id="container">
      <form action="upload.php" method="post" name="uploadform" id = "uploadform" enctype="multipart/form-data">
        <div id="drop-zone">
            Drop files here...
            <div id="clickHere">
                or click here..
                <input type="file" name="file[]" id="file" multiple="multiple" webkitdirectory  style='opacity:0; position: absolute;cursor: pointer;'/>
            </div>
        </div>
      </form>
      <div id="modal-content">
        <input id= "submit"type="submit" value="Generate" />
      </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript">
      $("#file").on("change", function(event){
        count = 0;
        $("#drop-zone").after('<div class="drop-zone-table"><table id="filelist"><th>Files</th><th>Choice</th><tbody id= "filelistbody"></tbody></table></div>');
        var files = $('#file').prop('files');
        $.map(files, function (val) {
          $('#filelistbody').append("<tr><td>"+val.name+"</td><td><select class='chosen" + (count) + "' name='chosen" + (count) + "' ><option value=''></option><option value='Moved'>Moved</option><option value='Moved Errors'>Moved Errors</option><option value='Fixed'>Fixed</option><option value='Duplicate'>Duplicate</option><option value='Foreigns'>Foreigns</option><option value='Not Sent'>Not Sent</option><option value='Unknown'>Unknown</option></select></td></tr>");
          count++;
        });
      });

      $('#submit').on('click', function(){
        $('#uploadform').submit();
      });

      $(function () {
        var dropZoneId = "drop-zone";
        var buttonId = "clickHere";
        var mouseOverClass = "mouse-over";

        var dropZone = $("#" + dropZoneId);
        var ooleft = dropZone.offset().left;
        var ooright = dropZone.outerWidth() + ooleft;
        var ootop = dropZone.offset().top;
        var oobottom = dropZone.outerHeight() + ootop;
        var inputFile = dropZone.find("input");
        document.getElementById(dropZoneId).addEventListener("dragover", function (e) {
            e.preventDefault();
            e.stopPropagation();
            dropZone.addClass(mouseOverClass);
            var x = e.pageX;
            var y = e.pageY;

            if (!(x < ooleft || x > ooright || y < ootop || y > oobottom)) {
                inputFile.offset({ top: y - 15, left: x - 100 });
            } else {
                inputFile.offset({ top: -400, left: -400 });
            }

        }, true);

        if (buttonId != "") {
            var clickZone = $("#" + buttonId);

            var oleft = clickZone.offset().left;
            var oright = clickZone.outerWidth() + oleft;
            var otop = clickZone.offset().top;
            var obottom = clickZone.outerHeight() + otop;

            $("#" + buttonId).mousemove(function (e) {
                var x = e.pageX;
                var y = e.pageY;
                if (!(x < oleft || x > oright || y < otop || y > obottom)) {
                    inputFile.offset({ top: y - 15, left: x - 160 });
                } else {
                    inputFile.offset({ top: -400, left: -400 });
                }
            });
        }

        document.getElementById(dropZoneId).addEventListener("drop", function (e) {
            $("#" + dropZoneId).removeClass(mouseOverClass);
        }, true);
      });

    </script>
  </body>
</html>
