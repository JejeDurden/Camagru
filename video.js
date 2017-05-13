navigator.getUserMedia = (navigator.getUserMedia ||
		navigator.webkitGetUserMedia ||
		navigator.mozGetUserMedia ||
		navigator.msGetUserMedia);

var constraints = {
	video: true,
	audio: false
};
var video_statut = true;
var image_statut = false;
var current;
var PosX = 0;
var PosY = 0;
var width = 0;
var height = 0;

document.addEventListener("click", function (e) {
console.log(e);
}, false);

if (navigator.getUserMedia)
	navigator.getUserMedia(constraints, successCallback, errorCallback);
else
	console.error("getUserMedia not supported");

function successCallback(localMediaStream) 
{
	var video = document.querySelector('video');
	video.src = window.URL.createObjectURL(localMediaStream);
	video.play();
};

function errorCallback(err) 
{
	video_statut = false;
	console.log("The following error occured: " + err);
};

function snap() {
	if (video_statut == true || image_statut == true) 
	{
		var video = document.querySelector('video');
		var canvas = document.getElementById('image');
		var context = canvas.getContext('2d');
		var filter = document.querySelector('input[name = "filter"]:checked');
		if (filter)
		{
			context.drawImage(video, 0, 0, 640, 400);
			var img = new Image();
			img.src = filter.value;
			context.drawImage(img, PosX, PosY, 64, 64);
			var data = canvas.toDataURL('image/png');
			canvas.setAttribute('src', data);
			document.getElementById('image').value = data;
			var fd = new FormData(document.forms["upload"]);
			var httpr = new XMLHttpRequest();
			httpr.open('POST', 'create_img.php', true);
			httpr.send(fd);
		} 
		else
			alert("Vous devez d'abord selectionner un filtre.");
	} 
	else
		alert("Vous devez d'abord activer votre webcam ou choisir une image.");
}

function show_img(img_url)
{
	if ((video_statut == true || image_statut == true) && img_url) 
	{
		current = img_url;
		var canvas = document.getElementById('image');
		var context = canvas.getContext('2d');
		context.clearRect(0, 0, canvas.width, canvas.height);
		width = canvas.width;
		height = canvas.height;
		canvas.addEventListener("click", getClickPosition, false);
		var img = new Image();
		img.src = document.getElementById(img_url).value;
		context.drawImage(img, PosX, PosY, 64, 64);
	}
}

function getClickPosition(e)
{
	if (current)
	{
		var rect = document.getElementById('image').getBoundingClientRect();
		PosX = e.pageX - rect.left - width;
		PosY = e.pageY - rect.top - height;
		PosX = PosX > 0 ? PosX : 0;
		PosY = PosY > 0 ? PosY : 0;
		show_img(current);
	}
}

function upload()
{
	event.preventDefault();
	document.getElementById('fileToUpload').click();
}

function clear() 
{
	this.value = null;
}

function sendImg()
{
	document.getElementById("upload").submit();
}
