@extends('layouts.default')
@section('content')
    <div class="col-sm-12 col-md-12">
        <div class="table-section playlist-m">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width: 35px;">NO</th>
                        <th>{{ __('Video Clip') }}</th>
                        <th>{{ __('Message Type') }}</th>
                        <th>{{ __('Message') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- class="active-tr" -->
                    @for($i = 0; $i < sizeof($videoclips); $i++)
                        <tr class="tbl_row" data-id="{{ $videoclips[$i]->id }}">
                            <td style="text-align: center;">{{ $i + 1 }}</td>
                            <td>{{ $videoclips[$i]->title }}</td>
                            <td>@if(isset($videoclips[$i]->message)) {{ Config::get('constants.message_type.'.$videoclips[$i]->message->effect) }} @endif</td>
                            <td><span>@if(isset($videoclips[$i]->message)) {{ $videoclips[$i]->message->text }} @endif</span></td>
                        </tr>
                    @endfor
                    <!--
                    @foreach($videoclips as $item)
                        <tr class="tbl_row">
                            <td style="text-align: center;" data-id="{{ $item->id }}">{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>@if(isset($item->message)) {{ Config::get('constants.message_type.'.$item->message->effect) }} @endif</td>
                            <td><span>@if(isset($item->message)) {{ $item->message->text }} @endif</span></td>
                        </tr>
                    @endforeach
                    -->
                    </tbody>
                </table>
            </div><!--table-responsive-->
        </div><!--table-section-->
    </div><!--col-12-->

    <form id="delete_videoclip" method="post" action="videoclip/destroy">
        {{ csrf_field() }}
        <input type="hidden" id="id" name="id" value="0">
    </form>

    <form id="form_csv" action="{{ url('/videoclip/import') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="file" id="csv" name="csv" style="display: none;" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
    </form>

    <div class="bottom-btns project-list-btns">
        <a href="videoclip/create" class="save-btn ic-save"><span>{{ __('Add Video Clip') }}</span></a>
        <a href="javascript:void(0);" class="add-video-btn ic-edit-project"><span>{{ __('Edit Video Clip') }}</span></a>
        <a href="javascript:void(0);" class="del-video-btn ic-delete-video"><span>{{ __('Delete Video Clip') }}</span></a>
    </div>

    <div class="bottom-btns project-list-btns">
        <a href="javascript:void(0);" class="add-video-btn" onclick="importVideoclips()"><span>{{ __('CSV Import Videoclips') }}</span></a>
        <a href="videoclip/export" class="add-video-btn"><span>{{ __('CSV Export Videoclips') }}</span></a>
        <a href="javascript:void(0);" class="add-video-btn" onclick="clearVideoclips()"><span>{{ __('Clear Videoclips') }}</span></a>
    </div>

    <script>

        @if (Session::has('videoclip.import.success'))
            swal("Import", "{{ Session::get('videoclip.import.success') }}", "success");
        @elseif(Session::has('videoclip.import.error'))
            swal("Import", "{{ Session::get('videoclip.import.error') }}", "error");
        @endif

        function importVideoclips() {
            $('#csv').click();
        }

        function clearVideoclips() {
            swal({
                title: "Video Clip",
                text: "{{ __('Do you really want to clear videoclips?') }}",
                icon: "error",
                buttons: true,
                dangerMode: true
            }).then(function(result) {
                if (result) {
                    waitingDialog.show();

                    $.get('/videoclip/clear',  function (response) {
                        waitingDialog.hide();

                        if (response.result == 'success') {
                            $('.tbl_row').remove();
                            swal("Video Clip", "Video clip successfully cleared", "success");
                        } else {
                            swal("Video Clip", "Clear video clip failed", "error");
                        }
                    });
                }
            });
        }

        $(function() {
            $("#csv").change(function() {
                waitingDialog.show();

                $('#form_csv').submit();
            });

            $('.tbl_row').click(function() {
                $('.tbl_row').removeClass('active-tr');
                $(this).addClass('active-tr');
            });

            $('.tbl_row').dblclick(function() {
                window.location.href = "{{ url('/videoclip/edit') }}/" + $(this).data('id');
            });

            $('.ic-edit-project').click(function () {
                if ($('tbody>tr').hasClass('active-tr')) {
                    $('.active-tr').each(function(index, value) {
                        window.location.href = "{{ url('/videoclip/edit') }}/" + $(this).data('id');
                    });
                } else {
                    swal("{{ __('Please select video clip to edit') }}",{
                        icon:"error",
                    });
                }
            });

            $('.ic-delete-video').click(function () {
                if ($('tbody>tr').hasClass('active-tr')) {
                    $('.active-tr').each(function(index, value) {
                        var id = $(this).data('id');

                        swal({
                            title: "Video Clip",
                            text: "{{ __('Do you really want to delete this?') }}",
                            icon: "error",
                            buttons: true,
                            dangerMode: true
                        }).then(function(result) {
                            if (result) {
                                $('#id').val(id);

                                $.get('/videoclip/destroy/' + id,  function (response) {
                                    if (response.result == 'success') {
                                        $('tr[data-id="' + response.id + '"]').remove();
                                        swal("Video Clip", "Video clip successfully deleted", "success");
                                    } else {
                                        swal("Video Clip", "Deleting video clip failed", "error");
                                    }
                                });
                            }
                        });
                    });
                } else {
                    swal("{{ __('Please select video clip to delete') }}",{
                        icon:"error",
                    });
                }
            });
        });
    </script>
@stop