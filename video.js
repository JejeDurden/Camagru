navigator.getUserMedia = (navigator.getUserMedia ||
		navigator.webkitGetUserMedia ||
		navigator.mozGetUserMedia ||
		navigator.msGetUserMedia);

var constraints = {
	video: true,
	audio: false
};

var viWidth = 640;
var viHeight = 480;

var video = document.querySelector('video');
if (video)
{
	var video_statut = true;
	var image_statut = false;
}
else
{
	var video_statut = false;
	var image_statut = true;
}

if (image_statut == true)
{
	var upload = document.getElementById("cam");
	upload.style.width = viWidth;
	upload.style.height = viHeight;
}

var current;
var PosX = 10;
var PosY = 10;

if (navigator.getUserMedia && video)
	navigator.getUserMedia(constraints, successCallback, errorCallback);

function successCallback(localMediaStream) 
{
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
		var cam = document.getElementById('cam');
		var canvas = document.getElementById('image');
		canvas.width = viWidth;
		canvas.height = viHeight;
		var context = canvas.getContext('2d');
		var filter = document.querySelector('input[name = "filter"]:checked');
		if (filter)
		{
			context.drawImage(cam, 0, 0);
			var img = new Image();
			img.src = filter.value;
			context.drawImage(img, PosX, PosY);
			var data = canvas.toDataURL('image/png');
			canvas.setAttribute('src', data);
			var fd = new FormData();
			fd.append('data', data);
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
		var cam = document.getElementById('cam');
		var canvas = document.getElementById('image');
		canvas.width = viWidth;
		canvas.height = viHeight;
		var context = canvas.getContext('2d');
		context.clearRect(0, 0, canvas.width, canvas.height);
		canvas.style.width = viWidth;
		canvas.style.height = viHeight;
		canvas.style.marginTop = viHeight * -1;
		canvas.style.display = "block";
		var img = new Image();
		img.src = document.getElementById(img_url).value;
		context.drawImage(img, PosX, PosY, 64, 64);
		if (video_statut == true)
			cam.addEventListener("click", getClickPosition, false);
		else
			canvas.addEventListener("click", getClickPosition, false);

	}
}

function getClickPosition(event)
{
	if (current)
	{
		var rect = document.getElementById('cam').getBoundingClientRect();
		PosX = event.clientX - rect.left;
		PosY = event.clientY - rect.top;
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

