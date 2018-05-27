@extends('layouts.default')
@section('content')
    <div class="row">
        <h1 class="titleh1">Logo Overlay</h1>

        <form id="form_logo" action="{{ url('/logo/update/'.$logo->id) }}" method="post">
            {{ csrf_field() }}
            <div class="col-sm-12 select-box create-playlist">
                <div class="row edit-playlist-section">
                    <div class="col-xs-7 col-sm-5 col-md-5">
                        <select class="form-control" id="project_id" name="project_id">
                            <option value="" disabled="disabled" selected="selected">Select Project</option>
                            @foreach($projects as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div><!--col-5-->

                    <div class="col-xs-5 col-sm-3 col-md-3 upload-logo-btn">
                        <a class="activate-playlist-button" onclick="uploadLogo();">
                            <span>Upload Logo</span>
                        </a>
                    </div><!--col-3-->

                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <select class="form-control" id="position" name="position">
                            @foreach(Config::get('constants.logo_type') as $key => $item)
                                @if ($logo->position == $key)
                                    <option value="{{ $key }}" selected>{{ $item }}</option>
                                @else
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div><!--col-5-->
                </div><!--row | edit-playlist-section-->
            </div><!--col-12-->

            <div class="col-sm-12 select-box">
                <div class="row edit-playlist-options">
                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <span>Ofset X-Position</span>
                        <input type="text" id="xpos" name="xpos" placeholder="10" value="{{ $logo->xpos }}" class="text-center" >
                    </div><!--col-3-->

                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <span>Ofset Y-Position</span>
                        <input type="text" id="ypos" name="ypos" placeholder="10" value="{{ $logo->ypos }}" class="text-center" >
                    </div><!--col-3-->
                </div><!--row | edit-playlist-options-->
            </div><!--col-12-->

            <input type="hidden" id="url" name="url" value="@if(Session::has('logo_path')){{ Session::get('logo_path') }}@else{{ $logo->url }}@endif">
        </form>
    </div><!--row-->

    <form id="form_image" action="{{ url('/logo/upload') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="file" id="logo" name="logo" style="display: none;" accept="image/jpeg,image/jpg,image/png">
    </form>

    <div id="videoContainer" class="col-sm-12 col-md-12 myVideo-box"></div>

    <div class="col-sm-12 bottom-btns logo-overlay-video-btns">
        <a onclick="playVideo()" type="button" class="del-video-btn"><i class="fa fa-play"></i></a>
        <a onclick="stopVideo()" type="button" class="save-btn"><i class="fa fa-square"></i></a>
        <a onclick="saveLogo()" class="add-video-btn"><i class="fa fa-save"></i></a>
    </div><!--col-12-->

    <img id="hiddenLogo" src="{{ $logo->url }}" hidden>

    <!--div class="col-sm-12 col-md-12 bottom-btns logo-overlay-bottom">
        <div class="row">
            <div class="col-xs-4 col-sm-3 col-md-3 span-title">
                <span>Select Message</span>
            </div>

            <div class="col-xs-8 col-sm-3 col-md-3 select-box">
                <select class="form-control" id="#3">
                    @foreach($messages as $item)
            <option value="{{ $item->id }}">{{ $item->title }}</option>
                    @endforeach
            </select>
        </div>

        <div class="col-xs-6 col-sm-3 col-md-3 btn-full">
            <a class="add-video-btn ic-start-preview" onclick=""><span>Start Preview</span></a>
        </div>

        <div class="col-xs-6 col-sm-3 col-md-3 btn-full">
            <a href="#" class="del-video-btn ic-stop-preview"><span>Stop Preview</span></a>
        </div>
    </div>
</div-->
@stop

@section('script')
    <link href="{{ asset('css/videojs/video-js.css') }}" rel="stylesheet">
    <link href="{{ asset('css/videojs/videojs.watermark.css') }}" rel="stylesheet">
    <link href="{{ asset('css/videojs/videojs-logo-overlay.css') }}" rel="stylesheet">
    <link href="{{ asset('css/videojs/colorpick.css') }}" rel="stylesheet">

    <script src="{{ asset('js/videojs/jquery.js') }}"></script>
    <script src="{{ asset('js/videojs/jquery.marquee.js') }}"></script>
    <script src="{{ asset('js/videojs/video.js') }}"></script>
    <script src="{{ asset('js/videojs/videojs-logo-overlay.js') }}"></script>
    <script src="{{ asset('js/videojs/videojs-marquee-overlay.js') }}"></script>
    <script src="{{ asset('js/videojs/videojs-contrib-hls.js') }}"></script>
    <script src="{{ asset('js/videojs/videojs5-hlsjs-source-handler.js') }}"></script>
    <script src="{{ asset('js/videojs/videojs.watermark.js') }}"></script>
    <script src="{{ asset('js/logooverlay.js') }}"></script>

    <script>
        @if ($errors->has('url'))
            swal("Logo", "{{ $errors->first('url') }}", "error");
        @elseif($errors->has('position'))
            swal("Logo", "{{ $errors->first('position') }}", "error");
        @elseif($errors->has('xpos'))
            swal("Logo", "{{ $errors->first('xpos') }}", "error");
        @elseif($errors->has('ypos'))
            swal("Logo", "{{ $errors->first('ypos') }}", "error");
        @endif

        @if ($errors->has('logo'))
            swal("Logo", "{{ $errors->first('logo') }}", "error");
        @elseif(Session::has('logo_path'))
            $('#hiddenLogo').attr('src', '{{ Session::get('logo_path') }}');
        swal("Logo", "Logo successfully uploaded", "success");
        @elseif(Session::has('logo_create'))
            swal("Logo", "Logo successfully updated", "success");
        @endif

        function saveLogo() {
            $('#form_logo').submit();
        }

        function playVideo() {
            if (typeof $('#hiddenLogo').attr('src') == 'undefined') {
                swal("Logo", "Please upload logo first", "error");
                return;
            }

            if (videojs.getPlayers()['my-video']) {
                delete videojs.getPlayers()["my-video"];
            }

            videoContent =
                '<video id="my-video" class="video-js vjs-default-skin vjs-4-3" controls preload="auto" width="auto">' +
                '</video>';

            $('#videoContainer').html(videoContent);

            xpos = $('#xpos').val() || 10;
            ypos = $('#ypos').val() || 10;

            ori_width = $('#hiddenLogo').width();
            ori_height = $('#hiddenLogo').height();

            videojs("my-video", {
                plugins: {
                    logoOverlay: {
                        src: $('#hiddenLogo').attr('src'),
                        margin: [ypos, xpos],
                        userActive: false,
                        position: $('#position').val(),
                        width: 100,
                        height: (100 / ori_width) * ori_height
                    }
                }
            });
        }

        function stopVideo() {

        }

        function uploadLogo() {
            $('#logo').click();
        }

        $(function() {
            $("#logo").change(function() {
                waitingDialog.show();

                $('#form_image').submit();
            });
        });
    </script>
@stop