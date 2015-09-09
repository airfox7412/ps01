// jQuery.autoIMG.js v0.2 
// Tang Bin - http://planeArt.cn/ - MIT Licensed 
(function ($) { 
var // 設置載入狀態的替換圖像 
tempPath = './images/loading.png', 
// 設置載入錯誤的替換圖像 
errorPath = './images/error.png', 
// 檢測是否支持css2.1 max-width屬性 
isMaxWidth = 'maxWidth' in document.documentElement.style, 
// 檢測是否IE7瀏覽器 
isIE7 = !-[1,] && !('prototype' in Image) && isMaxWidth; 
new Image().src = tempPath; 
$.fn.autoIMG = function () { 
var $this = this, 
// 獲取容器寬度 
maxWidth = $this.width(); 
return $this.find('img').each(function (i, img) { 
// 如果支持max-width屬性則使用此，否則使用下面預載入方式 
if (isMaxWidth) return img.style.maxWidth = maxWidth + 'px'; 
var path = img.getAttribute('data-src') || img.src, 
next = img.nextSibling, 
parent = img.parentNode, 
temp = new Image(); 
// 刪除img圖像，並替換成loading圖片 
img.style.display = 'none'; 
img.removeAttribute('src'); 
img.parentNode.removeChild(img); 
temp.src = tempPath; 
next ? next.insertBefore(temp) : parent.appendChild(temp); 
// 圖片尺寸就緒執行 
imgReady(path, function (width, height) { 
if (width > maxWidth) { 
// 等比例縮放 
height = maxWidth / width * height, 
width = maxWidth; 
// 刪除loading圖像 
temp.parentNode.removeChild(temp); 
// 恢復顯示調整後的原圖像 
img.style.display = ''; 
img.style.width = width + 'px'; 
img.style.height = height + 'px'; 
img.setAttribute('src', path); 
next ? next.insertBefore(img) : parent.appendChild(img); 
}; 
}, function () { 
// 載入錯誤 
temp.src = errorPath; 
temp.title = 'Image load error!'; 
}); 
}); 
}; 
// IE7縮放圖片會失真，採用私有屬性通過三次插值解決 
isIE7 && (function (c,d,s) {s=d.createElement('style');d.getElementsByTagName('head')[0].appendChild(s);s.styleSheet&&(s.styleSheet.cssText+=c)||s.appendChild(d.createTextNode(c))})('img {-ms-interpolation-mode:bicubic}',document); 
// 獲取圖片頭的尺寸數據 
// http://www.planeart.cn/?p=1121 
// @param {String} 圖片路徑 
// @param {Function} 獲取尺寸的回調函數 (參數1接收width；參數2接收height) 
// @param {Function} 載入錯誤的回調函數 (可選) 
var imgReady = function (url, callback, error) { 
var width, height, offsetWidth, offsetHeight, intervalId, check, div, 
accuracy = 1024, 
doc = document, 
container = doc.body || doc.getElementsByTagName('head')[0], 
img = new Image(); 
img.src = url; 
// 如果圖片被緩存，則直接返回緩存數據 
if (img.complete) { 
return callback(img.width, img.height); 
}; 
// 向頁面插入隱秘圖像，監聽圖片尺寸就緒狀態 
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
// 如果圖像尺寸開始變化，則表示瀏覽器已經獲取了圖片頭數據並佔位 
// 經過實測只有監聽img.offsetWidth才有效，同時檢測img.offsetHeight是為了保險 
// 如果新插入的圖片面積大於預設尺寸，很可能是執行前圖片以及在其他地方載入中，如基於webkit的瀏覽器 
if (offsetWidth !== width || offsetHeight !== height || offsetWidth * offsetHeight > accuracy) { 
clearInterval(intervalId); 
callback(offsetWidth, offsetHeight); 
// 清空img的事件與元素，避免IE內存泄漏 
img.onload = null; 
div.innerHTML = ''; 
div.parentNode.removeChild(div); 
}; 
}; 
check(); 
// 定期執行檢測 
intervalId = setInterval(check, 150); 
}; 
// 等待圖片完全載入完畢 
// 這是一個保險操作，如果上面的監聽尺寸方法失敗則會啟用此 
// 如果很小的圖像有可能載入時間小於定時器定義的檢測間隔時間，則會停止定時器 
img.onload = function () { 
callback(img.width, img.height); 
img.onload = img.onerror = null; 
clearInterval(intervalId); 
container && img.parentNode.removeChild(img); 
}; 
// 圖像載入錯誤 
img.onerror = function () { 
error && error(); 
clearInterval(intervalId); 
container && img.parentNode.removeChild(img); 
}; 
}; 
})(jQuery); 