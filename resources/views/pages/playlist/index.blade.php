@extends('layouts.default')
@section('content')
    <div class="col-sm-12 col-md-12">
        <div class="table-section">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 35px;">ID</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Month') }}</th>
                            <th>{{ __('Week Day') }}</th>
                            <th>{{ __('Start Time') }}</th>
                            <th>{{ __('Message') }}</th>
                            <th>{{ __('Loop') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- class="active-tr" -->
                        @foreach($playlists as $item)
                            @php
                                if(isset($item->schedule)) {
                                    $months = explode(',', $item->schedule->months);
                                    $weekdays = explode(',', $item->schedule->days);
                                }
                            @endphp
                            <tr class="tbl_row" data-id="{{ $item->id }}">
                                <td style="text-align: center;">{{ $item->id }}</td>
                                <td><span>{{ $item->title }}</span></td>
                                <td>
                                    @if(isset($months))
                                        @foreach($months as $month)
                                            @if(is_numeric($month))
                                                {{ Config::get('constants.months')[$month] }},
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if(isset($weekdays))
                                        @foreach($weekdays as $weekday)
                                            @if(is_numeric($weekday))
                                                {{ Config::get('constants.weekdays')[$weekday] }},
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if(isset($item->schedule))
                                        {{ $item->schedule->start_time }}
                                    @endif
                                </td>
                                <td>
                                    <span>
                                        @if(isset($item->message))
                                            {{ $item->message->text }}
                                        @endif
                                    </span>
                                </td>
                                <td style="line-height: 0px;">
                                    <div class="round">
                                        <input type="checkbox" id="endless" name="endless" @if(isset($item->schedule) and $item->schedule->endless == 1) checked @endif disabled>
                                        <label for="endless"></label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!--table-responsive-->
        </div><!--table-section-->
    </div><!--col-12-->

    <div class="bottom-btns project-list-btns">
        <a href="{{ url('playlist/create') }}" class="save-btn ic-save"><span>{{ __('Add Playlist') }}</span></a>
        <a href="javascript:void(0);" class="add-video-btn ic-edit-project"><span>{{ __('Edit Playlist') }}</span></a>
        <a href="javascript:void(0);" class="del-video-btn ic-delete-video"><span>{{ __('Delete Playlist') }}</span></a>
    </div>

    <script>
        $(function() {
            $('.tbl_row').click(function(){
                $('.tbl_row').removeClass('active-tr');
                $(this).addClass('active-tr');
            });

            $('.tbl_row').dblclick(function() {
                window.location.href = "{{ url('/playlist/edit') }}/" + $(this).data('id');
            });

            $('.ic-edit-project').click(function () {
                if ($('tbody>tr').hasClass('active-tr')) {
                    $('.active-tr').each(function(index, value) {
                        window.location.href = "{{ url('/playlist/edit') }}/" + $(this).data('id');
                    });
                } else {
                    swal("{{ __('Please select playlist to edit') }}", {
                        icon:"error"
                    });
                }
            });

            $('.ic-delete-video').click(function () {
                if ($('tbody>tr').hasClass('active-tr')) {
                    $('.active-tr').each(function(index, value) {
                        var id = $(this).data('id');

                        swal({
                            title: "Playlist",
                            text: "{{ __('Do you really want to delete this?') }}",
                            icon: "error",
                            buttons: true,
                            dangerMode: true
                        }).then(function(result) {
                            if (result) {
                                $('#id').val(id);

                                $.get('/playlist/destroy/' + id,  function (response) {
                                    if (response.result == 'success') {
                                        $('tr[data-id="' + response.id + '"]').remove();
                                        swal("Playlist", "{{ __('Playlist successfully deleted') }}", "success");
                                    } else {
                                        swal("Playlist", "{{ __('Deleting playlist failed') }}", "error");
                                    }
                                });
                            }
                        });
                    });
                } else {
                    swal("{{ __('Please select playlist to delete') }}",{
                        icon:"error",
                    });
                }
            });
        });
    </script>
@stop