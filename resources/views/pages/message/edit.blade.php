@extends('layouts.default')
@section('content')
    <div class="row">
        <h1 class="titleh1">Edit Message</h1>

        <form id="form_message">
            {{ csrf_field() }}
            <div class="col-sm-12 select-box create-playlist">
                <div class="row edit-playlist-section edit-playlist-options optionsRight">
                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <select class="form-control" id="effect" name="effect">
                            <option value="" disabled="disabled" selected="selected">Select Effect</option>
                            @foreach(Config::get('constants.message_type') as $key => $item)
                                @if(isset($message) and $message->effect == $key)
                                    <option value="{{ $key }}" selected>{{ $item }}</option>
                                @else
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-3 scrollspeed">
                        <!--<span>Scroll Speed</span>-->
                        <input id="speed" name="speed" data-slider-id='ex1Slider' type="text" data-slider-min="1" data-slider-max="20" data-slider-step="1" data-slider-value="@if(isset($message)){{ $message->speed }}@else 1 @endif" />
                    </div>

                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <span>Player X-Position</span>
                        <input type="text" id="xpos" name="xpos" placeholder="10" class="text-center" value="@if(isset($message)){{ $message->xpos }}@endif">
                    </div>

                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <span>Player Y-Position</span>
                        <input type="text" id="ypos" name="ypos" placeholder="10" class="text-center" value="@if(isset($message)){{ $message->ypos }}@endif">
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
                                @if(isset($message) and $message->fonttype == $key)
                                    <option value="{{ $key }}" selected>{{ $item }}</option>
                                @else
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <span>Font Size</span>
                        <input type="text" id="fontsize" name="fontsize" placeholder="10" class="text-center" value="@if(isset($message)){{ $message->fontsize }}@endif">
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <span>Font Color</span>
                        <input id="fontcolor" name="fontcolor" class="text-center colorFeild jscolor" value="@if(isset($message)){{ $message->fontcolor }}@endif">
                    </div>
                </div>
            </div>
            <div class="col-sm-12 select-box">
                <input type="text" id="text" name="text" placeholder="Message Content" class="input" value="@if(isset($message)){{ $message->text }}@endif">
            </div>
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
        var messageId = "{{ $message->id  }}";

        new WOW().init();
        $('#speed').slider({
            formatter: function (value) {
                return 'Scroll Speed' + value;
            }
        });

        function pauseVideo() {

        }

        function saveMessage() {
            $('#form_message').submit();
        }

        $(function() {
            $('#form_message').submit(function (event){
                event.preventDefault();

                $.post('/message/update/' + messageId, $(this).serializeArray(), function (response) {
                    if (response.result == '<?= Config::get('constants.status.success') ?>') {
                        swal("Message", "New message successfully updated", "success");
                    } else if (response.result == '<?= Config::get('constants.status.error') ?>') {
                        swal("Message", "Updating message failed", "error");
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
        });
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