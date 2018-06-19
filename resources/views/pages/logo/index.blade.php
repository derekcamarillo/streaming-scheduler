@extends('layouts.default')
@section('content')
    <div class="col-sm-12 col-md-12">
        <div class="table-section playlist-m">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width: 35px;">ID</th>
                        <th>{{ __('Logo Url') }}</th>
                        <th>{{ __('Position') }}</th>
                        <th>{{ __('X Offset') }}</th>
                        <th>{{ __('Y Offset') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- class="active-tr" -->
                        @for($i = 0; $i < sizeof($logos); $i++)
                            <tr class="tbl_row" data-id="{{ $logos[$i]->id }}">
                                <td style="text-align: center;">{{ $i + 1 }}</td>
                                <td><span>{{ $logos[$i]->url }}</span></td>
                                <td>{{ Config::get('constants.logo_type.'.$logos[$i]->position) }}</td>
                                <td>{{ $logos[$i]->xpos }}</td>
                                <td>{{ $logos[$i]->ypos }}</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div><!--table-responsive-->
        </div><!--table-section-->
    </div><!--col-12-->

    <div class="bottom-btns project-list-btns">
        <a href="{{ url('/logo/create') }}" class="save-btn ic-save"><span>{{ __('Add Logo') }}</span></a>
        <a href="javascript:void(0);" class="add-video-btn ic-edit-project"><span>{{ __('Edit Logo') }}</span></a>
        <a href="javascript:void(0);" class="del-video-btn ic-delete-video"><span>{{ __('Delete Logo') }}</span></a>
    </div>

    <script>
        $(function() {
            $('.tbl_row').click(function() {
                $('.tbl_row').removeClass('active-tr');
                $(this).addClass('active-tr');
            });

            $('.tbl_row').dblclick(function() {
                window.location.href = "{{ url('/logo/edit') }}/" + $(this).data('id');
            });

            $('.ic-edit-project').click(function () {
                if ($('tbody>tr').hasClass('active-tr')) {
                    $('.active-tr').each(function(index, value) {
                        window.location.href = "{{ url('/logo/edit') }}/" + $(this).data('id');
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
                            title: "Logo",
                            text: "{{ __('Do you really want to delete this?') }}",
                            icon: "error",
                            buttons: true,
                            dangerMode: true
                        }).then(function(result) {
                            if (result) {
                                $('#id').val(id);

                                $.get('/logo/destroy/' + id,  function (response) {
                                    if (response.result == 'success') {
                                        $('tr[data-id="' + response.id + '"]').remove();
                                        swal("Logo", "{{ __('Logo successfully deleted') }}", "success");
                                    } else {
                                        swal("Logo", "{{ __('Deleting logo failed') }}", "error");
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