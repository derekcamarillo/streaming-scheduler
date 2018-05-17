@extends('layouts.default')
@section('content')
    <h1 class="titleh1">Create Playlist</h1>

    <div class="col-sm-12 select-box create-playlist">
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
                <input type="text" id="start_time" name="start_time" placeholder="hh:mm" class="timepicker">
            </div><!--col-3-->

            <div class="col-xs-6 col-sm-4 col-md-3">
                <span>End Time</span>
                <input type="text" id="end_time" name="end_time" placeholder="hh:mm" class="timepicker">
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
            @for($i = 0; $i < sizeof(Config::get('constants.weekdays')); $i++)
                <a class="c_days" data-day="{{ $i }}">{{ Config::get('constants.weekdays')[$i] }}</a>
            @endfor
        </div>
    </div><!--col-12-->

    <div class="col-sm-12">
        <div class="week-days months">
            <span>Months</span>
            @for($i = 0; $i < sizeof(Config::get('constants.months')); $i++)
                <a class="c_months" data-month="{{ $i }}">{{ Config::get('constants.months')[$i] }}</a>
            @endfor
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
        <div class="modal-dialog modal-lg">
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
                            <tr class="tbl-row" data-id="{{ $item->id }}">
                                <td style="text-align: center;">{{ $item->id }}</td>
                                <td>{{ $item->title }}</td>
                                <td><span style="width: 100%;">{{ $item->url }}</span></td>
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
        var days, months;
        var videoclips = [];

        $(function () {
            $('.timepicker').timepicker({
                showSeconds: false,
                showMeridian: false
            });

            $('.ic-delete-video').click(function(event){
                if ($('#tbl_videoclip1>tbody>tr').hasClass('active-tr')) {
                    $('#tbl_videoclip1 .tbl-row.active-tr').each(function(index, value) {
                        $('#tbl_videoclip2>tbody').append($(this).clone());
                        $(this).remove();
                    });
                } else {
                    swal("Please select video clip to remove",{
                        icon:"error",
                    });
                }
            });

            $('.ic-save').click(function(event){
                days = months = "";
                $('.c_days.active').each(function(index, value) {
                    days += $(this).data().day + ",";
                });

                $('.c_months.active').each(function(index, value) {
                    months += $(this).data().month + ",";
                });

                $('#tbl_videoclip1 .tbl-row').each(function(index, value) {
                    videoclips.push($(this).data().id);
                });

                $.post('/playlist/store', {
                    '_token' : '{{ csrf_token() }}',
                    'title' : $('#title').val(),
                    'message_id' : $('#message_id').val(),
                    'start_time' : $('#start_time').val(),
                    'end_time' : $('#end_time').val(),
                    'days' : days,
                    'months' : months,
                    'endless' : $("#endless").is(":checked") ? 1 : 0,
                    'videoclips' : videoclips,
                }, function (response) {
                    if (response.result == '<?= Config::get('constants.status.success') ?>') {
                        swal("Playlist", "New playlist successfully saved", "success");
                    } else {
                        swal("Playlist", "Saving playlist failed", "error");
                    }
                });
            });

            $('.ic-move-up').click(function(event) {
                if ($('#tbl_videoclip1>tbody>tr').hasClass('active-tr')) {
                    var pos = $('#tbl_videoclip1 .tbl-row.active-tr').index();
                    if (pos == 0)
                        return;

                    $('#tbl_videoclip1 .tbl-row.active-tr').each(function(index, value) {
                        $(this).remove();
                        $("#tbl_videoclip1 .tbl-row:nth-child(" + (pos - 1) + ")").before($(this).clone());
                    });
                } else {
                    swal("Please select video clip to remove",{
                        icon:"error",
                    });
                }
            });

            $('.ic-move-down').click(function(event) {
                if ($('#tbl_videoclip1>tbody>tr').hasClass('active-tr')) {
                    var pos = $('#tbl_videoclip1 .tbl-row.active-tr').index();
                    if (pos == $('#tbl_videoclip1 .tbl-row').length - 1)
                        return;

                    $('#tbl_videoclip1 .tbl-row.active-tr').each(function(index, value) {
                        $(this).remove();
                        $("#tbl_videoclip1 .tbl-row:nth-child(" + (pos + 1) + ")").after($(this).clone());
                    });
                } else {
                    swal("Please select video clip to remove", {
                        icon:"error",
                    });
                }
            });

            $('.c_days').click(function(event) {
                if ($(this).hasClass('active'))
                    $(this).removeClass('active');
                else
                    $(this).addClass('active');
            });

            $('.c_months').click(function(event) {
                if ($(this).hasClass('active'))
                    $(this).removeClass('active');
                else
                    $(this).addClass('active');
            });

            $('#tbl_videoclip2 .tbl-row').click(function() {
                $('#tbl_videoclip1>tbody').append($(this).clone());
                $(this).remove();

                $('#tbl_videoclip1 .tbl-row').click(function() {
                    $('.tbl-row').removeClass('active-tr');
                    $(this).addClass('active-tr');
                });

                $('#modal_videoclip').modal('hide');
            });
        });
    </script>
@stop

