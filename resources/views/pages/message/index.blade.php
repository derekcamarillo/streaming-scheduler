@extends('layouts.default')
@section('content')
    <div class="col-sm-12 col-md-12">
        <div class="table-section playlist-m">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width: 35px;">ID</th>
                        <th>{{ __('Message Content') }}</th>
                        <th>{{ __('Message Effect') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($i = 0; $i < sizeof($messages); $i++)
                        <tr class="tbl_row" data-id="{{ $messages[$i]->id }}">
                            <td style="text-align: center;">{{ $i + 1 }}</td>
                            <td><span style="width: 400px !important;">{{ $messages[$i]->text }}</span></td>
                            <td>{{ Config::get('constants.message_type.'.$messages[$i]->effect) }}</td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
            </div><!--table-responsive-->
        </div><!--table-section-->
    </div><!--col-12-->

    <div class="bottom-btns project-list-btns">
        <a href="message/create" class="save-btn ic-save"><span>{{ __('Add Message') }}</span></a>
        <a href="javascript:void(0);" class="add-video-btn ic-edit-project"><span>{{ __('Edit Message') }}</span></a>
        <a href="javascript:void(0);" class="del-video-btn ic-delete-video"><span>{{ __('Delete Message') }}</span></a>
    </div>

    <script>
        $(function() {
            $('.tbl_row').click(function() {
                $('.tbl_row').removeClass('active-tr');
                $(this).addClass('active-tr');
            });

            $('.tbl_row').dblclick(function() {
                window.location.href = "{{ url('/message/edit') }}/" + $(this).data('id');
            });

            $('.ic-edit-project').click(function () {
                if ($('tbody>tr').hasClass('active-tr')) {
                    $('.active-tr').each(function(index, value) {
                        window.location.href = "{{ url('/message/edit') }}/" + $(this).data('id');
                    });
                } else {
                    swal("{{ __('Please select message to edit') }}",{
                        icon:"error",
                    });
                }
            });

            $('.ic-delete-video').click(function () {
                if ($('tbody>tr').hasClass('active-tr')) {
                    $('.active-tr').each(function(index, value) {
                        var id = $(this).data('id');
                        swal({
                            title: "Message",
                            text: "{{ __('Do you really want to delete this?') }}",
                            icon: "error",
                            buttons: true,
                            dangerMode: true
                        }).then(function(result) {
                            if (result) {
                                waitingDialog.show();

                                $('#id').val(id);

                                $.get('/message/destroy/' + id,  function (response) {
                                    waitingDialog.hide();
                                    if (response.result == 'success') {
                                        $('tr[data-id="' + response.id + '"]').remove();
                                        swal("Message", "{{ __('Message successfully deleted') }}", "success");
                                    } else {
                                        swal("Message", "{{ __('Deleting Message failed') }}", "error");
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