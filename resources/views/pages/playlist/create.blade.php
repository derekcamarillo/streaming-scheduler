@extends('layouts.default')
@section('content')
    <h1 class="titleh1">Create Playlist</h1>

    <form id="form_playlist" class="video-scale">
        {{ csrf_field() }}
    </form>

    <div class="col-sm-12 select-box">
        <input type="text" id="title" name="title" placeholder="Playlist title" class="input" value="">
    </div>

    <div class="col-sm-12 select-box">
        <div class="row edit-playlist-options">
            <div class="col-xs-12 col-sm-12 col-md-4">
                <select class="form-control" id="message_id">
                    @foreach($messages as $item)
                        <option value="{{ $item->id }}">{{ $item->text }}</option>
                    @endforeach
                </select>
            </div><!--col-3-->

            <div class="col-xs-6 col-sm-4 col-md-3">
                <span>Start Time</span>
                <input type="text" id="start_time" name="start_time" placeholder="hh:mm" >
            </div><!--col-3-->

            <div class="col-xs-6 col-sm-4 col-md-3">
                <span>End Time</span>
                <input type="text" id="end_time" name="end_time" placeholder="hh:mm" >
            </div><!--col-3-->

            <div class="col-xs-6 col-sm-4 col-md-2 endles-loop">
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
            @foreach(Config::get('constants.weekdays') as $item)
                <a class="c_days">{{ $item }}</a>
            @endforeach
        </div>
    </div><!--col-12-->

    <div class="col-sm-12">
        <div class="week-days months">
            <span>Months</span>
            @foreach(Config::get('constants.months') as $item)
                <a class="c_months">{{ $item }}</a>
            @endforeach
        </div>
    </div><!--col-12-->

    <div class="col-sm-12 col-md-12">
        <div class="table-section">
            <div class="table-responsive">
                <table id="tbl_videoclip1" class="table">
                    <thead>
                    <tr>
                        <th style="width: 35px;">ID</th>
                        <th>Video Clip Title</th>
                        <th>Video Clip Url</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div><!--table-responsive-->
        </div><!--table-section-->
    </div><!--col-12-->

    <div class="bottom-btns">
        <a class="move-btn ic-move-up"><span>Move Up</span></a>
        <a class="add-video-btn ic-add-video" data-toggle="modal" data-target="#modal_videoclip"><span>Add Video Clip</span></a>
        <a class="del-video-btn ic-delete-video"><span>Delete Selected Video</span></a>
        <a class="save-btn ic-save"><span>Save</span></a>
        <a class="move-btn ic-move-down"><span>Move Down</span></a>
    </div>

    <!------------------------  Select Video Clip Dialog -------------------------------------->
    <div class="modal fade" id="modal_videoclip" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Select Video Clip</h4>
                </div>
                <div class="modal-body">
                    <table id="tbl_videoclip2" class="table">
                        <thead>
                        <tr>
                            <th style="width: 35px;">ID</th>
                            <th>Title</th>
                            <th>Url</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($videoclips as $item)
                            <tr class="tbl_row">
                                <td style="text-align: center;" data-id="{{ $item->id }}">{{ $item->id }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->url }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('script')
    <script>
        $(function () {
            $('.ic-delete-video').click(function(event){

            });

            $('.ic-save').click(function(event){

            });

            $('.ic-move-up').click(function(event){

            });

            $('.ic-move-down').click(function(event){

            });

            $('.c_days').click(function(event){
                if ($(this).hasClass('active'))
                    $(this).removeClass('active');
                else
                    $(this).addClass('active');
            });

            $('.c_months').click(function(event){
                if ($(this).hasClass('active'))
                    $(this).removeClass('active');
                else
                    $(this).addClass('active');
            });

            $('#tbl_videoclip1 .tbl_row').click(function() {
                $('.tbl_row').removeClass('active-tr');
                $(this).addClass('active-tr');
            });

            $('#tbl_videoclip2 .tbl_row').click(function() {
                $('#tbl_videoclip1>tbody').append('<tr class="tbl-row">' + $(this).html() + '</tr>');
            });
        });
    </script>
@stop

