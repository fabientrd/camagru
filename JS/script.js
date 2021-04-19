window.onload = function () {

    // Normalize the letious vendor prefixed versions of getUserMedia.
    let video = document.getElementById('camera-stream');

    if (navigator.mediaDevices.getUserMedia) {
        // Request the camera.
        navigator.mediaDevices.getUserMedia({video: true})
            .then(function (stream) {
                video.srcObject = stream;
            })
            .catch(function () {
                console.log("Something went wrong!");
            });

    } else {
        alert('Sorry, your browser does not support getUserMedia');
    }
};

function del(pic) {
    document.location.href = '../Redirection/delete_photo.php?pic=' + pic;
}

function savePic() {
    console.log('ok');
    let canvas = document.getElementById('canvas-stream2');
    document.getElementById('hidden_data').value = canvas.toDataURL();
    let fd = new FormData(document.forms["form1"]);
    let xhr = getXMLHttpRequest();
    xhr.open('POST', "../Redirection/add_photo.php", false);
    xhr.send(fd);
    document.location.href = 'index.php?save=1';
    // location.reload();
    // location.reload();
}

function saveUpPic() {
    let canvas = document.getElementById('canvas-stream1');
    document.getElementById('hidden_data').value = canvas.toDataURL();
    let fd = new FormData(document.forms["form1"]);
    let xhr = getXMLHttpRequest();
    xhr.open('POST', "../Redirection/add_photo.php", false);
    xhr.send(fd);
    document.location.href = 'index.php?save=1';
    // location.reload();
    // location.reload();
}

function newSnap() {
    document.getElementById('takeBut').removeEventListener('click', newSnap);
    document.location.href = '../View/index.php';
    // location.reload();
}

function takeSnap(filter) {
    let video = document.getElementById('camera-stream');
    let canvas = document.getElementById('canvas-stream2');
    let ctx = canvas.getContext('2d');
    let button = document.getElementById('takeBut');
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
    let base_image = new Image();
    base_image.src = filter;
    ctx.drawImage(base_image, 130, 10, 70, 60);
    video.srcObject = null;
    document.getElementById('saveBut').addEventListener('click', savePic);
    document.getElementById('takeBut').removeEventListener('click', function () {
        takeSnap(filter);
    });
    button.value = 'RETAKE PICTURE';
    document.getElementById('takeBut').addEventListener('click', function () {
        newSnap();
    });
}

function takeUpSnap(filter) {
    let canvas = document.getElementById('canvas-stream1');
    let ctx = canvas.getContext('2d');
    let button = document.getElementById('takeBut');
    let base_image = new Image();
    console.log(filter);
    base_image.src = filter;
    document.getElementById('canvas-filter').getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
    ctx.drawImage(base_image, 570, 60, 260, 350);
    document.getElementById('saveBut').addEventListener('click', saveUpPic);
    document.getElementById('takeBut').removeEventListener('click', function () {
        takeUpSnap(filter);
    });
    button.value = 'RETAKE PICTURE';
    document.getElementById('takeBut').addEventListener('click', function () {
        newSnap();
    });
}

function getXMLHttpRequest() {
    var xhr = null;

    if (window.XMLHttpRequest || window.ActiveXObject) {
        if (window.ActiveXObject) {
            try {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
        } else {
            xhr = new XMLHttpRequest();
        }
    } else {
        alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
        return null;
    }

    return xhr;
}

document.getElementById('uploadBut').onclick = function uploadPic() {
    window.location.replace('http://localhost:8100/camagru/View/index.php?upload=1');
};

var imageLoader = document.getElementById('imageLoader');
imageLoader.addEventListener('change', handleImage, false);
var canvas = document.getElementById('canvas-stream1');
var ctx = canvas.getContext('2d');


function handleImage(e) {
    let reader = new FileReader();
    reader.onload = function (event) {
        let img = new Image();
        img.onload = function () {
            canvas.width = 1311.57;
            canvas.height = 877.09;
            ctx.drawImage(img, 0, 0, 1311.59, 877.09);
        };
        img.src = event.target.result;
    };
    reader.readAsDataURL(e.target.files[0]);
}

function drawFilter(idFilter) {
    let url = window.location.href;
    let string = '?upload';
    console.log('url = ' + url);
    let filter = document.getElementById(idFilter).src;
    let canvas = document.getElementById('canvas-filter');
    let context = canvas.getContext('2d');
    let base_image = new Image();
    base_image.src = filter;
    context.clearRect(0, 0, canvas.width, canvas.height);
    context.drawImage(base_image, 130, 10, 60, 60);
    if (url.includes(string))
        document.getElementById('takeBut').onclick = () => takeUpSnap(filter);
    else
        document.getElementById('takeBut').onclick = () => takeSnap(filter);
}
