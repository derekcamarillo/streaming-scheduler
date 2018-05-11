@extends('layouts.default')
@section('content')
    <div class="col-sm-12 col-md-12">
        <div class="table-section playlist-m">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width: 35px;">ID</th>
                        <th>Video Clip</th>
                        <th>Message Type</th>
                        <th>Message</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- class="active-tr" -->
                    @foreach($videoclips as $item)
                        <tr class="tbl_row">
                            <td style="text-align: center;" data-id="{{ $item->id }}">{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>@if(isset($item->message)) {{ Config::get('constants.message_type.'.$item->message->effect) }} @endif</td>
                            <td><span>@if(isset($item->message)) {{ $item->message->text }} @endif</span></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!--table-responsive-->
        </div><!--table-section-->
    </div><!--col-12-->

    <form id="delete_videoclip" method="post" action="videoclip/destroy">
        {{ csrf_field() }}
        <input type="hidden" id="id" name="id" value="0">
    </form>

    <div class="bottom-btns project-list-btns">
        <a href="videoclip/create" class="save-btn ic-save"><span>Add Video Clip</span></a>
        <a href="javascript:void(0);" class="add-video-btn ic-edit-project"><span>Edit Video Clip</span></a>
        <a href="javascript:void(0);" class="del-video-btn ic-delete-video"><span>Delete Video Clip</span></a>
    </div>

    <script>
        $(function() {
            $('.tbl_row').click(function() {
                $('.tbl_row').removeClass('active-tr');
                $(this).addClass('active-tr');
            });

            $('.ic-edit-project').click(function () {
                if ($('tbody>tr').hasClass('active-tr')) {
                    $('.active-tr').each(function(index, value) {
                        window.location.href = "{{ url('/videoclip/edit') }}/" + value.children[0].innerText;
                    });
                } else {
                    swal("Please select video clip to edit",{
                        icon:"error",
                    });
                }
            });

            $('.ic-delete-video').click(function () {
                if ($('tbody>tr').hasClass('active-tr')) {
                    $('.active-tr').each(function(index, value) {
                        swal({
                            title: "Video Clip",
                            text: "Do you really want to delete this?",
                            icon: "error",
                            buttons: true,
                            dangerMode: true
                        }).then(function(result) {
                            if (result) {
                                $('#id').val(value.children[0].innerText);

                                $.get('/videoclip/destroy/' + value.children[0].innerText,  function (response) {
                                    if (response.result == 'success') {
                                        $('td[data-id="' + response.id + '"]').parent().remove();
                                        swal("Video Clip", "Video clip successfully deleted", "success");
                                    } else {
                                        swal("Video Clip", "Deleting video clip failed", "error");
                                    }
                                });
                            }
                        });
                    });
                } else {
                    swal("Please select video clip to delete",{
                        icon:"error",
                    });
                }
            });
        });
    </script>
@stop