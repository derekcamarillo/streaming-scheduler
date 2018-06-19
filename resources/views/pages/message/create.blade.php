@extends('layouts.default')
@section('content')
    <div class="row">
        <h1 class="titleh1">{{ __('Create Message') }}</h1>

        <form id="form_message">
            {{ csrf_field() }}
            <div class="col-sm-12 select-box create-playlist">
                <div class="row edit-playlist-section edit-playlist-options optionsRight">
                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <select class="form-control" id="effect" name="effect">
                            <option value="" disabled="disabled" selected="selected">{{ __('Select Effect') }}</option>
                            @foreach(Config::get('constants.message_type') as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-3 scrollspeed">
                        <!--<span>Scroll Speed</span>-->
                        <input id="speed" name="speed" data-slider-id='ex1Slider' type="text" data-slider-min="1" data-slider-max="20" data-slider-step="1" data-slider-value="1" />
                    </div>

                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <span>{{ __('Player X-Position') }}</span>
                        <input type="number" id="xpos" name="xpos" min="0" max="300" placeholder="10" class="text-center" value="0">
                    </div>

                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <span>{{ __('Player Y-Position') }}</span>
                        <input type="number" id="ypos" name="ypos" min="0" max="300" placeholder="10" class="text-center" value="0">
                    </div>
                </div>
            </div>
            <div class="col-sm-12 select-box optionsRight">
                <div class="row edit-playlist-options">
                    <!--col-3-->
                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <!--input type="text" id="fonttype" name="fonttype" class="text-center"-->
                        <span>{{ __('Font Type') }}</span>
                        <select class="form-control fontInput" id="fonttype" name="fonttype">
                            @foreach(Config::get('constants.font_type') as $item)
                                <option value="{{ $item }}" style="font-family: {{ $item }} !important;">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <span>{{ __('Font Size') }}</span>
                        <input type="number" id="fontsize" min="8" max="72" name="fontsize" placeholder="12" class="text-center" value="12">
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <span>{{ __('Font Color') }}</span>
                        <input id="fontcolor" name="fontcolor" class="text-center colorFeild jscolor">
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <span>{{ __('Back Color') }}</span>
                        <input id="backcolor" name="backcolor" class="text-center colorFeild jscolor">
                    </div>
                </div>
            </div>
            <div class="col-sm-12 select-box">
                <input type="text" id="text" name="text" placeholder="{{ __('Message Content') }}" class="input">
            </div>
        </form>

        <div class="col-sm-12 bottom-btns logo-overlay-video-btns">
            <a onclick="playVideo()" type="button" class="del-video-btn" style="width: 80px !important;"><i class="fa fa-play"></i></a>
            <a onclick="stopVideo()" type="button" class="save-btn"><i class="fa fa-square"></i></a>
            <a onclick="saveMessage()" class="add-video-btn" style="width: 80px !important;"><i class="fa fa-save"></i></a>
        </div><!--col-12-->

        <div id="videoContainer" class="col-sm-12 col-md-12 myVideo-box"></div>

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
    <script src="{{ asset('js/videojs/Youtube.min.js') }}"></script>
    <script src="{{ asset('js/videojs/videojs-vimeo.js') }}"></script>

    <style id="style_marquee" type="text/css">
        .vjs-emre-marquee {
            width: 100%;
            overflow: hidden;
            z-index: 9998;
            position: absolute;
            font-size: 24px !important;
            padding-top: 6px;
            padding-bottom: 6px;
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

            videoclipHtml = '<video id="my-video" class="video-js vjs-default-skin vjs-4-3" autoplay data-setup=\'%data%\'></video>';

            var data = {};
            data.techOrder = [];
            data.sources = [];
            var source = {};
            source.type = "video/youtube";
            source.src = '{{ $videoclip }}';

            var youtube = {};
            youtube.autoplay = 1;
            youtube.controls = 0;
            youtube.mute = 1;

            data.techOrder.push("youtube");
            data.sources.push(source);

            $('#videoContainer').empty();

            videoclipHtml = videoclipHtml.replace('%data%', JSON.stringify(data));
            $('#videoContainer').append(videoclipHtml);

            player = videojs("my-video");

            player.ready(function() {
                this.play();
            });

            player.marqueeOverlay({
                contentOfMarquee: $('#text').val(),
                position: "bottom",
                direction: $('#effect').val(),
                //backgroundcolor: 'transparent',
                backgroundcolor: "#" + $('#backcolor').val(),
                duration: (30000 - $('#speed').val() * 1000),
                color: "#" + $('#fontcolor').val()
            });

            css =
                ".vjs-emre-marquee {" +
                "width: 100%; overflow: hidden; z-index: 9998;position: absolute;" +
                "font-size:" + $('#fontsize').val() + "px !important;" +
                "left: " + $('#xpos').val() + "px !important;" +
                "bottom: " + $('#ypos').val() + "px !important;" +
                "font-family: " + $('#fonttype').val() + "!important;" +
                "padding-top: 6px;" +
                "padding-bottom: 6px;" +
                "}";

            $('#style_marquee').html(css);

            player.qualityPickerPlugin();
        }

        function stopVideo() {
            if (videojs.getPlayers()["my-video"]) {
                delete videojs.getPlayers()["my-video"];
            }

            $('#videoContainer').empty();
        }

        function saveMessage() {
            $('#form_message').submit();
        }

        $(function() {
            $('#form_message').submit(function (event) {
                event.preventDefault();

                waitingDialog.show();

                $.post('/message/store', $(this).serializeArray(), function (response) {
                    waitingDialog.hide();

                    if (response.result == '<?= Config::get('constants.status.success') ?>') {
                        swal("Message", "{{ __('New message successfully saved') }}", "success");
                    } else if (response.result == '<?= Config::get('constants.status.error') ?>') {
                        swal("Video Clip", "{{ __('Saving message failed') }}", "error");
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

            //$('#fonttype').fontselect();
        });
    </script>
@stop