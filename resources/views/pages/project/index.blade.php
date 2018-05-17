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
                            <th>Project URL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- class="active-tr" -->
                        @foreach($projects as $item)
                            <tr class="tbl_row" data-id="{{ $item->id }}">
                                <td style="text-align: center;">{{ $item->id }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ url('project/url/'.$item->url) }}</td>
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
                if ($('tbody>tr').hasClass('active-tr')) {
                    $('.active-tr').each(function(index, value) {
                        swal({
                            title: "Project",
                            text: "Do you really want to delete this?",
                            icon: "error",
                            buttons: true,
                            dangerMode: true
                        }).then(function(result) {
                            if (result) {
                                $('#id').val(value.children[0].innerText);

                                $.get('/project/destroy/' + value.children[0].innerText,  function (response) {
                                    if (response.result == 'success') {
                                        $('tr[data-id="' + response.id + '"]').remove();
                                        swal("Project", "Playlist successfully deleted", "success");
                                    } else {
                                        swal("Project", "Deleting playlist failed", "error");
                                    }
                                });
                            }
                        });
                    });
                } else {
                    swal("Please select project to delete",{
                        icon:"error",
                    });
                }
            });
        });
    </script>
@stop