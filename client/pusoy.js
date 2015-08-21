function parseCN(cnval)
{
  var rval = cnval.substr(0, cnval.length-1);
  rval = parseInt(rval);
  var sval = cnval.substr(cnval.length-1, 1);
  var output = {rank: rval, suite: sval};
  return output;
}

function removeCardholderConstraints(){
  $(".cardholder img").each(function(index, value){
    $(value).off("dragstart");
    $(value).off('dragend');
  });
}
function removeDeckprepConstraints(){
  $(".deckprep img").each(function(index, value){
    $(value).off("dragstart");
    $(value).off('dragend');
  });
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
function dragSetCardholder()
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
        $(".deckprep #cards").append("<img src='" + $(value).attr("src") + "' class='handcard' data-cn='" + $(value).attr("data-cn") + "' draggable='true' />");
        $(this).remove();
        removeDeckprepConstraints();
        removeCardholderConstraints();
        dragSetCardholder();
        dragSetDeckprep();
      }
      else {
        $(value).animate({"width":"100px"}, 300, function(){});
      }
    });
  });
}
function dragSetDeckprep()
{
  $(".deckprep #cards img").each(function(index, value){
    $(this).on('dragstart', function(){
      $(value).animate({"width":"70px"}, 300, function(){$(value).css("width", "0px")});
      draggedCard = $(value).attr("src");
    });
    $(this).on('dragend', function(ev){
      console.log("dsd end");
      ev.preventDefault();
      ev.stopPropagation();
      var coff = $(".cardholder").offset();
      var cw = $(".cardholder").width();
      var ch = $(".cardholder").height();
      //console.log("hi");
      if(coff.left < mouseX && coff.left + cw > mouseX &&
      coff.top < mouseY && coff.top + ch > mouseY)
      {
        console.log("Dropped back inside");
        $(".cardholder").append("<img src='" + $(value).attr("src") + "' class='handcard' data-cn='" + $(value).attr("data-cn") + "' draggable='true' />");
        $(this).remove();
        removeDeckprepConstraints();
        removeCardholderConstraints();
        dragSetCardholder();
        dragSetDeckprep();
        if($(".deckprep #cards").text() ==)
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
  dragSetCardholder();
  dragSetDeckprep();
});
