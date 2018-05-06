@extends('layouts.default')
@section('content')
    <div class="row">
        <h1 class="titleh1">Video Player Scheduler</h1>
        <div class="col-sm-12 col-md-12">
            <div class="date-time">
                <span><i class="fa fa-calendar-alt"></i><span id="timer_date"></span></span>
                <span><i class="fa fa-clock"></i><span id="timer_time"></span></span>
            </div><!--date-time-->
        </div>
        <div class="col-sm-12 col-md-12 video-scale">
            <div class="videoScaleWrap  table-section">
                <div class="timeScaleWrap">
                    <div class="timerStrip">
                        <span class="timerbox">
                            <span>1:00</span>
                            <span>1:15</span>
                        </span>
                        <span class="timerbox">
                            <span>1:00</span>
                            <span>1:15</span>
                        </span>
                        <span class="timerbox">
                            <span>1:00</span>
                            <span>1:15</span>
                        </span>
                        <span class="timerbox">
                            <span>1:00</span>
                            <span>1:15</span>
                        </span>
                        <span class="timerbox">
                            <span>1:00</span>
                            <span>1:15</span>
                        </span>
                        <span class="timerbox">
                            <span>1:00</span>
                            <span>1:15</span>
                        </span>
                        <span class="timerbox">
                            <span>1:00</span>
                            <span>1:15</span>
                        </span>
                        <span class="timerbox">
                            <span>1:00</span>
                            <span>1:15</span>
                        </span>
                        <span class="timerbox">
                            <span>1:00</span>
                            <span>1:15</span>
                        </span>
                        <span class="timerbox">
                            <span>1:00</span>
                            <span>1:15</span>
                        </span>
                        <span class="timerbox">
                            <span>1:00</span>
                            <span>1:15</span>
                        </span>
                        <span class="timerbox">
                            <span>1:00</span>
                            <span>1:15</span>
                        </span>
                        <span class="timerbox">
                            <span>1:00</span>
                            <span>1:15</span>
                        </span>
                        <span class="timerbox">
                            <span>1:00</span>
                            <span>1:15</span>
                        </span>
                        <span class="timerbox">
                            <span>1:00</span>
                            <span>1:15</span>
                        </span>
                        <span class="timerbox">
                            <span>1:00</span>
                            <span>1:15</span>
                        </span>
                        <span class="timerbox">
                            <span>1:00</span>
                            <span>1:15</span>
                        </span>
                        <span class="timerbox">
                            <span>1:00</span>
                            <span>1:15</span>
                        </span>
                        <span class="timerbox">
                            <span>1:00</span>
                            <span>1:15</span>
                        </span>
                        <span class="timerbox">
                            <span>1:00</span>
                            <span>1:15</span>
                        </span>
                        <span class="timerbox">
                            <span>1:00</span>
                            <span>1:15</span>
                        </span>
                        <span class="timerbox">
                            <span>1:00</span>
                            <span>1:15</span>
                        </span>
                        <span class="timerbox">
                            <span>1:00</span>
                            <span>1:15</span>
                        </span>
                        <span class="timerbox">
                            <span>1:00</span>
                            <span>1:15</span>
                        </span>
                        <span class="timerbox">
                            <span>1:00</span>
                            <span>1:15</span>
                        </span>
                        <span class="timerbox">
                            <span>1:00</span>
                            <span>1:15</span>
                        </span>
                        <span class="timerbox">
                            <span>1:00</span>
                            <span>1:15</span>
                        </span>
                        <span class="timerbox">
                            <span>1:00</span>
                            <span>1:15</span>
                        </span>
                        <span class="timerbox">
                            <span>1:00</span>
                            <span>1:15</span>
                        </span>
                    </div><!--timerStrip-->
                    <div class="editorStrip" id="videoclips"></div><!--editorStrip-->
                </div><!--timeScaleWrap-->
            </div><!--videoScaleWrap-->
        </div><!--col-12 | video-scale-->
        <div class="col-sm-12 select-box">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 project-input" style="margin-bottom: 35px;">
                    <input type="text" id="project_url" placeholder="Project URL(https:\\suisse-view.com\videoclips\foldername\filename.)">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <select class="form-control" id="project">
                        @php
                            $project = null;
                        @endphp

                        @foreach($projects as $item)
                            @if($item->actived == 1)
                                @if(!isset($project))
                                    @php $project = $item @endphp
                                @endif

                                <option value="{{ $item->id }}" selected>{{ $item->title }}</option>
                            @else
                                @if(!isset($project))
                                    @php $project = $item @endphp
                                @endif

                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endif
                        @endforeach
                    </select>
                </div><!--col-6-->
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <select class="form-control" id="playlist">
                        @php
                            $playlist = null;
                        @endphp
                        @if(isset($project))
                            @foreach($project->playlists as $item)
                                @if(!isset($playlist))
                                    @php
                                        $playlist = $item;
                                    @endphp
                                @endif
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        @endif
                    </select>
                </div><!--col-6-->
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <a class="activate-playlist-button" style="cursor: pointer;" onclick="activatePlaylist()">
                        <span>Activate Selected Playlist</span>
                    </a>
                </div><!--col-6-->
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <a class="stop-playlist-button" style="cursor: pointer;"  onclick="deactivatePlaylist()">
                        <span>Stop Selected Playlist</span>
                    </a>
                </div><!--col-6-->
            </div><!--row-->
        </div><!--col-12-->
    </div><!--row-->
    <div class="video-section">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#menu1">Playlist Video Clips</a></li>
            <li><a data-toggle="tab" href="#menu2">Playlist History</a></li>
        </ul><!--nav nav-tabs-->
        <div class="tab-content table-section">
            <div id="menu1" class="tab-pane fade in active">
                <div class="col-xs-6 col-sm-6 col-md-3 wow fadeInUp">
                    <div class="video-box">
                            <video
                                    id="vid1"
                                    class="video-js vjs-default-skin vjs-4-3"
                                    data-setup='{ "techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "https://www.youtube.com/watch?v=xjS6SftYQaQ"}], "youtube": { "iv_load_policy": 1 } }'>
                            </video>
                    </div>
                </div><!--col-3-->
                <div class="col-xs-6 col-sm-6 col-md-3 wow fadeInUp">
                    <div class="video-box">
                            <video
                                    id="vid1"
                                    class="video-js vjs-default-skin vjs-4-3"
                                    data-setup='{ "techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "https://www.youtube.com/watch?v=jnF1Zbbjx5E"}], "youtube": { "iv_load_policy": 1 } }'>
                            </video>
                    </div>
                </div><!--col-3-->
                <div class="col-xs-6 col-sm-6 col-md-3 wow fadeInUp">
                    <div class="video-box">
                            <video
                                    id="vid2"
                                    class="video-js vjs-4-3"
                                    data-setup='{ "techOrder": ["vimeo"], "sources": [{ "type": "video/vimeo", "src": "https://vimeo.com/99275308"}], "vimeo": { "color": "#fbc51b"} }'
                            >
                            </video>
                    </div>
                </div><!--col-3-->
            </div><!--menu1-->

            <div id="menu2" class="tab-pane fade">
                <div class="col-xs-6 col-sm-6 col-md-3 wow fadeInUp">
                    <div class="video-box">
                        <a href="url_viewvideo">
                            <img src="{{ asset('images/video-1.jpg') }}">
                        </a>
                    </div>
                </div><!--col-3-->
                <div class="col-xs-6 col-sm-6 col-md-3 wow fadeInUp">
                    <div class="video-box">
                        <a href="url_viewvideo">
                            <img src="{{ asset('images/video-2.jpg') }}">
                        </a>
                    </div>
                </div><!--col-3-->
                <div class="col-xs-6 col-sm-6 col-md-3 wow fadeInUp">
                    <div class="video-box">
                        <a href="url_viewvideo">
                            <img src="{{ asset('images/video-3.jpg') }}">
                        </a>
                    </div>
                </div><!--col-3-->
                <div class="col-xs-6 col-sm-6 col-md-3 wow fadeInUp">
                    <div class="video-box">
                        <a href="url_viewvideo">
                            <img src="{{ asset('images/video-4.jpg') }}">
                        </a>
                    </div>
                </div><!--col-3-->
                <div class="col-xs-6 col-sm-6 col-md-3 wow fadeInUp">
                    <div class="video-box">
                        <a href="url_viewvideo">
                            <img src="{{ asset('images/video-5.jpg') }}">
                        </a>
                    </div>
                </div><!--col-3-->
                <div class="col-xs-6 col-sm-6 col-md-3 wow fadeInUp">
                    <div class="video-box">
                        <a href="url_viewvideo">
                            <img src="{{ asset('images/video-6.jpg') }}">
                        </a>
                    </div>
                </div><!--col-3-->
                <div class="col-xs-6 col-sm-6 col-md-3 wow fadeInUp">
                    <div class="video-box">
                        <a href="url_viewvideo">
                            <img src="{{ asset('images/video-7.jpg') }}">
                        </a>
                    </div>
                </div><!--col-3-->
                <div class="col-xs-6 col-sm-6 col-md-3 wow fadeInUp">
                    <div class="video-box">
                        <a href="url_viewvideo">
                            <img src="{{ asset('images/video-8.jpg') }}">
                        </a>
                    </div>
                </div><!--col-3-->
            </div><!--menu2-->
        </div><!--tab-content-->
    </div><!--video-section-->
