@extends('layouts.default')
@section('content')
    <div class="row">
        <h1 class="titleh1">Logo Overlay</h1>

        <div class="col-sm-12 select-box create-playlist">
            <div class="row edit-playlist-section">
                <div class="col-xs-7 col-sm-5 col-md-5">
                    <select class="form-control" id="#">
                        <option>Select Project</option>
                        <option>Select Project 1</option>
                        <option>Select Project 2</option>
                        <option>Select Project 3</option>
                        <option>Select Project 4</option>
                        <option>Select Project 5</option>
                        <option>Select Project 6</option>
                    </select>
                </div><!--col-5-->

                <div class="col-xs-5 col-sm-3 col-md-3 upload-logo-btn">
                    <a class="activate-playlist-button" href="#">
                        <span>Upload Logo</span>
                    </a>
                </div><!--col-3-->

                <div class="col-xs-12 col-sm-4 col-md-4">
                    <select class="form-control" id="#2">
                        <option>Select Position</option>
                        <option>Select Position 1</option>
                        <option>Select Position 2</option>
                        <option>Select Position 3</option>
                        <option>Select Position 4</option>
                        <option>Select Position 5</option>
                        <option>Select Position 6</option>
                    </select>
                </div><!--col-5-->
            </div><!--row | edit-playlist-section-->
        </div><!--col-12-->

        <div class="col-sm-12 select-box">
            <div class="row edit-playlist-options">
                <div class="col-xs-6 col-sm-3 col-md-3">
                    <span>Ofset X-Position</span>
                    <input type="text" placeholder="10" class="text-center" >
                </div><!--col-3-->

                <div class="col-xs-6 col-sm-3 col-md-3">
                    <span>Ofset Y-Position</span>
                    <input type="text" placeholder="10" class="text-center" >
                </div><!--col-3-->
            </div><!--row | edit-playlist-options-->
        </div><!--col-12-->
    </div><!--row-->

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

    <div class="col-sm-12 col-md-12 bottom-btns logo-overlay-bottom">
        <div class="row">
            <div class="col-xs-4 col-sm-3 col-md-3 span-title">
                <span>Select Message</span>
            </div><!--col-3-->

            <div class="col-xs-8 col-sm-3 col-md-3 select-box">
                <select class="form-control" id="#3">
                    <option>No Messages</option>
                    <option>No Messages 1</option>
                    <option>No Messages 2</option>
                    <option>No Messages 3</option>
                </select>
            </div><!--col-3-->

            <div class="col-xs-6 col-sm-3 col-md-3 btn-full">
                <a href="#" class="add-video-btn ic-start-preview"><span>Start Preview</span></a>
            </div>

            <div class="col-xs-6 col-sm-3 col-md-3 btn-full">
                <a href="#" class="del-video-btn ic-stop-preview"><span>Stop Preview</span></a>
            </div>
        </div><!--row-->
    </div><!--col-12-->
@stop