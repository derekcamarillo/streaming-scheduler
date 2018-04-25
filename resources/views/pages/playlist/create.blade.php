@extends('layouts.default')
@section('content')
    <h1 class="titleh1">Create Playlist</h1>

    <form id="form_playlist" class="video-scale">

    </form>

    <div class="col-sm-12 select-box">
        <input type="text" id="title" name="title" placeholder="Playlist title" class="input" value="">
    </div>

    <div class="col-sm-12 select-box">
        <div class="row edit-playlist-options">
            <div class="col-xs-12 col-sm-12 col-md-4">
                <select class="form-control" id="#3">
                    <option>New Messages</option>
                    <option>New Messages 1</option>
                    <option>New Messages 2</option>
                    <option>New Messages 3</option>
                    <option>New Messages 4</option>
                    <option>New Messages 5</option>
                    <option>New Messages 6</option>
                </select>
            </div><!--col-3-->

            <div class="col-xs-6 col-sm-6 col-md-3">
                <span>Start Time</span>
                <input type="text" id="start_time" name="start_time" placeholder="hh:mm" >
            </div><!--col-3-->

            <div class="col-xs-6 col-sm-6 col-md-3">
                <span>End Time</span>
                <input type="text" id="end_time" name="end_time" placeholder="hh:mm" >
            </div><!--col-3-->

            <div class="col-xs-6 col-sm-6 col-md-2 endles-loop">
                <div class="round">
                    <input type="checkbox" id="endless" name="endless" />
                    <label for="endless"><span >Endles Loop</span></label>
                </div>
            </div><!--col-2-->
        </div><!--row | edit-playlist-options-->
    </div><!--col-12-->

    <div class="col-sm-12">
        <div class="week-days">
            <span>Week Days</span>
            <a href="#">Mon.</a>
            <a href="#">Tue.</a>
            <a href="#">Wed.</a>
            <a href="#">Thu.</a>
            <a href="#">Fri.</a>
            <a href="#">Sat.</a>
            <a href="#">Sun.</a>
        </div>
    </div><!--col-12-->

    <div class="col-sm-12">
        <div class="week-days months">
            <span>Months</span>
            <a href="#">Mon.</a>
            <a href="#">Tue.</a>
            <a href="#">Wed.</a>
            <a href="#">Thu.</a>
            <a href="#">Fri.</a>
            <a href="#">Sat.</a>
            <a href="#">Sun.</a>
            <a href="#">Mon.</a>
            <a href="#">Tue.</a>
            <a href="#">Wed.</a>
            <a href="#">Thu.</a>
            <a href="#">Fri.</a>
        </div>
    </div><!--col-12-->

    <div class="col-sm-12 col-md-12">
        <div class="table-section">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="video-clips-links">Video Clip</th>
                            <th>Message Content</th>
                            <th>Message Effect</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="active-tr">
                            <td>Sunset on Rigi Rotstock</td>
                            <td><span>message tyaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaape</span></td>
                            <td>scroll left to right</td>
                        </tr>
                    </tbody>
                </table>
            </div><!--table-responsive-->
        </div><!--table-section-->
    </div><!--col-12-->

    <div class="bottom-btns">
        <a href="#" class="move-btn ic-move-up"><span>Move Up</span></a>
        <a href="#" class="add-video-btn ic-add-video"><span>Add Video Clip</span></a>
        <a href="#" class="del-video-btn ic-delete-video"><span>Delete Selected Video</span></a>
        <a href="#" class="save-btn ic-save"><span>Save</span></a>
        <a href="#" class="move-btn ic-move-down"><span>Move Down</span></a>
    </div>
@stop

@section('script')
    <script>
        $(function () {

        });
    </script>
@stop

