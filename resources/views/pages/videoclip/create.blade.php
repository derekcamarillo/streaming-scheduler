@extends('layouts.default')
@section('content')
    <div class="row">
        <h1 class="titleh1">Create Video Clip</h1>
        <div class="col-sm-12 select-box create-playlist">
            <div class="row edit-playlist-section edit-playlist-options optionsRight">
                <div class="col-xs-6 col-sm-3 col-md-3">
                    <select class="form-control" id="#">
                        <option value="" disabled="disabled" selected="selected">Select Message Type</option>
                        <option>Select Project 1</option>
                        <option>Select Project 2</option>
                        <option>Select Project 3</option>
                        <option>Select Project 4</option>
                        <option>Select Project 5</option>
                        <option>Select Project 6</option>
                    </select>
                </div>
                <div class="col-xs-6 col-sm-3 col-md-3 scrollspeed">
                    <!--<span>Scroll Speed</span>-->
                    <input id="ScrollSpeed" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="14" />
                </div>
                <div class="col-xs-6 col-sm-3 col-md-3">
                    <span>Duration in sec</span>
                    <input type="text" placeholder="10" class="text-center">
                </div>
                <div class="col-xs-6 col-sm-3 col-md-3">
                    <span>Player X-Position</span>
                    <input type="text" placeholder="10" class="text-center">
                </div>

            </div>
        </div>
        <div class="col-sm-12 select-box optionsRight">
            <div class="row edit-playlist-options">
                <!--col-3-->
                <div class="col-xs-6 col-sm-3 col-md-3">
                    <span>Player Y-Position</span>
                    <input type="text" placeholder="10" class="text-center">
                </div>
                <div class="col-xs-6 col-sm-3 col-md-3">
                    <span>Font Type</span>
                    <select class="form-control fontInput" id="#">
                        <option value="" disabled="disabled" selected="selected">Select Font</option>
                        <option>Arial</option>
                        <option>Poppines</option>
                        <option>Open Sanse</option>
                        <option>Roboto</option>
                    </select>
                </div>
                <div class="col-xs-6 col-sm-3 col-md-3">
                    <span>Font Size</span>
                    <input type="text" placeholder="10" class="text-center">
                </div>
                <div class="col-xs-6 col-sm-3 col-md-3">
                    <span>Font Color</span>
                    <input type="text" class="text-center colorFeild">
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 myVideo-box">
            <div class="add-logo-img">
                <img src="images/add-logo-img.png">
            </div>

            <video id="myVideo">
                <source src="mov_bbb.mp4" type="video/mp4">
                <source src="mov_bbb.ogg" type="video/ogg">
            </video>
        </div>

        <div class="col-sm-12 bottom-btns logo-overlay-video-btns">
            <a href="#" class="add-video-btn"><i class="fa fa-download"></i></a>
            <a onclick="playVid()" type="button" class="del-video-btn"><i class="fa fa-play"></i></a>
            <a onclick="pauseVid()" type="button" class="save-btn"><i class="fa fa-square"></i></a>
        </div><!--col-12-->

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
    </script>
@stop