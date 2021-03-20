function doBreak(event) {
    document.getElementById("article").value += "<br><br>";
}
function doHighlight(event){
    document.getElementById("article").value +="<blockquote class='bg-white'>  লেখা </blockquote>"
}
function doHighlightItalic(event){
    document.getElementById("article").value +="<blockquote class='bg-white'> <i> লেখা </i></blockquote>"
}
function doImage(event){
    document.getElementById("article").value += "<br><center><img class='col-sm-5' src='file_url'></center><br>";
}
doBreak(event);
doItalic(event);
doImage(event);
doHighlight(event);
doHighlightItalic(event)