@extends('layouts.default')
@section('content')
    <div class="col-sm-12 col-md-12">
        <div class="table-section">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 35px;">ID</th>
                            <th>Title</th>
                            <th>Month</th>
                            <th>WeekDay</th>
                            <th>Start</th>
                            <th>Message</th>
                            <th>Loop</th>
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
                                    @if(isset($item->message))
                                        {{ $item->message->text }}
                                    @endif
                                </td>
                                <td>1</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!--table-responsive-->
        </div><!--table-section-->
    </div><!--col-12-->

    <div class="bottom-btns project-list-btns">
        <a href="{{ url('playlist/create') }}" class="save-btn ic-save"><span>Add Playlist</span></a>
        <a href="javascript:void(0);" class="add-video-btn ic-edit-project"><span>Edit Playlist</span></a>
        <a href="javascript:void(0);" class="del-video-btn ic-delete-video"><span>Delete Playlist</span></a>
    </div>

    <script>
        $(function() {
            $('.tbl_row').click(function(){
                $('.tbl_row').removeClass('active-tr');
                $(this).addClass('active-tr');
            });

            $('.ic-edit-project').click(function () {
                if ($('tbody>tr').hasClass('active-tr')) {
                    $('.active-tr').each(function(index, value) {
                        window.location.href = "{{ url('/playlist/edit') }}/" + value.children[0].innerText;
                    });
                } else {
                    swal("Please select playlist to edit",{
                        icon:"error",
                    });
                }
            });

            $('.ic-delete-video').click(function () {
                if ($('tbody>tr').hasClass('active-tr')) {
                    $('.active-tr').each(function(index, value) {
                        swal({
                            title: "Playlist",
                            text: "Do you really want to delete this?",
                            icon: "error",
                            buttons: true,
                            dangerMode: true
                        }).then(function(result) {
                            if (result) {
                                $('#id').val(value.children[0].innerText);

                                $.get('/playlist/destroy/' + value.children[0].innerText,  function (response) {
                                    if (response.result == 'success') {
                                        $('tr[data-id="' + response.id + '"]').remove();
                                        swal("Playlist", "Playlist successfully deleted", "success");
                                    } else {
                                        swal("Playlist", "Deleting playlist failed", "error");
                                    }
                                });
                            }
                        });
                    });
                } else {
                    swal("Please select playlist to delete",{
                        icon:"error",
                    });
                }
            });
        });
    </script>
@stop