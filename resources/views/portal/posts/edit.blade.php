@php $user = Auth::user(); @endphp
@extends('portal.layouts.main')
@section('title', 'Dashboard')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{ trans('messages.post.label.edit') }}</h1>
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
                        <form role="form" name="user-form" class="form-transparent clearfix" enctype="multipart/form-data" method="POST" action="{{ route('posts.update', $post->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>{{ trans('messages.post.label.title') }}</label>
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
                                        <input class="form-control" name="title" placeholder="{{ trans('messages.post.label.title') }} ....." value="{{ $post->title }}">
                                    </div>
                                    <div class="tab-pane fade" id="title_en">
                                        <input class="form-control" name="title_en" placeholder="{{ trans('messages.post.label.title') }} ....." value="{{ $post->title_en }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{ trans('messages.post.label.category') }}</label>
                                <select class="form-control" name="category_id">
                                    @foreach ($categories as $category)
                                        @if ($category['id'] === $post->category_id)
                                            <option selected value="{{ $category['id'] }}">{!! $category['name'] !!}</option>
                                        @else
                                            <option value="{{ $category['id'] }}">{!! $category['name'] !!}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>{{ trans('messages.post.label.updated_at') }}</label>
                                <input type="date" class="form-control" name="updated_at" placeholder="{{ trans('messages.post.placeholder.updated_at') }}" value="{{ date('Y-m-d', strtotime($post->updated_at)) }}">
                            </div>
                            <div class="form-group">
                                <label>{{ trans('messages.post.label.event_at') }}</label>
                                <input type="date" class="form-control" name="event_at" placeholder="{{ trans('messages.post.placeholder.event_at') }}" value="{{ $post->event_at }}">
                            </div>
                            <div class="form-group">
                                <label>{{ trans('messages.post.label.thumbnail') }}</label>
                                <div class="drop-region" onclick="document.getElementById('uploadImage').click()" style="background-image: url('{{ asset($post->thumbnail_url) }}');">
                                    <input name="thumbnail_url" id="uploadImage" type="file" style="display: none">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{ trans('messages.post.label.content') }}</label>
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#content" data-toggle="tab" aria-expanded="false">Vietnamese</a>
                                    </li>
                                    <li class="">
                                        <a href="#content_en" data-toggle="tab" aria-expanded="false">English</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="content">
                                        <textarea name="content" placeholder="{{ trans('messages.post.label.content') }} ....." class="form-control" id="editor" rows="10">{!! $post->content !!}</textarea>
                                    </div>
                                    <div class="tab-pane fade" id="content_en">
                                        <textarea name="content_en" placeholder="{{ trans('messages.post.label.content') }} ....." class="form-control" id="editor_en" rows="10">{!! $post->content_en !!}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <label class="radio-inline">
                                    <input name="status" value="1"  {{ $post->status==1?'checked':'' }} type="radio">Đăng
                                </label>
                                <label class="radio-inline">
                                    <input name="status" value="0"  {{ $post->status==0?'checked':'' }} type="radio">Lưu nháp
                                </label>
                            </div>
                            @if($user->role==2)
                            <button type="submit" class="btn btn-default">Submit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                            @endif
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
{{-- <script src="//cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script> --}}
<script src="//cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script>
<script>
    $(document).ready(function() {
        $("#uploadImage").val(null);
        
        CKEDITOR.replace('editor', {
            filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
            toolbarGroups: [
                { name: 'document', groups: [ 'Source', 'mode', 'document', 'doctools' ] },
                { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
                { name: 'styles', groups: [ 'styles' ] },
                { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
                { name: 'forms', groups: [ 'forms' ] },
                { name: 'colors', groups: [ 'colors' ] },
                { name: 'tools', groups: [ 'tools' ] },
                '/',
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
                { name: 'links', groups: [ 'links' ] },
                { name: 'insert', groups: [ 'insert', 'Iframe' ] },
                '/',
                { name: 'others', groups: [ 'others' ] },
                { name: 'about', groups: [ 'about' ] }
            ],
            removeButtons: 'Source,Save,Templates,NewPage,ExportPdf,Preview,Print,Find,Replace,SelectAll,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,CreateDiv,PageBreak,ShowBlocks,About,Smiley,Anchor',
            editorplaceholder: 'Type your content...',
            height: '500'
        });

        CKEDITOR.replace('editor_en', {
            filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
            toolbarGroups: [
                { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
                { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
                { name: 'styles', groups: [ 'styles' ] },
                { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
                { name: 'forms', groups: [ 'forms' ] },
                { name: 'colors', groups: [ 'colors' ] },
                { name: 'tools', groups: [ 'tools' ] },
                '/',
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
                { name: 'links', groups: [ 'links' ] },
                { name: 'insert', groups: [ 'insert' ] },
                '/',
                { name: 'others', groups: [ 'others' ] },
                { name: 'about', groups: [ 'about' ] }
            ],
            removeButtons: 'Source,Save,Templates,NewPage,ExportPdf,Preview,Print,Find,Replace,SelectAll,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,CreateDiv,PageBreak,Iframe,ShowBlocks,About,Smiley,Anchor',
            editorplaceholder: 'Type your content...',
            height: '500'
        });
        
        $('#uploadImage').on('change', function () {
            if (this.files && this.files[0]) {
                var image = $(this).parents(".drop-region");
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
