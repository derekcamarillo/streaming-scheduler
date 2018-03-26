@extends('layouts.default')
@section('content')
    <div class="row">
        <h1 class="titleh1">Create Project</h1>
        <div class="col-sm-12 select-box create-playlist">
            <div class="row edit-playlist-section">
                <div class="col-sm-5 col-md-5">

                    <!--
                    <select class="form-control" id="#">
                        <option>New Project</option>
                        <option>New Project 1</option>
                        <option>New Project 2</option>
                        <option>New Project 3</option>
                        <option>New Project 4</option>
                        <option>New Project 5</option>
                        <option>New Project 6</option>
                    </select>
                    -->
                </div><!--col-5-->
                <div class="col-sm-3 col-md-3 project-save-btn">
                    <a class="activate-playlist-button" href="#">
                        <span>Save</span>
                    </a>
                </div><!--col-3-->
            </div><!--row | edit-playlist-section-->
        </div><!--col-12-->
    </div><!--row-->
    <div class="col-sm-12 col-md-12">
        <div class="row">
            <div class="table-section project-list-section">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="video-clips-links">Project Name</th>
                            <th class="">Project URL</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="active-tr">
                            <td>Kulm Summer</td>
                            <td>customername\projectname\url-name.html</td>
                        </tr>
                        <tr>
                            <td>Kulm Winter</td>
                            <td>customername\projectname\url-name.html</td>
                        </tr>
                        <tr>
                            <td>Kulm Summer</td>
                            <td>customername\projectname\url-name.html</td>
                        </tr>
                        <tr>
                            <td>Kulm Winter</td>
                            <td>customername\projectname\url-name.html</td>
                        </tr>
                        <tr>
                            <td>Kulm Summer</td>
                            <td>customername\projectname\url-name.html</td>
                        </tr>
                        <tr>
                            <td>Kulm Winter</td>
                            <td>customername\projectname\url-name.html</td>
                        </tr>
                        <tr>
                            <td>Kulm Summer</td>
                            <td>customername\projectname\url-name.html</td>
                        </tr>
                        <tr>
                            <td>Kulm Winter</td>
                            <td>customername\projectname\url-name.html</td>
                        </tr>
                        <tr>
                            <td>Kulm Summer</td>
                            <td>customername\projectname\url-name.html</td>
                        </tr>
                        <tr>
                            <td>Kulm Winter</td>
                            <td>customername\projectname\url-name.html</td>
                        </tr>
                        <tr>
                            <td>Kulm Summer</td>
                            <td>customername\projectname\url-name.html</td>
                        </tr>
                        <tr>
                            <td>Kulm Winter</td>
                            <td>customername\projectname\url-name.html</td>
                        </tr>
                        <tr>
                            <td>Kulm Summer</td>
                            <td>customername\projectname\url-name.html</td>
                        </tr>
                        <tr>
                            <td>Kulm Winter</td>
                            <td>customername\projectname\url-name.html</td>
                        </tr>
                        <tr>
                            <td>Kulm Summer</td>
                            <td>customername\projectname\url-name.html</td>
                        </tr>
                        <tr>
                            <td>Kulm Winter</td>
                            <td>customername\projectname\url-name.html</td>
                        </tr>
                        <tr>
                            <td>Kulm Summer</td>
                            <td>customername\projectname\url-name.html</td>
                        </tr>
                        <tr>
                            <td>Kulm Winter</td>
                            <td>customername\projectname\url-name.html</td>
                        </tr>
                        <tr>
                            <td>Kulm Summer</td>
                            <td>customername\projectname\url-name.html</td>
                        </tr>
                        <tr>
                            <td>Kulm Winter</td>
                            <td>customername\projectname\url-name.html</td>
                        </tr>
                        <tr>
                            <td>Kulm Summer</td>
                            <td>customername\projectname\url-name.html</td>
                        </tr>
                        <tr>
                            <td>Kulm Winter</td>
                            <td>customername\projectname\url-name.html</td>
                        </tr>
                        </tbody>
                    </table>
                </div><!--table-responsive-->
            </div><!--table-section-->
        </div><!--row-->
    </div><!--col-12-->
    <div class="bottom-btns project-list-btns">
        <a href="#" class="add-video-btn ic-edit-project"><span>Edit Selected Project</span></a>
        <a href="#" class="del-video-btn ic-delete-video"><span>Delete Selected Project</span></a>
        <a href="#" class="save-btn ic-save"><span>Save Changes</span></a>
    </div>
@stop