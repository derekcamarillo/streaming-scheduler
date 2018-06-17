@extends('layouts.default')
@section('content')
    <div class="row">
        <h1 class="titleh1">{{ __('Logo Overlay') }}</h1>

        <form id="form_logo" action="{{ url('/logo/store') }}" method="post">
            {{ csrf_field() }}
            <div class="col-sm-12 select-box create-playlist">
                <div class="row edit-playlist-section">
                    <div class="col-xs-7 col-sm-5 col-md-5">
                        <select class="form-control" id="project_id" name="project_id">
                            @if(sizeof($projects) > 0)
                                @foreach($projects as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            @else
                                <option value="" disabled="disabled" selected="selected">Select Project</option>
                            @endif
                        </select>
                    </div><!--col-5-->

                    <div class="col-xs-5 col-sm-3 col-md-3 upload-logo-btn">
                        <a class="activate-playlist-button" onclick="uploadLogo();">
                            <span>{{ __('Upload Logo') }}</span>
                        </a>
                    </div><!--col-3-->

                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <select class="form-control" id="position" name="position">
                            <option value="" disabled="disabled" selected="selected">{{ __('Select position') }}</option>
                            @foreach(Config::get('constants.logo_type') as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div><!--col-5-->
                </div><!--row | edit-playlist-section-->
            </div><!--col-12-->

            <div class="col-sm-12 select-box">
                <div class="row edit-playlist-options">
                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <span>{{ __('Ofset X-Position') }}</span>
                        <input type="number" id="xpos" name="xpos" placeholder="0" min="0" max="300" value="0" class="text-center" >
                    </div><!--col-3-->

                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <span>{{ __('Ofset Y-Position') }}</span>
                        <input type="number" id="ypos" name="ypos" placeholder="0" min="0" max="300" value="0" class="text-center" >
                    </div><!--col-3-->
                </div><!--row | edit-playlist-options-->
            </div><!--col-12-->

            <input type="hidden" id="url" name="url" value="@if(Session::has('logo_path')){{ Session::get('logo_path') }}@endif">
        </form>
    </div><!--row-->

    <form id="form_image" action="{{ url('/logo/upload') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="file" id="logo" name="logo" style="display: none;" accept="image/jpeg,image/jpg,image/png">
    </form>

    <div class="col-sm-12 bottom-btns logo-overlay-video-btns">
        <a onclick="playVideo()" type="button" class="del-video-btn" style="width: 80px !important;"><i class="fa fa-play"></i></a>
        <a onclick="stopVideo()" type="button" class="save-btn"><i class="fa fa-square"></i></a>
        <a onclick="saveLogo()" class="add-video-btn" style="width: 80px !important;"><i class="fa fa-save"></i></a>
    </div><!--col-12-->

    <div id="videoContainer" class="col-md-12 col-sm-12 myVideo-box"></div>

    <img id="hiddenLogo" hidden>

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
    <script src="{{ asset('js/videojs/Youtube.min.js') }}"></script>
    <script src="{{ asset('js/videojs/videojs-vimeo.js') }}"></script>
    <script src="{{ asset('js/logooverlay.js') }}"></script>
    <script src="{{ asset('js/classes.js') }}"></script>

    <script>
        var projects = [];
        var playlist;

        @foreach($projects as $project)
            var playlists = [];

            @if(isset($project->playlists))
                @foreach($project->playlists as $playlist)
                    var videoclips = [];
                    @if(isset($playlist->videoclips))
                        @foreach($playlist->videoclips as $videoclip)
                            var message = null;
                            @if(isset($videoclip->message))
                                message = new Message('{{ $videoclip->message->id }}', '{{ $videoclip->message->text }}', '{{ $videoclip->message->effect }}',
                                    '{{ $videoclip->message->speed }}', '{{ $videoclip->message->duration }}',
                                    '{{ $videoclip->message->xpos }}', '{{ $videoclip->message->ypos }}', '{{ $videoclip->message->fonttype }}',
                                    '{{ $videoclip->message->fontsize }}', '{{ $videoclip->message->fontcolor }}', '{{ $videoclip->message->backcolor }}');
                            @endif
                            videoclips.push(new Videoclip('{{ $videoclip->id }}', '{{ $videoclip->title }}', '{{ $videoclip->url }}', message));
                        @endforeach
                    @endif

                    var message = null;
                    @if(isset($playlist->message))
                        message = new Message('{{ $playlist->message->id }}', '{{ $playlist->message->text }}', '{{ $playlist->message->effect }}',
                            '{{ $playlist->message->speed }}', '{{ $playlist->message->duration }}',
                            '{{ $playlist->message->xpos }}', '{{ $playlist->message->ypos }}', '{{ $playlist->message->fonttype }}',
                            '{{ $playlist->message->fontsize }}', '{{ $playlist->message->fontcolor }}', '{{ $playlist->message->backcolor }}');
                    @endif

                    var schedule = null;
                    @if(isset($playlist->schedule))
                        schedule = new Schedule('{{ $playlist->schedule->id }}', '{{ $playlist->schedule->start_time }}', '{{ $playlist->schedule->end_time }}',
                            '{{ $playlist->schedule->endless }}', '{{ $playlist->schedule->days }}', '{{ $playlist->schedule->months }}');
                    @endif

                    @if(isset($project->activatedPlaylist) && count($project->activatedPlaylist) > 0 && ($project->activatedPlaylist()->first()->id == $playlist->id))
                        playlists.push(new Playlist('{{ $playlist->id }}', '{{ $playlist->title }}', videoclips, message, schedule, 1));
                    @else
                        playlists.push(new Playlist('{{ $playlist->id }}', '{{ $playlist->title }}', videoclips, message, schedule, 0));
                    @endif
                @endforeach
            @endif

            projects.push(new Project('{{ $project->id }}', '{{ $project->title }}', '{{ url(Auth::user()->name.'/'.$project->title.'/'.$project->url.'/index.html') }}', playlists));
        @endforeach


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
            swal("Logo", "{{ __('Logo successfully uploaded') }}", "success");
        @elseif(Session::has('logo_create'))
            swal("Logo", "{{ __('Logo successfully created') }}", "success");
        @endif

        function saveLogo() {
            if (!$('#project_id').val()) {
                swal("Logo", "{{ __('Please select project first') }}", "error");

                return;
            }
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

            for (var i = 0; i < projects.length; i++) {
                if (projects[i].id == $('#project_id').val()) {
                    if (projects[i].playlists.length > 0) {
                        playlist = projects[i].playlists[0];
                    }
                    break;
                }
            }

            if (playlist) {
                playVideoClip(playlist.videoclips[0]);
            }
        }

        function stopVideo() {
            if (videojs.getPlayers()["my-video"]) {
                delete videojs.getPlayers()["my-video"];
            }

            $('#videoContainer').empty();
        }

        function playVideoClip(item) {
            if (videojs.getPlayers()["my-video"]) {
                delete videojs.getPlayers()["my-video"];
            }

            $('#videoContainer').empty();

            videoclipHtml = '<video id="my-video" class="video-js vjs-default-skin vjs-4-3" data-setup=\'%data%\'></video>';

            var data = {};
            data.techOrder = [];
            data.sources = [];

            if (item.url.indexOf("youtube") !== -1) {
                var source = {};
                source.type = "video/youtube";
                source.src = item.url;

                var youtube = {};
                youtube.autoplay = 1;
                youtube.controls = 0;
                youtube.mute = 1;

                data.techOrder.push("youtube");
                data.sources.push(source);
                //data.youtube = youtube;
            } else if (item.url.indexOf("vimeo") !== -1) {
                var source = {};
                source.type = "video/vimeo";
                source.src = item.url;

                var option = {};
                //option.color = "#fbc51b";
                option.controls = false;

                data.techOrder.push("vimeo");
                data.sources.push(source);
                data.vimeo = option;
            }

            videoclipHtml = videoclipHtml.replace('%data%', JSON.stringify(data));
            $('#videoContainer').append(videoclipHtml);

            xpos = $('#xpos').val() || 10;
            ypos = $('#ypos').val() || 10;

            ori_width = $('#hiddenLogo').width();
            ori_height = $('#hiddenLogo').height();

            videoPlayer = videojs('my-video', {
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

            videoPlayer.ready(function() {
                var player = this;

                player.play();

                player.on('ended', function() {
                    index ++;

                    if (index == playlist.videoclips.length ) {
                        if (playlist.schedule.endless == 0)
                            return;
                        else
                            index = 0;
                    }

                    playVideoClip(playlist.videoclips[index])
                });
            });
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