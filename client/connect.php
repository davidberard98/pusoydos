<!doctype html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css" />
  <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script type="text/javascript">
  var sessID = "<?php
    echo sha1($_SERVER['REMOTE_ADDR'] . "_" . microtime(true));
  ?>";
  var displayName = NULL;
  var stillloading = false;
  function pingServer()
  {
    // The server will be contacted periodically to
    //   first: inform server the player is still here
    //   second: check if 4 players have been found.

    $.ajax({
      type: "POST",
      url: "serv/pserv.php",
      data: {
        id: sessID,
        name: displayName,
        type: "findmatch"
      }
    }).done(function( data ) {
      if(data != "") {
        console.log(data);
      }
      if(data == 'four') {
        $("#largeloading").text("Four players available!");
      }
      else {
        setTimeout(pingServer, 1000);
      }
    });
  }

  function loading()
  {

    if($("#largeloadingdots").text().length <= 3)
    {
      $("#largeloadingdots").append(".");
    }
    else {
      $("#largeloadingdots").text("");
    }
    if(stillloading)
      setTimeout(loading, 250);
  }

  function servercheck()
  {
    displayName = "";
    var tentativename = $("#screenname").val();

    for(var i=0;i<tentativename.length;++i)
    {
      if((tentativename.charCodeAt(i) <= 57 && tentativename.charCodeAt(i) >= 48) ||
         (tentativename.charCodeAt(i) <= 122&& tentativename.charCodeAt(i) >= 65))
      {
        displayName += tentativename.charAt(i);
      }
    }

    $("#nameprompt").text("");
    $("#nameprompt").append("<span id='largeloading'>Loading <span id='largeloadingdots'></span></span>");
    stillloading = true;
    loading();
    pingServer();
  }

  </script>
</head>
<body>
  <div id="cover">
    <div id="toppart"></div>
    <div id="nameprompt">
      Screen name:<br />
      <input type="text" id="screenname" /><br /><br />
      <button onclick="servercheck()">Look for players</button>
    </div>
  </div>
</body>
</html>
