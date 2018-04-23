@extends('layouts.default')
@section('content')
    <div class="row">
        <h1 class="titleh1">Create Video Clip</h1>

        <div class="col-sm-12 select-box create-playlist">
            <div class="row edit-playlist-section">
                <form id="form_video">
                    {{ csrf_field() }}
                    <div class="col-xs-7 col-sm-4 col-md-4">
                        <input type="text" id="title" name="title" placeholder="Video Clip Title" class="input">
                    </div><!--col-4-->

                    <div class="col-xs-12 col-sm-6 col-md-6 project-input">
                        <input type="text" id="url" name="url" placeholder="Video Clip URL (Youtube / Vimeo)">
                    </div><!--col-6-->

                    <div class="col-xs-5 col-sm-2 col-md-2 bottom-btns">
                        <a class="save-btn ic-save" href="javascript:void(0)">
                            <span>Add Video</span>
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
                        <input type="color" id="fontcolor" name="fontcolor" class="text-center colorFeild" value="@if(isset($videoclip->message)){{ $videoclip->message->fontcolor }}@endif">
                    </div>
                </div>
            </div>
            <div class="col-sm-12 select-box">
                <input type="text" id="text" name="text" placeholder="Message Content" class="input" value="@if(isset($videoclip->message)){{ $videoclip->message->text }}@endif">
            </div>
            <input type="hidden" id="videoclip_id" name="videoclip_id" value="0">
        </form>

        <div class="col-sm-12 bottom-btns logo-overlay-video-btns">
            <a onclick="playVid()" type="button" class="del-video-btn"><i class="fa fa-play"></i></a>
            <a onclick="pauseVid()" type="button" class="save-btn"><i class="fa fa-square"></i></a>
            <a onclick="saveMessage()" class="add-video-btn"><i class="fa fa-save"></i></a>
        </div><!--col-12-->

        <div class="col-sm-12 col-md-12 myVideo-box">
            <video id="myVideo">
                <!--
                <source src="mov_bbb.mp4" type="video/mp4">
                <source src="mov_bbb.ogg" type="video/ogg">
                -->
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
    <script>
        new WOW().init();
        $('#speed').slider({
            formatter: function (value) {
                return 'Scroll Speed' + value;
            }
        });

        function saveMessage() {
            $('#form_message').submit();
        }

        $(function() {
            $('#form_video').submit(function (event){
                event.preventDefault();

                $.post('/videoclip/store', $(this).serializeArray(), function (response) {
                    if (response.result == 'success') {
                        $('#videoclip_id').val(response.id);
                        swal("Video Clip", "New video clip successfully saved", "success");
                    } else {
                        swal("Video Clip", "Saving video clip failed", "error");
                    }
                });
            });

            $('#form_message').submit(function (event){
                event.preventDefault();

                if ($('#videoclip_id').val() == 0) {
                    swal("Message", "Please create video clip first", "error");
                    return;
                }

                $.post('/message/store', $(this).serializeArray(), function (response) {
                    if (response.result == 'success') {
                        swal("Video Clip", "New video clip successfully saved", "success");
                    } else {
                        swal("Video Clip", "Saving video clip failed", "error");
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