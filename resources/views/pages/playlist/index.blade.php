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
                            <tr class="tbl_row">
                                <td style="text-align: center;">{{ $item->id }}</td>
                                <td><span>{{ $item->title }}</span></td>
                                <td>
                                    @foreach($months as $month)
                                        {{ Config::get('constants.months')[$month - 1] }},
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($weekdays as $weekday)
                                        {{ Config::get('constants.weekdays')[$weekday - 1] }},
                                    @endforeach
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
        <a href="project/create" class="save-btn ic-save"><span>Add Project</span></a>
        <a href="javascript:void(0);" class="add-video-btn ic-edit-project"><span>Edit Project</span></a>
        <a href="javascript:void(0);" class="del-video-btn ic-delete-video"><span>Delete Project</span></a>
    </div>

    <script>
        $(function() {
            $('.tbl_row').click(function(){
                $('.tbl_row').removeClass('active-tr');
                $(this).addClass('active-tr');
            });

            $('.ic-edit-project').click(function () {
                if ($('tbody>tr').hasClass('active-tr')) {
                    $('.active-tr').each(function(index, value){
                        alert(value.children[0].innerText);
                    });
                } else {
                    alert('error');
                }
            });

            $('.ic-delete-video').click(function () {

            });
        });
    </script>
@stop