@extends('portal.layouts.main')
@section('title', 'Dashboard')
@section('content')
@include('ckfinder::setup')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{ trans('messages.gallery.label.create') }}</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
        @endif
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form" name="user-form" class="form-transparent clearfix" enctype="multipart/form-data" method="POST" action="{{ route('galleries.store') }}">
                            @csrf
                            <div class="form-group">
                                <label>{{ trans('messages.gallery.label.title') }}</label>
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#title" data-toggle="tab" aria-expanded="false">Vietnamese</a>
                                    </li>
                                    <li class="">
                                        <a href="#title_en" data-toggle="tab" aria-expanded="false">English</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="title">
                                        <input class="form-control" name="title" placeholder="{{ trans('messages.gallery.label.title') }} ....." value="{{ old('title') }}">
                                    </div>
                                    <div class="tab-pane fade" id="title_en">
                                        <input class="form-control" name="title_en" placeholder="{{ trans('messages.gallery.label.title') }} ....." value="{{ old('title_en') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{ trans('messages.post.label.thumbnail') }}</label>
                                <div class="drop-region" onclick="document.getElementById('uploadImage').click()">
                                    <input name="thumbnail_url" id="uploadImage" type="file" style="display: none">
                                    <h4 class="text-center">Drop files here or click to upload</h4>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .drop-region {
        width: 400px;
        height: 250px;
        border: 2px dashed #028AF4 !important; 
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
    }
</style>
<script>
    $(document).ready(function() {
        $("#uploadImage").val(null);
        
        $('#uploadImage').on('change', function () {
            if (this.files && this.files[0]) {
                var image = $(this).parents(".drop-region");
                image.children('h4').remove();
                var reader = new FileReader();
                reader.onload = function (e) {
                    image.css('background-image', "url(" + e.target.result + ")");
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>
@endsection
