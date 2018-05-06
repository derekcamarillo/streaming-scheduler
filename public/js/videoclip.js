/**
 * Created by Emerald on 4/11/2018.
 */
function playVideo() {
    // remobe previous controller
    if (window.videojs.getPlayers()["videojs-marquee-overlay-player"]) {
        delete window.videojs.getPlayers()["videojs-marquee-overlay-player"];
    }
    videoclipUrl = "http://localhost/movie1.mp4";
    //draw video tag
    video_content = '<video id="videojs-marquee-overlay-player" class="video-js vjs-default-skin" controls width="848" height="480" data-setup=\'{"playbackRates": [1, 1.5, 2] }\'>' + '<source src="' +  videoclipUrl +'" type="application/x-mpegurl">' + '</video>';

    $('#myVideo').html(video_content);
    //get values
    player = (window.player = videojs("videojs-marquee-overlay-player"));
    effect = $('#effect').val();
    textcontent = $('#message').val();
    colorpick = $('#font_color').val();
    bgcolor = "#ffffff";
    fontsize = $('#font_size').val();
    fonttype = $('#font_type').val();
    scrollspeed = $('#scrollspeed').val();
    xpos = $('#xpos').val();
    ypos = $('#ypos').val();
    duration = $('#duration').val();

    //setting controller
    player.marqueeOverlay({
        contentOfMarquee: textcontent,
        position: "bottom",
        direction: effect,
        duration: scrollspeed,
        backgroundcolor: colorpick,
        color: bgcolor
        // font: 500
    });
    //setting css
    var css = ".vjs-emre-marquee {width: 100%; overflow: hidden;border: 1px solid #ccc;z-index: 9998;position: absolute;font-size: " + fontsize + "px !important;bottom: " + ypos + 'px !important;font-family:"' + fonttype + '", Times, serif;}',
        head = document.head || document.getElementsByTagName("head")[0],
        style = document.createElement("style");
    style.type = "text/css";
    if (style.styleSheet) {
        style.styleSheet.cssText = css;
    } else {
        style.appendChild(document.createTextNode(css));
    }
    head.appendChild(style);
    player.qualityPickerPlugin();
}