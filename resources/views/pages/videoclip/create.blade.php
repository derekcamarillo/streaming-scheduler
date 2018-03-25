@extends('layouts.default')
@section('content')
    <div class="row">
        <h1 class="titleh1" style="margin-bottom: 50px;">Create New Video Clip</h1>
        <div class="col-lg-4 emptyDiv">&nbsp;</div>
        <div class="col-lg-4 col-xs-12">
            <div class="row">
                <form role="form" action="create-videoclip-action" method="post">
                    {{ csrf_field() }}
                    <div class="col-lg-12 inputRow">
                        <input type="text" id="title" name="title" class="input" placeholder="Video Clip Title" required>
                    </div>
                    <div class="col-lg-12 inputRow">
                        <input type="text" id="url" name="url" class="input" placeholder="Video Clip URL" required>
                    </div>
                    <div class="col-lg-12 bottom-btns">
                        <button type="submit" style="height: 60px; color: #fff; font-size: 16px; border-radius: 4px; font-weight: 600; outline: none; display: inline-block;" class="btn add-video-btn"> Create </button>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 emptyDiv">&nbsp;</div>
        </div>
    </div><!--row-->
@stop