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
var PosX = 10;
var PosY = 10;
var width = 0;
var height = 0;

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
		var video = document.getElementById('cam');
		var canvas = document.getElementById('image');
		canvas.width = video.videoWidth;
		canvas.height = video.videoHeight;
		var context = canvas.getContext('2d');
		var filter = document.querySelector('input[name = "filter"]:checked');
		if (filter)
		{
			context.drawImage(video, 0, 0);
			var img = new Image();
			img.src = filter.value;
			context.drawImage(img, PosX, PosY);
			var data = canvas.toDataURL('image/png');
			canvas.setAttribute('src', data);
			document.getElementById('image').value = data;
			var httpr = new XMLHttpRequest();
			httpr.open('POST', 'create_img.php', true);
			httpr.send(canvas.src);
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
		var video = document.getElementById('cam');
		var canvas = document.getElementById('image');
		canvas.width = video.videoWidth;
		canvas.height = video.videoHeight;
		var context = canvas.getContext('2d');
		context.clearRect(0, 0, canvas.width, canvas.height);
		canvas.style.width = video.videoWidth;
		canvas.style.height = video.videoHeight;
		canvas.style.marginTop = video.videoHeight * -1;
		canvas.style.display = "block";
		var img = new Image();
		img.src = document.getElementById(img_url).value;
		context.drawImage(img, PosX, PosY, 64, 64);
		video.addEventListener("click", getClickPosition, false);
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
