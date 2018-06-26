@extends('layouts.default')
@section('content')
    <div class="row">
        <h1 class="titleh1">{{ __('Video Streaming Software') }}</h1>
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
                    <input type="text" id="project_url" placeholder="{{ __('Project URL') }}(https://suisse-video.ch/{{ Auth::user()->name }}/.../index.html.)">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <select class="form-control" id="project">
                        @if (count($projects) == 0)
                            <option disabled selected>{{ __('Please select project') }}</option>
                        @endif

                        @foreach($projects as $item)
                            <option value="{{ $item->id }}">{{ $item->title }}</option>
                        @endforeach
                    </select>
                </div><!--col-6-->
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <select class="form-control" id="playlist">
                        <option disabled selected>{{ __('Please select playlist') }}</option>
                    </select>
                </div><!--col-6-->
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <a class="activate-playlist-button" style="cursor: pointer;" onclick="activatePlaylist(event)">
                        <span>{{ __('Activate Selected Playlist') }}</span>
                    </a>
                </div><!--col-6-->
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <a class="stop-playlist-button" style="cursor: pointer;" onclick="deactivatePlaylist(event)">
                        <span>{{ __('Stop Selected Playlist') }}</span>
                    </a>
                </div><!--col-6-->
            </div><!--row-->
        </div><!--col-12-->
    </div><!--row-->
    <div class="video-section">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#menu1">{{ __('Playlist Video Clips') }}</a></li>
            <li><a data-toggle="tab" href="#menu2">Playlist History</a></li>
            <li style="float: right;"><a onclick="clearHistory()">Clear History</a></li>
        </ul><!--nav nav-tabs-->
        <div class="tab-content table-section">
            <div id="menu1" class="tab-pane fade in active">

            </div><!--menu1-->

            <div id="menu2" class="tab-pane fade">
                <div class="table-responsive">
                    <table id="tbl_history" class="table">
                        <thead>
                        <tr>
                            <th>{{ __('Project Title') }}</th>
                            <th>{{ __('Playlist Title') }}</th>
                            <th>{{ __('Program Start Time') }}</th>
                            <th>{{ __('Started Date/Time') }}</th>
                            <th>{{ __('Stopped Date/Time') }}</th>
                            <th>{{ __('Status On/Off') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($histories as $item)
                                <tr class="tbl_row" data-id="{{ $item->id }}">
                                    <td>{{ $item->project->title }}</td>
                                    <td>{{ $item->playlist->title }}</td>
                                    <td>{{ $item->playlist->schedule->start_time }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>@if($item->created_at != $item->updated_at) {{ $item->updated_at }} @endif</td>
                                    <td>@if($item->isPlaying == 0) Off @else On @endif</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!--table-responsive-->
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

            projects.push(new Project('{{ $project->id }}', '{{ $project->title }}', '{{ url(Auth::user()->name.'/'.$project->title.'/index.html') }}', playlists));
        @endforeach

        function updateHistory() {
            $.get('/home/getHistory', function (response) {
                if (response.result == 'success') {
                    $('#tbl_history>tbody').empty();

                    for (var i = 0; i < response.data.length; i++) {
                        $('#tbl_history>tbody').append(
                                '<tr class="tbl_row" data-id="' + response.data[i].id + '">' +
                                    '<td>' + response.data[i].project + '</td>' +
                                    '<td>' + response.data[i].playlist + '</td>' +
                                    '<td>' + response.data[i].schedule + '</td>' +
                                    '<td>' + response.data[i].started + '</td>' +
                                    '<td>' + response.data[i].stopped + '</td>' +
                                    '<td>' + response.data[i].status + '</td>' +
                                '</tr>');
                    }
                }
            });
        }

        function clearHistory() {
            waitingDialog.show();

            $.get('/home/clearHistory', function (response) {
                if (response.result == "success") {
                    $('#tbl_history>tbody').empty();
                }

                waitingDialog.hide();
            });
        }

        function activatePlaylist(e) {
            /*
            if (e.target.className == "")
                return;
            */

            if (e.target.className.indexOf('disabled') > 0)
                return;

            if (! $('#project').val()) {
                swal("Project", "{{ __('Please select project') }}", "error");
                return;
            }

            if (! $('#playlist').val()) {
                swal("Playlist", "{{ __('Please select playlist') }}", "error");
                return;
            }

            waitingDialog.show();

            $.post('/playlist/activatePlaylist', {
                '_token' : '{{ csrf_token() }}',
                'project_id' : $('#project').val(),
                'playlist_id' : $('#playlist').val(),
            }, function (response) {
                waitingDialog.hide();

                if (response.result == '<?= Config::get('constants.status.success') ?>') {
                    swal("Playlist", "{{ __('Playlist activated successfully') }}", "success");

                    for (var i = 0; i < projects.length; i++) {
                        if (projects[i].id == $('#project').val()) {
                            showVideoSchedule(projects[i]);
                            break;
                        }
                    }

                    var activeButton = $('.activate-playlist-button');
                    var deactiveButton = $('.stop-playlist-button');

                    for (var i = 0; i < projects.length; i++) {
                        var done = false;
                        for (var j = 0; j < projects[i].playlists.length; j++) {
                            if (projects[i].playlists[j].id == $('#playlist').val()) {
                                projects[i].playlists[j].activated = 1;

                                activeButton.css('cursor', 'not-allowed');
                                activeButton.addClass('disabled');
                                activeButton.css('background', '#a9a9a9');
                                deactiveButton.css('cursor', 'pointer');
                                deactiveButton.removeClass('disabled');
                                deactiveButton.css('background', 'linear-gradient(to right, #fb505f, #fb6a4e)');

                                done = true;
                            } else {
                                projects[i].playlists[j].activated = 0;
                            }
                        }
                        if (done == true)
                            break;
                    }

                    updateHistory();
                } else if (response.result == '<?= Config::get('constants.status.validation') ?>') {
                    swal("Playlist", "{{ __('Validation failed') }}", "error");
                } else {
                    swal("Playlist", "{{ __('Activating playlist failed') }}", "error");
                }
            });
        }

        function deactivatePlaylist(e) {
            /*
            if (e.target.className == "")
                return;
            */

            if (e.target.className.indexOf('disabled') > 0)
                return;

            if (! $('#project').val()) {
                swal("Project", "{{ __('Please select project') }}", "error");
                return;
            }

            if (! $('#playlist').val()) {
                swal("Playlist", "{{ __('Please select playlist') }}", "error");
                return;
            }

            waitingDialog.show();

            $.post('/playlist/deactivatePlaylist', {
                '_token' : '{{ csrf_token() }}',
                'project_id' : $('#project').val(),
                'playlist_id' : $('#playlist').val(),
            }, function (response) {
                waitingDialog.hide();

                if (response.result == '<?= Config::get('constants.status.success') ?>') {
                    swal("Playlist", "{{ __('Playlist deactivated successfully') }}", "success");

                    $('#videoclips').html('');

                    var activeButton = $('.activate-playlist-button');
                    var deactiveButton = $('.stop-playlist-button');

                    for (var i = 0; i < projects.length; i++) {
                        var done = false;
                        for (var j = 0; j < projects[i].playlists.length; j++) {
                            if (projects[i].playlists[j].id == $('#playlist').val()) {
                                projects[i].playlists[j].activated = 0;

                                activeButton.css('cursor', 'pointer');
                                activeButton.removeClass('disabled');
                                activeButton.css('background', 'linear-gradient(to right, #08aeea, #2af598)');
                                deactiveButton.css('cursor', 'not-allowed');
                                deactiveButton.addClass('disabled');
                                deactiveButton.css('background', '#a9a9a9');

                                done = true;
                                break;
                            }
                        }
                        if (done == true)
                            break;
                    }

                    updateHistory();
                } else if (response.result == '<?= Config::get('constants.status.validation') ?>') {
                    swal("Playlist", "{{ __('Validation failed') }}", "error");
                } else {
                    swal("Playlist", "{{ __('Deactivating playlist failed') }}", "error");
                }
            });
        }

        function checkTime(i) {
            if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }

        function showVideoSchedule(project) {
            $('#videoclips').empty();

            var playlist;

            for (var i = 0; i < project.playlists.length; i++) {
                if (project.playlists[i].activated == 1) {
                    playlist = project.playlists[i];
                    break;
                }
            }

            if (playlist) {
                playlist.videoclips.forEach(function(item, index) {
                    ///////////////////////////   Reset video clips in the time line ////////////////////////////////
                    switch (index % 6) {
                        case 0:
                            $('#videoclips').append('<div class="greenbox editorBox">' + item.title + '<!--p>sub text here</p--></div>');
                            break;
                        case 1:
                            $('#videoclips').append('<div class="Bluebox editorBox">' + item.title + '<!--p>sub text here</p--></div>');
                            break;
                        case 2:
                            $('#videoclips').append('<div class="redbox editorBox">' + item.title + '<!--p>sub text here</p--></div>');
                            break;
                        case 3:
                            $('#videoclips').append('<div class="orangebox editorBox">' + item.title + '<!--p>sub text here</p--></div>');
                            break;
                        case 4:
                            $('#videoclips').append('<div class="lightbluebox editorBox">' + item.title + '<!--p>sub text here</p--></div>');
                            break;
                        case 5:
                            $('#videoclips').append('<div class="greybox editorBox">' + item.title + '<!--p>sub text here</p--></div>');
                            break;
                    }
                });
            }
        }

        function selectProject(project) {
            selProject = project;

            $('#project_url').val(project.url);
            $('#playlist').empty();
            //$('#videoclips').empty();
            $('#menu1').empty();

            if (project.playlists.length == 0) {
                $('#playlist').append('<option disabled selected>Please select playlist</option>');
            } else {
                project.playlists.forEach(function(item, index){
                    if (index == 0)
                        selectPlaylist(item);
                    $('#playlist').append('<option value="' + item.id + '">' + item.title + '</option>');
                });
            }
        }

        function selectPlaylist(playlist) {
             /*
             $('#videoclips').empty();
             $('#menu1').empty();
             */

            var activeButton = $('.activate-playlist-button');
            var deactiveButton = $('.stop-playlist-button');

            if (playlist.activated == 1) {
                activeButton.css('cursor', 'not-allowed');
                activeButton.addClass('disabled');
                activeButton.css('background', '#a9a9a9');
                deactiveButton.css('cursor', 'pointer');
                deactiveButton.removeClass('disabled');
                deactiveButton.css('background', 'linear-gradient(to right, #fb505f, #fb6a4e)');
            } else {
                activeButton.css('cursor', 'pointer');
                activeButton.removeClass('disabled');
                activeButton.css('background', 'linear-gradient(to right, #08aeea, #2af598)');
                deactiveButton.css('cursor', 'not-allowed');
                deactiveButton.addClass('disabled');
                deactiveButton.css('background', '#a9a9a9');
            }

            playlist.videoclips.forEach(function(item, index) {

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
                    source.src = item.url.replace(' ', '') + "?autoplay=1";

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
                showVideoSchedule(projects[0]);
            }

            $('#project').change(function() {
                for (var i = 0; i < projects.length; i++) {
                    if (projects[i].id == $('#project').val()) {
                        selectProject(projects[i]);
                        showVideoSchedule(projects[i]);
                        break;
                    }
                }
            });

            $('#playlist').change(function() {
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