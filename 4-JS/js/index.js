window.onload = function () {
	var prebutton = document.getElementById("pre");
	var nextbutton = document.getElementById("next");
	var img = document.getElementById("img");
	var url = ['images/1.jpg', 'images/2.jpg', 'images/3.jpg', 'images/4.jpg', 'images/5.jpg'];
	var num = 0;
	function fnTab() {
		img.src = url[num];
	}
	fnTab();
	prebutton.onclick = function () {
		num = num - 1;
		if (num < 0) {
			num = 0;
			alert('已经是第一张啦！！！')
		}
		fnTab();
	};
	nextbutton.onclick = function () {
		num = num + 1;
		if (num > url.length - 1) {
			num = url.length - 1;
			alert('已经是最后一张了！！！')
		}
		fnTab();
	};
}