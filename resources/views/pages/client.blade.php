<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Suisse View</title>
    <meta name="keywords" content="Suisse View" />
    <!-- Bootstrap -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png" />
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-slider.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fonts/ic-style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main-style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
    <script src="{{ asset('js/jquery-2.1.4.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/filterable.pack.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/scrollbar.js') }}"></script>
    <script src="{{ asset('js/bootstrap-slider.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap-timepicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetalert.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/classes.js') }}"></script>


    <link href="{{ asset('css/videojs/video-js.css') }}" rel="stylesheet">
    <link href="{{ asset('css/videojs/videojs.watermark.css') }}" rel="stylesheet">
    <link href="{{ asset('css/videojs/videojs-logo-overlay.css') }}" rel="stylesheet">
    <link href="{{ asset('css/videojs/colorpick.css') }}" rel="stylesheet">

    <script src="{{ asset('js/videojs/video.js') }}"></script>
    <script src="{{ asset('js/videojs/videojs-contrib-hls.js') }}"></script>
    <script src="{{ asset('js/videojs/videojs5-hlsjs-source-handler.js') }}"></script>
    <script src="{{ asset('js/videojs/Youtube.min.js') }}"></script>
    <script src="{{ asset('js/videojs/videojs-vimeo.js') }}"></script>
</head>

<body>
<div id="videoContainer"></div>

<script>
    var index = 0;

    function startTimer() {
        var today = new Date();
        var month = today.getMonth();
        var day = today.getDay();

        var hours = today.getHours();
        hours = hours < 10 ? '0' + hours : hours;
        var minutes = today.getMinutes();
        minutes = minutes < 10 ? '0' + minutes : minutes;

        var b1 = playlist.schedule.months.includes(month.toString());
        var b2 = playlist.schedule.days.includes(day.toString());
        var b3 = playlist.schedule.start_time <= hours + ":" + minutes + ":" + "00";

        if (b1 && b2 && b3) {
            playVideoClip(playlist.videoclips[0]);
        } else {
            setTimeout(startTimer, 1000);
        }
    }

    function playVideoClip(item) {
        $('#videoContainer').empty();

        videoclipHtml = '<video id="video%id%" class="video-js vjs-default-skin vjs-4-3" data-setup=\'%data%\'></video>';

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
        $('#videoContainer').append(videoclipHtml);

        videojs('video' + item.id).ready(function() {
            var player = this;
            player.play();

            index ++;

            player.on('ended', function() {
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

    @if(!isset($project))
        swal("Project", "Project is not available", "error");
    @elseif(!isset($project->activatedPlaylist))
        swal("Server", "Server is not streaming now", "error");
    @else
        <?php $playlist = $project->activatedPlaylist()->first(); ?>
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

        var schedule = null;
        @if(isset($playlist->schedule))
            schedule = new Schedule('{{ $playlist->schedule->id }}', '{{ $playlist->schedule->start_time }}', '{{ $playlist->schedule->end_time }}',
                '{{ $playlist->schedule->endless }}', '{{ $playlist->schedule->days }}', '{{ $playlist->schedule->months }}');
        @endif

        var playlist = new Playlist('{{ $playlist->id }}', '{{ $playlist->title }}', videoclips, message, schedule);

        if (schedule != null)
            startTimer();
    @endif
</script>
</body>
</html>