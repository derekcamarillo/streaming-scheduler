@extends('layouts.default')
@section('content')
    <div class="col-sm-12 col-md-12">
        <div class="table-section playlist-m">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width: 35px;">ID</th>
                        <th>Logo Url</th>
                        <th>Position</th>
                        <th>X Offset</th>
                        <th>Y Offset</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- class="active-tr" -->
                    @foreach($logos as $item)
                        <tr class="tbl_row">
                            <td style="text-align: center;">{{ $item->id }}</td>
                            <td>{{ $item->url }}</td>
                            <td>{{ Config::get('constants.logo_type.'.$item->position) }}</td>
                            <td>{{ $item->xPosition }}</td>
                            <td>{{ $item->yPosition }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!--table-responsive-->
        </div><!--table-section-->
    </div><!--col-12-->

    <div class="bottom-btns project-list-btns">
        <a href="logo/create" class="save-btn ic-save"><span>Add Message</span></a>
        <a href="javascript:void(0);" class="add-video-btn ic-edit-project"><span>Edit Message</span></a>
        <a href="javascript:void(0);" class="del-video-btn ic-delete-video"><span>Delete Message</span></a>
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
                        window.location.href = "{{ url('/logo/edit') }}/" + value.children[0].innerText;
                    });
                } else {
                    swal("Please select video clip to edit",{
                        icon:"error",
                    });
                }
            });

            $('.ic-delete-video').click(function () {

            });
        });
    </script>
@stop