@stop

@section('script')
    <script src="{{ asset('js/classes.js') }}"></script>
    <script src="{{ asset('js/home.js') }}"></script>

    <link href="{{ asset('css/videojs/video-js.css') }}" rel="stylesheet">

    <script src="{{ asset('js/videojs/video.js') }}"></script>
    <script src="{{ asset('js/videojs/Youtube.min.js') }}"></script>
    <script src="{{ asset('js/videojs/videojs-vimeo.js') }}"></script>
    <script src="{{ asset('js/videojs/videojs-contrib-hls.js') }}"></script>
    <script src="{{ asset('js/videojs/videojs5-hlsjs-source-handler.js') }}"></script>

    <script>
        videojs.options.children.loadingSpinner = false;
    </script>

    <script>
        var projects = [];
        var selProject;

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
                                    '{{ $videoclip->message->speed }}', '{{ $videoclip->message->duration }}', '{{ $videoclip->message->xpos }}',
                                    '{{ $videoclip->message->xpos }}', '{{ $videoclip->message->ypos }}', '{{ $videoclip->message->fonttype }}',
                                    '{{ $videoclip->message->fontsize }}', '{{ $videoclip->message->fontcolor }}');
                            @endif
                            videoclips.push(new Videoclip('{{ $videoclip->id }}', '{{ $videoclip->title }}', '{{ $videoclip->url }}', message));
                        @endforeach
                    @endif
                    var message = null;
                    @if(isset($playlist->message))
                        message = new Message('{{ $playlist->message->id }}', '{{ $playlist->message->text }}', '{{ $playlist->message->effect }}',
                            '{{ $playlist->message->speed }}', '{{ $playlist->message->duration }}', '{{ $playlist->message->xpos }}',
                            '{{ $playlist->message->xpos }}', '{{ $playlist->message->ypos }}', '{{ $playlist->message->fonttype }}',
                            '{{ $playlist->message->fontsize }}', '{{ $playlist->message->fontcolor }}');
                    @endif
                    playlists.push(new Playlist('{{ $playlist->id }}', '{{ $playlist->title }}', videoclips, message));
                @endforeach
            @endif
            projects.push(new Project('{{ $project->id }}', '{{ $project->title }}', '{{ $project->url }}', playlists));
        @endforeach

        function activatePlaylist() {

        }

        function deactivatePlaylist() {

        }

        function checkTime(i) {
            if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }

        function startTimer() {
            var today = new Date();

            var year = today.getFullYear();
            var month = today.getMonth() + 1;
            month = month < 10 ? '0' + month : month;
            var day = today.getDate();
            day = day < 10 ? '0' + day : day;

            var hours = today.getHours();
            var minutes = today.getMinutes();
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12;
            hours = hours < 10 ? '0' + hours : hours;
            minutes = minutes < 10 ? '0'+minutes : minutes;

            $('#timer_date').html(year + ' / ' + month + ' / ' + day);
            $('#timer_time').html(hours + ' : ' + minutes + ' ' + ampm);
            var t = setTimeout(startTimer, 1000);
        }

        $(function() {
            startTimer();

            @if(isset($project))
                $('#project_url').val('{{ $project->url }}');
            @endif

            @if(isset($playlist))
                $('#videoclips').empty();
                @php
                    $index = 0;
                @endphp

                @foreach($playlist->videoclips as $item)
                    @if($index % 6 == 0)
                        $('#videoclips').append('<div class="greenbox editorBox">{{ $item->title }}<p>sub text here</p></div>');
                    @elseif($index % 6 == 1)
                        $('#videoclips').append('<div class="Bluebox editorBox">{{ $item->title }}<p>sub text here</p></div>');
                    @elseif($index % 6 == 2)
                        $('#videoclips').append('<div class="redbox editorBox">{{ $item->title }}<p>sub text here</p></div>');
                    @elseif($index % 6 == 3)
                        $('#videoclips').append('<div class="orangebox editorBox">{{ $item->title }}<p>sub text here</p></div>');
                    @elseif($index % 6 == 4)
                        $('#videoclips').append('<div class="lightbluebox editorBox">{{ $item->title }}<p>sub text here</p></div>');
                    @elseif($index % 6 == 5)
                        $('#videoclips').append('<div class="greybox editorBox">{{ $item->title }}<p>sub text here</p></div>');
                    @endif
                    @php
                        $index++;
                    @endphp
                @endforeach
            @endif

            $('#project').change(function() {
                for (var i = 0; i < projects.length; i++) {
                    if (projects[i].id == $('#project').val()) {
                        selProject = projects[i];
                        break;
                    }
                }
                $('#project_url').val(selProject.url);
                $('#playlist').empty();
                selProject.playlists.forEach(function(item, index){
                    $('#playlist').append('<option value="' + item.id + '">' + item.title + '</option>');
                });
            });

            $('#playlist').change(function() {
                var selPlaylist;
                for (var i = 0; i < selProject.playlists.length; i++) {
                    if (selProject.playlists[i].id == $('#playlist').val()) {
                        selPlaylist = selProject.playlists[i];
                        break;
                    }
                }

                $('#videoclips').empty();
                selPlaylist.videoclips.forEach(function(item, index) {
                    switch (index % 6) {
                        case 0:
                            $('#videoclips').append('<div class="greenbox editorBox">' + item.title + '<p>sub text here</p></div>');
                            break;
                        case 1:
                            $('#videoclips').append('<div class="Bluebox editorBox">' + item.title + '<p>sub text here</p></div>');
                            break;
                        case 2:
                            $('#videoclips').append('<div class="redbox editorBox">' + item.title + '<p>sub text here</p></div>');
                            break;
                        case 3:
                            $('#videoclips').append('<div class="orangebox editorBox">' + item.title + '<p>sub text here</p></div>');
                            break;
                        case 4:
                            $('#videoclips').append('<div class="lightbluebox editorBox">' + item.title + '<p>sub text here</p></div>');
                            break;
                        case 5:
                            $('#videoclips').append('<div class="greybox editorBox">' + item.title + '<p>sub text here</p></div>');
                            break;
                    }
                });

                $('#menu1').empty();
                selPlaylist.videoclips.forEach(function(item, index) {
                    var videoclipHtml =
                            '<div class="col-xs-6 col-sm-6 col-md-3 wow fadeInUp">' +
                            '<div class="video-box">' +
                            '<video id="video%id%" class="videoclip video-js vjs-default-skin vjs-4-3" data-setup=\'%data%\'></video>' +
                            '</div>' +
                            '</div><!--col-3-->';

                    var data = {};
                    data.techOrder = [];
                    data.sources = [];

                    if (item.url.indexOf("youtube") !== -1) {
                        var source = {};
                        source.type = "video/youtube";
                        source.src = item.url;

                        data.techOrder.push("youtube");
                        data.sources.push(source);
                    } else if (item.url.indexOf("vimeo") !== -1) {
                        var source = {};
                        source.type = "video/vimeo";
                        source.src = item.url;

                        var option = {};
                        option.color = "#fbc51b";
                        option.controls = false;

                        data.techOrder.push("vimeo");
                        data.sources.push(source);
                        //data.vimeo = option;
                    }
                    videoclipHtml = videoclipHtml.replace('%id%', item.id).replace('%data%', JSON.stringify(data));
                    $('#menu1').append(videoclipHtml);

                    videojs('video' + item.id);

                    $('#video' + item.id).click(function () {
                        var player = videojs.getPlayers()['video' + item.id];
                        player.play();
                    });
                });
            });
        });
    </script>
@stop