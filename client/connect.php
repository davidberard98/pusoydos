<!doctype html>
<html>
<head>
  <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script type="text/javascript">
  var sessID = "<?php
    echo sha1($_SERVER['REMOTE_ADDR'] . "_" . microtime(true));
  ?>";
  function pingServer()
  {
    // The server will be contacted periodically to
    //   first: inform server the player is still here
    //   second: check if 4 players have been found.
    $.ajax({
      type: "POST",
      url: "pserv.php",
      data: {
        id: sessID
      }
    }).done(function( data ) {
      if(data == 'four') {
        $("#aaer").text("Four players available!");
      }
      else {
        setTimeout(pingServer, 1000);
      }
    });
  }

  </script>
</head>
<body>
  <span id="aaer"></span>
</body>
</html>
