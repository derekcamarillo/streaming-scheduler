var filename = "";

document.getElementById('logo-test').addEventListener('click', function() {

    //remove previous controller
    if (videojs.getPlayers()['my-video']) {
        delete videojs.getPlayers()["my-video"];
    }

    //draw video controller
    videoTagContent = '<video id="my-video" class="video-js vjs-big-play-centered" controls preload="auto" width="640" height="360">' +
        '<source src="//vjs.zencdn.net/v/oceans.mp4" type="video/mp4">' +
        '<source src="//vjs.zencdn.net/v/oceans.webm" type="video/webm">' +
        '</video>';
    document.getElementById("video-tag").innerHTML = videoTagContent;

    //get values
    xpos = document.getElementById("xpos").value || 20;
    ypos = document.getElementById("ypos").value || 20;
    logopos = document.getElementById("logo-pos").value || "TR";
    fileupload = filename || "uploads/learning.png";
    ori_width = $('img')[0].width;
    ori_height = $("img")[0].height;

    //creating controller
    videojs("my-video", { //'techOrder': ['flash'],
        plugins: {
            logoOverlay: {
                src: fileupload,
                link: "http://www.google.com/",
                margin: [ypos, xpos, 40, 20],
                userActive: false,
                position: logopos,
                width: 100,
                height: (100 / ori_width) * ori_height
            }
        }
    }); //margin: 20, //margin: {top: 20, right: 20, bottom: 40, left: 20},
});

$(function() {

    //file upload part
    $("#file").change(function() {
        var file = this.files[0];
        var imagetype = file.type;
        console.log(file.type);
        var extentions = ["image/jpeg", "image/png", "image/jpg", "image/gif", "image/bmp"];
        if (extentions.indexOf(imagetype) > -1) {
            console.log(file.type);
            Materialize.toast("File Is Valid!", 2000);
            var filereader = new FileReader();
            filereader.onload = FileLoadCheck;
            filereader.readAsDataURL(this.files[0]);
            FileUploadAjaxCall();
        } else {
            Materialize.toast("File Is Invalid!", 2000);
            $("#previewImage").attr("src", "images/images.png");
            return false;
        }
    });

    function FileLoadCheck(e) {
        console.log(e, "Object");
        $("#previewImage").attr("src", e.target.result);
    }
});

function FileUploadAjaxCall() {
    filename_tmp = new Date().getTime();
    $.ajax({
        url: "fileupload.php?_" + filename_tmp,
        type: "POST",
        data: new FormData($("#UploadMedia").get(0)),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            console.log(data, "data");
            Materialize.toast("File Upload Successfully!", 2000);
            filename = data;
        }
    });
}