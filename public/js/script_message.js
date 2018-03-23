(function(window, videojs) {
    document.getElementById("button").addEventListener('click', function() {
        // remobe previous controller
        if (videojs.getPlayers()["videojs-marquee-overlay-player"]) {
            delete videojs.getPlayers()["videojs-marquee-overlay-player"];
        }
        //draw video tag
        video_content = '<video id="videojs-marquee-overlay-player" class="video-js vjs-default-skin" controls width="848" height="480" data-setup=\'{"playbackRates": [1, 1.5, 2] }\'>' + '<source src="http://sample.vodobox.net/skate_phantom_flex_4k/skate_phantom_flex_4k.m3u8" type="application/x-mpegurl">' + "</video>";
        document.getElementById("video-tag").innerHTML = video_content;
        //get values
        var player = (window.player = videojs("videojs-marquee-overlay-player"));
        scrollMode = document.getElementById("scrollMode").value || "H:R:L";
        textcontent = document.getElementById("extext").value || "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";
        colorpick = document.getElementById("colorpick").value || "red";
        bgcolor = document.getElementById("bgcolor").value || "#ffffff";
        fontsize = document.getElementById("fontsize").value || "20";
        fonttype = document.getElementById("fonttype").value;

        // ----------------- todo list------------------------------//
        scrollspeed = document.getElementById("scrollspeed").value;
        ypos = document.getElementById("ypos").value || "0";
        xpos = document.getElementById("xpos").value || "0";
        durationSec = document.getElementById("durationSec").value;
        // ----------------- todo list------------------------------//

        scrollMode_arr = scrollMode.split(":");
        if (scrollMode_arr[2] === "R") {
            direction = "right";
        } else if (scrollMode_arr[2] === "L") {
            direction = "left";
        } else if (scrollMode_arr[2] === "B") {
            direction = "down";
        } else if (scrollMode_arr[2] === "T") {
            direction = "up";
        }
        //setting controller
        player.marqueeOverlay({
            contentOfMarquee: textcontent,
            position: "bottom",
            direction: direction,
            duration: 2000,
            backgroundcolor: colorpick,
            color: bgcolor,
            font: 500
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
    });
}(window, window.videojs));