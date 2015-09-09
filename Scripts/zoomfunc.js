function imgzoom(o){
	var zoom=parseInt(o.style.zoom, 10)||100;zoom+=event.wheelDelta/12;if (zoom>0) o.style.zoom=zoom+'%';return false;
}

<!-------JavaScript可以滑鼠拖拉的圖片 START-------->
<!-- Original: Randy Bennett (rbennett@thezone.net) -->
<!-- Web Site: http://home.thezone.net/~rbennett/sitemap.htm -->

<!-- This script and many more are available free online at -->
<!-- The JavaScript Source!! http://javascript.internet.com -->

<!-- Begin
N = (document.all) ? 0 : 1;
var ob;
function MD(e) {
if (N) {
ob = document.layers[e.target.name];
X=e.x;
Y=e.y;
return false;
}
else {
ob = event.srcElement.parentElement.style;
X=event.offsetX;
Y=event.offsetY;
}
}
function MM(e) {
if (ob) {
if (N) {
ob.moveTo((e.pageX-X), (e.pageY-Y));
}
else {
ob.pixelLeft = event.clientX-X + document.body.scrollLeft;
ob.pixelTop = event.clientY-Y + document.body.scrollTop;
return false;
}
}
}
function MU() {
ob = null;
}

if (N) {
document.captureEvents(Event.MOUSEDOWN | Event.MOUSEMOVE | Event.MOUSEUP);
}
document.onmousedown = MD;
document.onmousemove = MM;
document.onmouseup = MU;
// End -->
<!-------JavaScript可以滑鼠拖拉的圖片 END-------->