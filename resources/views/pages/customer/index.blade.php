@extends('layouts.default')
@section('content')
    <div class="col-sm-12 col-md-12">
        <div class="table-section playlist-m">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width: 35px;">ID</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Role') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- class="active-tr" -->
                    @foreach($users as $item)
                        <tr class="tbl_row" data-id="{{ $item->id }}">
                            <td style="text-align: center;">{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>@if($item->role == 1) Admin @else Customer @endif</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!--table-responsive-->
        </div><!--table-section-->
    </div><!--col-12-->

    <form id="login_customer" method="post" action="customer/login">
        {{ csrf_field() }}
        <input type="hidden" id="id" name="id" value="0">
    </form>

    <div class="bottom-btns project-list-btns">
        <a href="register" class="save-btn ic-save"><span>{{ __('Add Customer') }}</span></a>
        <a href="javascript:void(0);" class="del-video-btn ic-delete-video"><span>{{ __('Delete Customer') }}</span></a>
    </div>

    <script>
        $(function() {
            $('.tbl_row').click(function() {
                $('.tbl_row').removeClass('active-tr');
                $(this).addClass('active-tr');
            });

            $('.tbl_row').dblclick(function() {
                var id = $(this).data('id');

                $('#id').val(id);
                $('#login_customer').submit();
            });

            $('.ic-delete-video').click(function () {
                if ($('tbody>tr').hasClass('active-tr')) {
                    $('.active-tr').each(function(index, value) {
                        swal({
                            title: "Customer",
                            text: "{{ __('Do you really want to delete this?') }}",
                            icon: "error",
                            buttons: true,
                            dangerMode: true
                        }).then(function(result) {
                            if (result) {
                                waitingDialog.show();

                                $('#id').val(value.children[0].innerText);

                                $.get('/customer/destroy/' + value.children[0].innerText,  function (response) {
                                    waitingDialog.hide();
                                    if (response.result == 'success') {
                                        $('tr[data-id="' + response.id + '"]').remove();
                                        swal("Customer", "{{ __('Customer successfully deleted') }}", "success");
                                    } else {
                                        swal("Customer", "{{ __('Deleting customer failed') }}", "error");
                                    }
                                });
                            }
                        });
                    });
                } else {
                    swal("{{ __('Please select customer to delete') }}",{
                        icon:"error",
                    });
                }
            });
        });
    </script>
@stop