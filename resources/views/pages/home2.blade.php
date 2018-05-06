@extends('layouts.default')
@section('content')
    <div class="row">
        <h1 class="titleh1">Video Player Scheduler</h1>
        <div class="col-sm-12 col-md-12">
            <div class="date-time">
                <span id="timer_date"><i class="fa fa-calendar-alt"></i>17 / 12 / 2018</span>
                <span id="timer_time"><i class="fa fa-clock"></i>11:30 AM</span>
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
                        <a href="{{action('HomeController@index', ['id'=>1])}}">
                            <img src="{{ asset('images/video-1.jpg') }}">
                        </a>
                    </div>
                </div><!--col-3-->
                <div class="col-xs-6 col-sm-6 col-md-3 wow fadeInUp">
                    <div class="video-box">
                        <a href="{{action('HomeController@index', ['id'=>2])}}">
                            <img src="{{ asset('images/video-2.jpg') }}">
                        </a>
                    </div>
                </div><!--col-3-->
                <div class="col-xs-6 col-sm-6 col-md-3 wow fadeInUp">
                    <div class="video-box">
                        <a href="{{action('HomeController@index', ['id'=>3])}}">
                            <img src="{{ asset('images/video-3.jpg') }}">
                        </a>
                    </div>
                </div><!--col-3-->
                <div class="col-xs-6 col-sm-6 col-md-3 wow fadeInUp">
                    <div class="video-box">
                        <a href="{{action('HomeController@index', ['id'=>4])}}">
                            <img src="{{ asset('images/video-4.jpg') }}">
                        </a>
                    </div>
                </div><!--col-3-->
                <div class="col-xs-6 col-sm-6 col-md-3 wow fadeInUp">
                    <div class="video-box">
                        <a href="{{action('HomeController@index', ['id'=>5])}}">
                            <img src="{{ asset('images/video-5.jpg') }}">
                        </a>
                    </div>
                </div><!--col-3-->
                <div class="col-xs-6 col-sm-6 col-md-3 wow fadeInUp">
                    <div class="video-box">
                        <a href="{{action('HomeController@index', ['id'=>6])}}">
                            <img src="{{ asset('images/video-6.jpg') }}">
                        </a>
                    </div>
                </div><!--col-3-->
                <div class="col-xs-6 col-sm-6 col-md-3 wow fadeInUp">
                    <div class="video-box">
                        <a href="{{action('HomeController@index', ['id'=>7])}}">
                            <img src="{{ asset('images/video-7.jpg') }}">
                        </a>
                    </div>
                </div><!--col-3-->
                <div class="col-xs-6 col-sm-6 col-md-3 wow fadeInUp">
                    <div class="video-box">
                        <a href="{{action('HomeController@index', ['id'=>8])}}">
                            <img src="{{ asset('images/video-8.jpg') }}">
                        </a>
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

    <script>
        function activatePlaylist() {

        }

        function deactivatePlaylist() {

        }

        $(function() {
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

            $('#project').change(function () {
                $.get('/home/getProjectPlaylist/' + $('#project').val(), function (response) {
                    $('#playlist').empty();

                    if (response.result == '<?= Config::get('constants.status.success') ?>') {
                        response.data.forEach(function(item, index) {
                            $('#playlist').append('<option value="' + item.id + '">' + item.title + '</option>');
                        });
                    }
                });
            });

            $('#playlist').change(function() {
                $.get('/home/getPlaylistVideoclip/' + $('#playlist').val(), function (response) {
                    $('#videoclips').empty();

                    if (response.result == '<?= Config::get('constants.status.success') ?>') {
                        response.data.videoclips.forEach(function(item, index) {
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
                    }
                });
            });
        });
    </script>
@stop