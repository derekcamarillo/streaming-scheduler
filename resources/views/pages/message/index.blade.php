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
                    <!-- class="active-tr" -->
                    @foreach($messages as $item)
                        <tr class="tbl_row">
                            <td style="text-align: center;" data-id="{{ $item->id }}">{{ $item->id }}</td>
                            <td><span style="width: 400px !important;">{{ $item->text }}</span></td>
                            <td>{{ Config::get('constants.message_type.'.$item->effect) }}</td>
                        </tr>
                    @endforeach
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

            $('.ic-edit-project').click(function () {
                if ($('tbody>tr').hasClass('active-tr')) {
                    $('.active-tr').each(function(index, value) {
                        window.location.href = "{{ url('/message/edit') }}/" + value.children[0].innerText;
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
                        swal({
                            title: "Message",
                            text: "{{ __('Do you really want to delete this?') }}",
                            icon: "error",
                            buttons: true,
                            dangerMode: true
                        }).then(function(result) {
                            if (result) {
                                waitingDialog.show();

                                $('#id').val(value.children[0].innerText);

                                $.get('/message/destroy/' + value.children[0].innerText,  function (response) {
                                    waitingDialog.hide();
                                    if (response.result == 'success') {
                                        $('td[data-id="' + response.id + '"]').parent().remove();
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