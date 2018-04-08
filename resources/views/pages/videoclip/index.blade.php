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
                            <td style="text-align: center;">{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->message->effect }}</td>
                            <td>{{ $item->message->text }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!--table-responsive-->
        </div><!--table-section-->
    </div><!--col-12-->

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