@extends('layouts.default')
@section('content')
    <div class="row">
        <h1 class="titleh1">Create Message</h1>

        <form id="form_message">
            {{ csrf_field() }}
            <div class="col-sm-12 select-box create-playlist">
                <div class="row edit-playlist-section edit-playlist-options optionsRight">
                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <select class="form-control" id="effect" name="effect">
                            <option value="" disabled="disabled" selected="selected">Select Effect</option>
                            @foreach(Config::get('constants.message_type') as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-3 scrollspeed">
                        <!--<span>Scroll Speed</span>-->
                        <input id="speed" name="speed" data-slider-id='ex1Slider' type="text" data-slider-min="1" data-slider-max="20" data-slider-step="1" data-slider-value="@if(isset($videoclip->message)){{ $videoclip->message->speed }}@else 1 @endif" />
                    </div>

                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <span>Player X-Position</span>
                        <input type="text" id="xpos" name="xpos" placeholder="10" class="text-center" value="@if(isset($videoclip->message)){{ $videoclip->message->xpos }}@endif">
                    </div>

                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <span>Player Y-Position</span>
                        <input type="text" id="ypos" name="ypos" placeholder="10" class="text-center" value="@if(isset($videoclip->message)){{ $videoclip->message->ypos }}@endif">
                    </div>
                </div>
            </div>
            <div class="col-sm-12 select-box optionsRight">
                <div class="row edit-playlist-options">
                    <!--col-3-->
                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <span>Font Type</span>
                        <select class="form-control fontInput" id="fonttype" name="fonttype">
                            @foreach(Config::get('constants.font_type') as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <span>Font Size</span>
                        <input type="text" id="fontsize" name="fontsize" placeholder="10" class="text-center" value="@if(isset($videoclip->message)){{ $videoclip->message->fontsize }}@endif">
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <span>Font Color</span>
                        <input id="fontcolor" name="fontcolor" class="text-center colorFeild jscolor" value="@if(isset($videoclip->message)){{ $videoclip->message->fontcolor }}@endif">
                    </div>
                </div>
            </div>
            <div class="col-sm-12 select-box">
                <input type="text" id="text" name="text" placeholder="Message Content" class="input" value="@if(isset($videoclip->message)){{ $videoclip->message->text }}@endif">
            </div>
        </form>

        <div class="col-sm-12 bottom-btns logo-overlay-video-btns">
            <a onclick="playVideo()" type="button" class="del-video-btn"><i class="fa fa-play"></i></a>
            <a onclick="pauseVid()" type="button" class="save-btn"><i class="fa fa-square"></i></a>
            <a onclick="saveMessage()" class="add-video-btn"><i class="fa fa-save"></i></a>
        </div><!--col-12-->

        <div id="videoContainer" class="col-sm-12 col-md-12 myVideo-box">
            <video id="myVideo">
                <source src="http://localhost/movie1.mp4" type="video/mp4">
            </video>
        </div>

        <div class="col-sm-12 select-box optionsRight">
            <div class="row edit-playlist-options">
                <!--col-3-->
            </div>
        </div><!--col-12-->
    </div><!--row-->
@stop

@section('script')
    <link href="{{ asset('css/videojs/video-js.css') }}" rel="stylesheet">
    <link href="{{ asset('css/videojs/videojs.watermark.css') }}" rel="stylesheet">
    <link href="{{ asset('css/videojs/videojs-logo-overlay.css') }}" rel="stylesheet">
    <link href="{{ asset('css/videojs/colorpick.css') }}" rel="stylesheet">

    <script src="{{ asset('js/videojs/video.js') }}"></script>
    <script src="{{ asset('js/videojs/videojs-logo-overlay.js') }}"></script>
    <script src="{{ asset('js/videoclip.js') }}"></script>
    <script src="{{ asset('js/videojs/videojs-marquee-overlay.js') }}"></script>
    <script src="{{ asset('js/videojs/videojs-contrib-hls.js') }}"></script>
    <script src="{{ asset('js/videojs/videojs5-hlsjs-source-handler.js') }}"></script>
    <script src="{{ asset('js/videojs/jquery.marquee.js') }}"></script>
    <script src="{{ asset('js/videojs/videojs.watermark.js') }}"></script>

    <style id="style_marquee" type="text/css">
        .vjs-emre-marquee {
            width: 100%;
            overflow: hidden;
            z-index: 9998;
            position: absolute;
            font-size: 24px !important;
        }
    </style>


    <script>
        new WOW().init();
        $('#speed').slider({
            formatter: function (value) {
                return 'Scroll Speed' + value;
            }
        });

        function playVideo() {
            if (videojs.getPlayers()["my-video"]) {
                delete videojs.getPlayers()["my-video"];
            }

            videoContent =
                '<video id="my-video" class="video-js vjs-big-play-centered" controls preload="auto" width="848" height="480" data-setup=\'{"playbackRates": [1, 1.5, 2] }\'>' +
                '<source src="http://localhost/movie1.mp4" type="video/mp4">' +
                '</video>';

            $('#videoContainer').html(videoContent);

            player = videojs("my-video");

            player.marqueeOverlay({
                contentOfMarquee: $('#text').val(),
                position: "bottom",
                direction: $('#effect').val(),
                backgroundcolor: 'transparent',
                duration: (5000 - $('#speed').val() * 200),
                color: "#" + $('#fontcolor').val()
            });

            css =
                ".vjs-emre-marquee {" +
                "width: 100%; overflow: hidden; z-index: 9998;position: absolute;" +
                "font-size:" + $('#fontsize').val() + "px !important;" +
                "left: " + $('#xpos').val() + "px !important;" +
                "bottom: " + $('#ypos').val() + "px !important;" +
                "font-family: " + $('#fonttype').val() + "!important;" +
                "}";

            $('#style_marquee').html(css);

            player.qualityPickerPlugin();
        }

        function saveMessage() {
            $('#form_message').submit();
        }

        $(function() {
            $('#form_message').submit(function (event){
                event.preventDefault();

                waitingDialog.show();

                $.post('/message/store', $(this).serializeArray(), function (response) {
                    waitingDialog.hide();

                    if (response.result == '<?= Config::get('constants.status.success') ?>') {
                        swal("Message", "New message successfully saved", "success");
                    } else if (response.result == '<?= Config::get('constants.status.error') ?>') {
                        swal("Video Clip", "Saving message failed", "error");
                    } else if (response.result == '<?= Config::get('constants.status.validation') ?>') {
                        validStr = "";
                        if (response.data.effect) {
                            response.data.effect.forEach(function(item, index){
                                validStr += "\n" + item;
                            });
                        }
                        if (response.data.fontsize) {
                            response.data.fontsize.forEach(function(item, index){
                                validStr += "\n" + item;
                            });
                        }
                        if (response.data.text) {
                            response.data.text.forEach(function(item, index){
                                validStr += "\n" + item;
                            });
                        }
                        if (response.data.xpos) {
                            response.data.xpos.forEach(function(item, index){
                                validStr += "\n" + item;
                            });
                        }
                        if (response.data.ypos) {
                            response.data.ypos.forEach(function(item, index){
                                validStr += "\n" + item;
                            });
                        }
                        swal("Video Clip", validStr, "error");
                    }
                });
            });


            $('#font_color').on('change', function(e) {
                $(this).css('background', $(this).val());
            });
        });
    </script>
@stop