<!doctype html>
<html>
<head>
  <title>Play Pusoy Dos Online</title>
  <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css" />
  <script type="text/javascript">
  function drag(ev, tid)
  {
    tid.remove();
  }
  var draggedCard = "none";
  function setDragSettings()
  {
    $(".cardholder img").each(function(index, value){
      //alert($(value).attr("src"));
      $(value).on("dragstart", function(ev){
        //alert("dragstart");
        $(value).animate({"width":"70px"}, 300, function(){$(value).css("width", "0px")});
        draggedCard = $(value).attr("src");
        //$(value).css("margin-right", "-100px");
      });
      $(value).on('dragend', function(ev){
        //alert('dragstop');
        $(value).animate({"width":"100px"}, 300, function(){});
      });
    });
  }
  $(document).mouseoff
  $(document).ready(function(){
    setDragSettings();
  });

  /*$(document).mousemove(function(e){
    $("#image").css({left:e.pageX, top:e.pageY});
  }); */
  </script>
</head>
<body>
<img src="cards/halfs/8s.png" id="image" style="position:absolute;" />
<div class="cardpilevert">
  <div class="cardpile">
    <img src="cards/halfs/1s.png" alt="ace of spades" class="handcard" />
    <img src="cards/halfs/1h.png" alt="ace of hearts" class="handcard" />
    <img src="cards/halfs/2d.png" alt="two of diamonds" class="handcard" />
  </div>
</div>

<div class="foot">
  <div class="deckprep">
    Prepare your hand
  </div>
  <div class="cardholder">
    <img src="cards/halfs/1s.png" alt="ace of spades" class="handcard" draggable="true" />
    <img src="cards/halfs/1h.png" alt="ace of hearts" class="handcard" />
    <img src="cards/halfs/2d.png" alt="two of diamonds" class="handcard" />
    <img src="cards/halfs/3c.png" alt="three of clubs" class="handcard" />
    <img src="cards/halfs/3c.png" alt="three of clubs" class="handcard" />
    <img src="cards/halfs/3c.png" alt="three of clubs" class="handcard" />
    <img src="cards/halfs/3c.png" alt="three of clubs" class="handcard" />
    <img src="cards/halfs/3c.png" alt="three of clubs" class="handcard" />
    <img src="cards/halfs/3c.png" alt="three of clubs" class="handcard" />
    <img src="cards/halfs/3c.png" alt="three of clubs" class="handcard" />
    <img src="cards/halfs/3c.png" alt="three of clubs" class="handcard" />
    <img src="cards/halfs/3c.png" alt="three of clubs" class="handcard" />
    <img src="cards/halfs/3c.png" alt="three of clubs" class="handcard" />
  </div>
</div>
</body>
</html>
