// jQuery.autoIMG.js v0.2 
// Tang Bin - http://planeArt.cn/ - MIT Licensed 
(function ($) { 
var // �]�m���J���A�������Ϲ� 
tempPath = './images/loading.png', 
// �]�m���J���~�������Ϲ� 
errorPath = './images/error.png', 
// �˴��O�_���css2.1 max-width�ݩ� 
isMaxWidth = 'maxWidth' in document.documentElement.style, 
// �˴��O�_IE7�s���� 
isIE7 = !-[1,] && !('prototype' in Image) && isMaxWidth; 
new Image().src = tempPath; 
$.fn.autoIMG = function () { 
var $this = this, 
// ����e���e�� 
maxWidth = $this.width(); 
return $this.find('img').each(function (i, img) { 
// �p�G���max-width�ݩʫh�ϥΦ��A�_�h�ϥΤU���w���J�覡 
if (isMaxWidth) return img.style.maxWidth = maxWidth + 'px'; 
var path = img.getAttribute('data-src') || img.src, 
next = img.nextSibling, 
parent = img.parentNode, 
temp = new Image(); 
// �R��img�Ϲ��A�ô�����loading�Ϥ� 
img.style.display = 'none'; 
img.removeAttribute('src'); 
img.parentNode.removeChild(img); 
temp.src = tempPath; 
next ? next.insertBefore(temp) : parent.appendChild(temp); 
// �Ϥ��ؤo�N������ 
imgReady(path, function (width, height) { 
if (width > maxWidth) { 
// ������Y�� 
height = maxWidth / width * height, 
width = maxWidth; 
// �R��loading�Ϲ� 
temp.parentNode.removeChild(temp); 
// ��_��ܽվ�᪺��Ϲ� 
img.style.display = ''; 
img.style.width = width + 'px'; 
img.style.height = height + 'px'; 
img.setAttribute('src', path); 
next ? next.insertBefore(img) : parent.appendChild(img); 
}; 
}, function () { 
// ���J���~ 
temp.src = errorPath; 
temp.title = 'Image load error!'; 
}); 
}); 
}; 
// IE7�Y��Ϥ��|���u�A�ĥΨp���ݩʳq�L�T�����ȸѨM 
isIE7 && (function (c,d,s) {s=d.createElement('style');d.getElementsByTagName('head')[0].appendChild(s);s.styleSheet&&(s.styleSheet.cssText+=c)||s.appendChild(d.createTextNode(c))})('img {-ms-interpolation-mode:bicubic}',document); 
// ����Ϥ��Y���ؤo�ƾ� 
// http://www.planeart.cn/?p=1121 
// @param {String} �Ϥ����| 
// @param {Function} ����ؤo���^�ը�� (�Ѽ�1����width�F�Ѽ�2����height) 
// @param {Function} ���J���~���^�ը�� (�i��) 
var imgReady = function (url, callback, error) { 
var width, height, offsetWidth, offsetHeight, intervalId, check, div, 
accuracy = 1024, 
doc = document, 
container = doc.body || doc.getElementsByTagName('head')[0], 
img = new Image(); 
img.src = url; 
// �p�G�Ϥ��Q�w�s�A�h������^�w�s�ƾ� 
if (img.complete) { 
return callback(img.width, img.height); 
}; 
// �V�������J�����Ϲ��A��ť�Ϥ��ؤo�N�����A 
if (container) { 
div = doc.createElement('div'); 
div.style.cssText = 'visibility:hidden;position:absolute;left:0;top:0;width:1px;height:1px;overflow:hidden'; 
div.appendChild(img) 
container.appendChild(div); 
width = img.offsetWidth; 
height = img.offsetHeight; 
check = function () { 
offsetWidth = img.offsetWidth; 
offsetHeight = img.offsetHeight; 
// �p�G�Ϲ��ؤo�}�l�ܤơA�h����s�����w�g����F�Ϥ��Y�ƾڨæ��� 
// �g�L����u����ťimg.offsetWidth�~���ġA�P���˴�img.offsetHeight�O���F�O�I 
// �p�G�s���J���Ϥ����n�j��w�]�ؤo�A�ܥi��O����e�Ϥ��H�Φb��L�a����J���A�p���webkit���s���� 
if (offsetWidth !== width || offsetHeight !== height || offsetWidth * offsetHeight > accuracy) { 
clearInterval(intervalId); 
callback(offsetWidth, offsetHeight); 
// �M��img���ƥ�P�����A�קKIE���s�n�| 
img.onload = null; 
div.innerHTML = ''; 
div.parentNode.removeChild(div); 
}; 
}; 
check(); 
// �w�������˴� 
intervalId = setInterval(check, 150); 
}; 
// ���ݹϤ��������J���� 
// �o�O�@�ӫO�I�ާ@�A�p�G�W������ť�ؤo��k���ѫh�|�ҥΦ� 
// �p�G�ܤp���Ϲ����i����J�ɶ��p��w�ɾ��w�q���˴����j�ɶ��A�h�|����w�ɾ� 
img.onload = function () { 
callback(img.width, img.height); 
img.onload = img.onerror = null; 
clearInterval(intervalId); 
container && img.parentNode.removeChild(img); 
}; 
// �Ϲ����J���~ 
img.onerror = function () { 
error && error(); 
clearInterval(intervalId); 
container && img.parentNode.removeChild(img); 
}; 
}; 
})(jQuery); 