@extends('layouts.default')
@section('content')
    <div class="row">
        <h1 class="titleh1">{{ __('Create Video Clip') }}</h1>

        <div class="col-sm-12 select-box create-playlist">
            <div class="row edit-playlist-section">
                <form id="form_video">
                    {{ csrf_field() }}
                    <div class="col-xs-7 col-sm-4 col-md-4">
                        <input type="text" id="title" name="title" placeholder="{{ __('Video Clip Title') }}" class="input">
                    </div><!--col-4-->

                    <div class="col-xs-12 col-sm-6 col-md-6 project-input">
                        <input type="text" id="url" name="url" placeholder="{{ __('Video Clip URL') }} (Youtube / Vimeo)">
                    </div><!--col-6-->

                    <div class="col-xs-5 col-sm-2 col-md-2 bottom-btns">
                        <a class="save-btn ic-save" href="javascript:void(0)">
                            <span>{{ __('Save') }}</span>
                        </a>
                    </div><!--col-2-->
                </form>
            </div>
        </div>

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
                        <input type="number" id="xpos" name="xpos" placeholder="0" class="text-center" value="0">
                    </div>

                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <span>{{ __('Player Y-Position') }}</span>
                        <input type="number" id="ypos" name="ypos" placeholder="0" class="text-center" value="0">
                    </div>
                </div>
            </div>
            <div class="col-sm-12 select-box optionsRight">
                <div class="row edit-playlist-options">
                    <!--col-3-->
                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <span>{{ __('Font Type') }}</span>
                        <select class="form-control fontInput" id="fonttype" name="fonttype">
                            @foreach(Config::get('constants.font_type') as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <span>{{ __('Font Size') }}</span>
                        <input type="number" id="fontsize" name="fontsize" placeholder="10" class="text-center" value="10">
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <span>{{ __('Font Color') }}</span>
                        <input id="fontcolor" name="fontcolor" class="text-center colorFeild jscolor" >
                    </div>
                </div>
            </div>
            <div class="col-sm-12 select-box">
                <input type="text" id="text" name="text" placeholder="{{ __('Message Content') }}" class="input">
            </div>
            <input type="hidden" id="videoclip_id" name="videoclip_id" value="0">
        </form>

        <div class="col-sm-12 bottom-btns logo-overlay-video-btns">
            <a onclick="playVideo()" type="button" class="del-video-btn"><i class="fa fa-play"></i></a>
            <a onclick="pauseVideo()" type="button" class="save-btn"><i class="fa fa-square"></i></a>
            <a onclick="saveMessage()" class="add-video-btn"><i class="fa fa-save"></i></a>
        </div><!--col-12-->

        <div id="videoContainer" class="col-sm-12 col-md-12 myVideo-box">
            <video id="my-video"></video>
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
    <script src="{{ asset('js/videojs/Youtube.min.js') }}"></script>
    <script src="{{ asset('js/videojs/videojs-vimeo.js') }}"></script>

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
            var url = $('#url').val() + "?autoplay=1";

            if (url == "") {
                swal("{{ __('Video Clip') }}", "{{ __('New video clip successfully saved') }}", "error");
                return;
            }
            if (url.indexOf('youtube') < 0 && url.indexOf('vimeo') < 0) {
                swal("{{ __('Video Clip') }}", "{{ __('Please input valid video url') }}", "error");
                return;
            }

            $('#videoContainer').empty();

            if (videojs.getPlayers()["my-video"]) {
                delete videojs.getPlayers()["my-video"];
            }

            videoclipHtml = '<video id="my-video" class="video-js vjs-default-skin vjs-4-3" autoplay data-setup=\'%data%\'></video>';

            var data = {};
            data.techOrder = [];
            data.sources = [];

            if (url.indexOf("youtube") !== -1) {
                var source = {};
                source.type = "video/youtube";
                source.src = url;

                var youtube = {};
                youtube.autoplay = 1;
                youtube.controls = 0;

                data.techOrder.push("youtube");
                data.sources.push(source);
                //data.youtube = youtube;
            } else if (url.indexOf("vimeo") !== -1) {
                var source = {};
                source.type = "video/vimeo";
                source.src = url;

                var option = {};
                //option.color = "#fbc51b";
                option.controls = false;

                data.techOrder.push("vimeo");
                data.sources.push(source);
                data.vimeo = option;
            }

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

        function pauseVideo() {

        }

        function saveMessage() {
            $('#form_message').submit();
        }

        $(function() {
            $('#form_video').submit(function (event){
                event.preventDefault();

                waitingDialog.show();

                $.post('/videoclip/store', $(this).serializeArray(), function (response) {
                    waitingDialog.hide();

                    if (response.result == '<?= Config::get('constants.status.success') ?>') {
                        $('#videoclip_id').val(response.id);
                        swal("Video Clip", "{{ __('New video clip successfully saved') }}", "success");
                    } else {
                        swal("Video Clip", "{{ __('Saving video clip failed') }}", "error");
                    }
                });
            });

            $('#form_message').submit(function (event){
                event.preventDefault();

                if ($('#videoclip_id').val() == 0) {
                    swal("Message", "{{ __('Please create video clip first') }}", "error");
                    return;
                }

                waitingDialog.show();

                $.post('/message/store', $(this).serializeArray(), function (response) {
                    waitingDialog.hide();

                    if (response.result == '<?= Config::get('constants.status.success') ?>') {
                        swal("Message", "{{ __('New message successfully saved') }}", "success");
                    } else if (response.result == '<?= Config::get('constants.status.error') ?>') {
                        swal("Video Clip", "{{ __('Saving message failed') }}", "error");
                    } else if (response.result == '<?= Config::get('constants.status.validation') ?>') {
                        swal("Video Clip", "{{ __('Validation error') }}", "error");
                    }
                });
            });

            $('.save-btn').click(function () {
                $('#form_video').submit();
            });

            $('#font_color').on('change', function(e) {
                $(this).css('background', $(this).val());
            });
        });
    </script>
@stop