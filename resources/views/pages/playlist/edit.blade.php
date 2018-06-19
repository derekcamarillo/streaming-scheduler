@extends('layouts.default')
@section('content')
    <h1 class="titleh1">{{ __('Edit Playlist') }}</h1>

    <div class="col-sm-12 select-box create-playlist">
        <input type="text" id="title" name="title" placeholder="Playlist title" class="input" value="{{ $playlist->title }}">
    </div>

    <div class="col-sm-12 select-box">
        <div class="row edit-playlist-options">
            <div class="col-xs-12 col-sm-12 col-md-4">
                <select class="form-control" id="message_id">
                    @if(sizeof($messages) > 0)
                        @foreach($messages as $item)
                            @if(isset($playlist->message) && $item->id == $playlist->message->id)
                                <option value="{{ $item->id }}" selected>{{ $item->text }}</option>
                            @else
                                <option value="{{ $item->id }}">{{ $item->text }}</option>
                            @endif
                        @endforeach
                    @else
                        <option value="0" selected>{{ __('Please select message') }}</option>
                    @endif
                </select>
            </div><!--col-3-->

            <div class="col-xs-6 col-sm-4 col-md-3 bootstrap-timepicker timepicker">
                <span>{{ __('Start Time') }}</span>
                <input type="text" id="start_time" name="start_time" class="timepicker" placeholder="hh:mm" value="@if(isset($playlist->schedule)) {{ $playlist->schedule->start_time }} @endif" >
            </div><!--col-3-->

            <div class="col-xs-6 col-sm-4 col-md-3">
                <span>{{ __('End Time') }}</span>
                <input type="text" id="end_time" name="end_time" class="timepicker" placeholder="hh:mm" value="@if(isset($playlist->schedule)) {{ $playlist->schedule->end_time }} @endif">
            </div><!--col-3-->

            <div class="col-xs-6 col-sm-4 col-md-2 endles-loop">
                <div class="round">
                    @if(isset($playlist->schedule) and $playlist->schedule->endless == 1)
                        <input type="checkbox" id="endless" name="endless" checked/>
                    @else
                        <input type="checkbox" id="endless" name="endless" />
                    @endif
                    <label for="endless"><span>{{ __('Endles Loop') }}</span></label>
                </div>
            </div><!--col-2-->
        </div><!--row | edit-playlist-options-->
    </div><!--col-12-->

    @php
        if(isset($playlist->schedule)) {
            $months = explode(',', $playlist->schedule->months);
            $weekdays = explode(',', $playlist->schedule->days);
        }
    @endphp

    <div class="col-sm-12">
        <div class="week-days">
            <span>Week Days</span>
            @for($i = 0; $i < sizeof(Config::get('constants.weekdays')); $i++)
                @if(in_array($i, $weekdays))
                    <a class="c_days active" data-day="{{ $i }}">{{ Config::get('constants.weekdays')[$i] }}</a>
                @else
                    <a class="c_days" data-day="{{ $i }}">{{ Config::get('constants.weekdays')[$i] }}</a>
                @endif
            @endfor
        </div>
    </div><!--col-12-->

    <div class="col-sm-12">
        <div class="week-days months">
            <span>Months</span>
            @for($i = 0; $i < sizeof(Config::get('constants.months')); $i++)
                @if(in_array($i, $months))
                    <a class="c_months active" data-month="{{ $i }}">{{ Config::get('constants.months')[$i] }}</a>
                @else
                    <a class="c_months" data-month="{{ $i }}">{{ Config::get('constants.months')[$i] }}</a>
                @endif
            @endfor
        </div>
    </div><!--col-12-->

    <div class="col-sm-12 col-md-12">
        <div class="table-section">
            <div class="table-responsive">
                <table id="tbl_videoclip1" class="table">
                    <thead>
                    <tr>
                        <th style="width: 35px;">NO</th>
                        <th>{{ __('Video Clip Title') }}</th>
                        <th>{{ __('Video Clip Url') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @for($i = 0; $i < sizeof($playlist->videoclips); $i++)
                            <tr class="tbl-row" data-id="{{ $playlist->videoclips[$i]->id }}">
                                <td style="text-align: center;">{{ $i + 1 }}</td>
                                <td>{{ $playlist->videoclips[$i]->title }}</td>
                                <td>{{ $playlist->videoclips[$i]->url }}</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div><!--table-responsive-->
        </div><!--table-section-->
    </div><!--col-12-->

    <div class="bottom-btns">
        <a class="add-video-btn ic-add-video" data-toggle="modal" data-target="#modal_videoclip"><span>{{ __('Add Video Clip') }}</span></a>
        <a class="del-video-btn ic-delete-video"><span>{{ __('Delete Selected Video') }}</span></a>
    </div>
    <div class="bottom-btns">
        <a class="move-btn ic-move-up"><span>{{ __('Move Up') }}</span></a>
        <a class="move-btn ic-move-down"><span>{{ __('Move Down') }}</span></a>
        <a class="save-btn ic-save"><span>{{ __('Save') }}</span></a>
    </div>

    <!------------------------  Select Video Clip Dialog -------------------------------------->
    <div class="modal fade" id="modal_videoclip" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">{{ __('Select Video Clip') }}</h4>
                </div>
                <div class="modal-body">
                    <table id="tbl_videoclip2" class="table">
                        <thead>
                        <tr>
                            <th style="width: 35px;">ID</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Url') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($videoclips as $item)
                            @if($playlist->videoclips->contains('id', $item->id) != true)
                                <tr class="tbl-row" data-id="{{ $item->id }}">
                                    <td style="text-align: center;">{{ $item->id }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->url }}</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
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

            $('.ic-delete-video').click(function(event) {
                if ($('#tbl_videoclip1>tbody>tr').hasClass('active-tr')) {
                    $('#tbl_videoclip1 .tbl-row.active-tr').each(function(index, value) {
                        $('#tbl_videoclip2>tbody').append($(this).clone());
                        $(this).remove();
                    });
                } else {
                    swal("{{ __('Please select video clip to remove') }}", {
                        icon:"error",
                    });
                }
            });

            $('.ic-save').click(function(event) {
                waitingDialog.show();

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

                $.post('/playlist/update/{{ $playlist->id }}', {
                    '_token' : '{{ csrf_token() }}',
                    'title' : $('#title').val(),
                    'message_id' : $('#message_id').val(),
                    'start_time' : $('#start_time').val(),
                    'end_time' : $('#end_time').val(),
                    'days' : days,
                    'months' : months,
                    'endless' : $("#endless").is(":checked") ? 1 : 0,
                    'videoclips' : videoclips
                }, function (response) {
                    waitingDialog.hide();

                    if (response.result == '<?= Config::get('constants.status.success') ?>') {
                        swal("Playlist", "{{ __('Playlist successfully saved') }}", "success");
                    } else {
                        swal("Playlist", "{{ __('Saving playlist failed') }}", "error");
                    }
                });
            });

            $('.ic-move-up').click(function(event) {
                if ($('#tbl_videoclip1>tbody>tr').hasClass('active-tr')) {
                    $('#tbl_videoclip1 .tbl-row.active-tr').each(function(index, value) {
                        $(this).insertBefore($(this).prev());
                    });
                } else {
                    swal("{{ __('Please select video clip to remove') }}",{
                        icon:"error",
                    });
                }
            });

            $('.ic-move-down').click(function(event) {
                if ($('#tbl_videoclip1>tbody>tr').hasClass('active-tr')) {
                    $('#tbl_videoclip1 .tbl-row.active-tr').each(function(index, value) {
                        $(this).insertAfter($(this).next());
                    });
                } else {
                    swal("{{ __('Please select video clip to remove') }}", {
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

            $('#tbl_videoclip1 .tbl-row').click(function() {
                $('.tbl-row').removeClass('active-tr');
                $(this).addClass('active-tr');
            });

            $('#tbl_videoclip1 .tbl-row').dblclick(function() {
                var id = $(this).data('id');
                window.location.href = "{{ url('/videoclip/edit') }}/" + id;
            });

            $('#tbl_videoclip2 .tbl-row').click(function() {
                var clone = $(this).clone();
                clone.find('td:first-child').html($('#tbl_videoclip1 tr').length);

                $('#tbl_videoclip1>tbody').append(clone);
                $(this).remove();

                $('#tbl_videoclip1 .tbl-row').dblclick(function() {
                    var id = $(this).data('id');
                    window.location.href = "{{ url('/videoclip/edit') }}/" + id;
                });

                $('#tbl_videoclip1 .tbl-row').click(function() {
                    $('.tbl-row').removeClass('active-tr');
                    $(this).addClass('active-tr');
                });

                $('#modal_videoclip').modal('hide');
            });
        });
    </script>
@stop

