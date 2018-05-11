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
                        @foreach($projects as $item)
                            <option value="{{ $item->id }}">{{ $item->title }}</option>
                        @endforeach
                    </select>
                </div><!--col-6-->
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <select class="form-control" id="playlist">

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
        var selProject, selPlaylist;

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
                                    '{{ $videoclip->message->fontsize }}', '{{ $videoclip->message->fontcolor }}');
                            @endif
                            videoclips.push(new Videoclip('{{ $videoclip->id }}', '{{ $videoclip->title }}', '{{ $videoclip->url }}', message));
                        @endforeach
                    @endif
                    var message = null;
                    @if(isset($playlist->message))
                        message = new Message('{{ $playlist->message->id }}', '{{ $playlist->message->text }}', '{{ $playlist->message->effect }}',
                            '{{ $playlist->message->speed }}', '{{ $playlist->message->duration }}',
                            '{{ $playlist->message->xpos }}', '{{ $playlist->message->ypos }}', '{{ $playlist->message->fonttype }}',
                            '{{ $playlist->message->fontsize }}', '{{ $playlist->message->fontcolor }}');
                    @endif
                    var schedule = null;
                    @if(isset($playlist->schedule))
                        schedule = new Schedule('{{ $playlist->schedule->id }}', '{{ $playlist->schedule->start_time }}', '{{ $playlist->schedule->end_time }}',
                            '{{ $playlist->schedule->endless }}', '{{ $playlist->schedule->days }}', '{{ $playlist->schedule->months }}');
                    @endif
                    playlists.push(new Playlist('{{ $playlist->id }}', '{{ $playlist->title }}', videoclips, message, schedule));
                @endforeach
            @endif
            projects.push(new Project('{{ $project->id }}', '{{ $project->title }}', '{{ url('project/url/'.$project->url) }}', playlists));
        @endforeach

        function activatePlaylist() {
            if (! $('#project').val()) {
                swal("Project", "Please select project", "error");
                return;
            }

            if (! $('#playlist').val()) {
                swal("Playlist", "Please select playlist", "error");
                return;
            }

            $.post('/playlist/activatePlaylist', {
                '_token' : '{{ csrf_token() }}',
                'project_id' : $('#project').val(),
                'playlist_id' : $('#playlist').val(),
            }, function (response) {
                if (response.result == '<?= Config::get('constants.status.success') ?>') {
                    swal("Project", "New project successfully saved", "success");
                } else if (response.result == '<?= Config::get('constants.status.validation') ?>') {
                    swal("Project", "Validation failed", "error");
                } else {
                    swal("Project", "Saving project failed", "error");
                }
            });
        }

        function deactivatePlaylist() {
            if (! $('#project').val()) {
                swal("Project", "Please select project", "error");
                return;
            }

            if (! $('#playlist').val()) {
                swal("Playlist", "Please select playlist", "error");
                return;
            }

            $.post('/playlist/deactivatePlaylist', {
                '_token' : '{{ csrf_token() }}',
                'project_id' : $('#project').val(),
                'playlist_id' : $('#playlist').val(),
            }, function (response) {
                if (response.result == '<?= Config::get('constants.status.success') ?>') {
                    swal("Project", "New project successfully saved", "success");
                } else if (response.result == '<?= Config::get('constants.status.validation') ?>') {
                    swal("Project", "Validation failed", "error");
                } else {
                    swal("Project", "Saving project failed", "error");
                }
            });
        }

        function checkTime(i) {
            if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }

        function selectProject(project) {
            selProject = project;

            $('#project_url').val(project.url);
            $('#playlist').empty();
            $('#videoclips').empty();
            $('#menu1').empty();

            project.playlists.forEach(function(item, index){
                if (index == 0)
                    selectPlaylist(item);
                $('#playlist').append('<option value="' + item.id + '">' + item.title + '</option>');
            });
        }

        function selectPlaylist(playlist) {
            /*
            $('#videoclips').empty();
            $('#menu1').empty();
            */

            playlist.videoclips.forEach(function(item, index) {
                ///////////////////////////   Reset video clips in the time line ////////////////////////////////
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

                ///////////////////////////   Reset video clips in video list ////////////////////////////////
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

                if (videojs.getPlayers()['video' + item.id]) {
                    delete videojs.getPlayers()['video' + item.id];
                }

                videojs('video' + item.id);

                $('#video' + item.id).click(function () {
                    var player = videojs.getPlayers()['video' + item.id];
                    player.play();
                });
            });
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
            minutes = minutes < 10 ? '0' + minutes : minutes;

            $('#timer_date').html(year + ' / ' + month + ' / ' + day);
            $('#timer_time').html(hours + ' : ' + minutes + ' ' + ampm);
            var t = setTimeout(startTimer, 1000);
        }

        $(function() {
            startTimer();

            if (projects.length > 0) {
                selectProject(projects[0]);
            }

            $('#project').change(function() {
                for (var i = 0; i < projects.length; i++) {
                    if (projects[i].id == $('#project').val()) {
                        selectProject(projects[i]);
                        break;
                    }
                }
            });

            $('#playlist').change(function() {
                $('#videoclips').empty();
                $('#menu1').empty();

                for (var i = 0; i < selProject.playlists.length; i++) {
                    if (selProject.playlists[i].id == $('#playlist').val()) {
                        selectPlaylist(selProject.playlists[i]);
                        break;
                    }
                }
            });
        });
    </script>
@stop