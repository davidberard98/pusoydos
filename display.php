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
  var insidePrepArea = false;
  var mouseX = -1;
  var mouseY = -1; /*
  $(document).on("dragover", function(event) {
    mouseX = event.pageX;
    mouseY = event.pageY;
    console.log(mouseX + " " + mouseY)
  }); */
  $(document).on('dragover', function(evt) {
    mouseX = evt.originalEvent.pageX,
    mouseY= evt.originalEvent.pageY;
});
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
        ev.preventDefault();
        ev.stopPropagation();
        var doff = $(".deckprep").offset();
        var dw = $(".deckprep").width();
        var dh = $(".deckprep").height();
        //console.log("hi");
        if(doff.left < mouseX && doff.left + dw > mouseX &&
        doff.top < mouseY && doff.top + dh > mouseY)
        {
          console.log("Dropped inside box!");
          $(".deckprep #words").text("");
          $(".deckprep #cards").append("<img src='" + $(value).attr("src") + "' class='handcard' />");
          $(this).remove();
        }
        else {
          $(value).animate({"width":"100px"}, 300, function(){});
        }
      });
    });
  }
  cactusWidth = $(this).width();
  cactusHeight = $(this).height()-50;
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
    <span id="words">Prepare your hand</span>
    <span id="cards"></span>
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
