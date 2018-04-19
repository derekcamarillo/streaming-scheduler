@extends('layouts.default')
@section('content')
    <div class="row">
        <h1 class="titleh1">Edit Message</h1>

        <form id="form_message">
            {{ csrf_field() }}
            <div class="col-sm-12 select-box create-playlist">
                <div class="row edit-playlist-section edit-playlist-options optionsRight">
                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <select class="form-control" id="effect">
                            @foreach(Config::get('constants.message_type') as $key => $item)
                                @if($message->effect == $key)
                                    <option value="{{ $key }}" selected>{{ $item }}</option>
                                @else
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-3 scrollspeed">
                        <!--<span>Scroll Speed</span>-->
                        <input id="ScrollSpeed" data-slider-id='ex1Slider' type="text" data-slider-min="1" data-slider-max="20" data-slider-step="1" data-slider-value="{{ $message->speed }}" />
                    </div>

                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <span>Player X-Position</span>
                        <input type="text" id="xpos" placeholder="10" class="text-center" value="{{ $message->xpos }}">
                    </div>

                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <span>Player Y-Position</span>
                        <input type="text" id="ypos" placeholder="10" class="text-center" value="{{ $message->ypos }}">
                    </div>
                </div>
            </div>
            <div class="col-sm-12 select-box optionsRight">
                <div class="row edit-playlist-options">
                    <!--col-3-->

                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <span>Font Type</span>
                        <select class="form-control fontInput" id="font_type">
                            @foreach(Config::get('constants.font_type') as $key => $item)
                                @if($message->fonttype == $key)
                                    <option value="{{ $key }}" selected>{{ $item }}</option>
                                @else
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <span>Font Size</span>
                        <input type="text" id="font_size" placeholder="10" class="text-center" value="{{ $message->fontsize }}">
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <span>Font Color</span>
                        <input type="color" id="font_color" class="text-center colorFeild" value="{{ $message->fontcolor }}">
                    </div>
                </div>
            </div>
            <div class="col-sm-12 select-box">
                <input type="text" id="message" name="message" placeholder="Message Content" class="input" value="{{ $message->text }}">
            </div><!--col-4-->
        </form>

        <div class="col-sm-12 bottom-btns logo-overlay-video-btns">
            <a onclick="playVideo()" type="button" class="del-video-btn"><i class="fa fa-play"></i></a>
            <a onclick="pauseVideo()" type="button" class="save-btn"><i class="fa fa-square"></i></a>
            <a onclick="saveMessage()" class="add-video-btn"><i class="fa fa-save"></i></a>
        </div><!--col-12-->

        <div class="col-sm-12 col-md-12 myVideo-box" id="myVideo"></div>

        <div class="col-sm-12 select-box optionsRight">
            <div class="row edit-playlist-options">
                <!--col-3-->
            </div>
        </div><!--col-12-->
    </div><!--row-->

    <script>
        new WOW().init();
        $('#ScrollSpeed').slider({
            formatter: function (value) {
                return 'Scroll Speed' + value;
            }
        });

        function pauseVideo() {

        }

        function saveMessage() {
            $('#form_message').submit(function (event){
                event.preventDefault();

                $.post('/message/update', $(this).serializeArray(), function (response) {
                    if (response.result == 'success') {
                        videoclipId = response.id;
                        swal("Video Clip", "New video clip successfully saved", "success");
                    } else {
                        swal("Video Clip", "Saving video clip failed", "error");
                    }
                });
            });
        }
    </script>

    <link href="{{ asset('css/videojs/video-js.css') }}" rel="stylesheet">
    <link href="{{ asset('css/videojs/videojs.watermark.css') }}" rel="stylesheet">
    <link href="{{ asset('css/videojs/videojs-logo-overlay.css') }}" rel="stylesheet">
    <link href="{{ asset('css/videojs/colorpick.css') }}" rel="stylesheet">

    <script src="{{ asset('js/videojs/video.js') }}"></script>
    <script src="{{ asset('js/videojs/videojs-logo-overlay.js') }}"></script>
    <script src="{{ asset('js/videoclip.js') }}"></script>
    <script src="{{ asset('js/videojs/videojs-marquee-overlay.js') }}"></script>
    <script src="{{ asset('js/videojs/videojs-contrib-hls.js') }}"></script>
    <script src="{{ asset('js/videojs/jquery.js') }}"></script>
    <script src="{{ asset('js/videojs/videojs5-hlsjs-source-handler.js') }}"></script>
    <script src="{{ asset('js/videojs/jquery.marquee.js') }}"></script>
    <script src="{{ asset('js/videojs/videojs.watermark.js') }}"></script>
@stop