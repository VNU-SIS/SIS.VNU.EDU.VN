@extends('portal.layouts.main')
@section('title', 'Dashboard')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{ trans('messages.category.label.create') }}</h1>
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
                        <form role="form" name="user-form" class="form-transparent clearfix" method="POST"
                            action="{{ route('categories.store') }}">
                            @csrf
                            <div class="form-group">
                                <label>{{ trans('messages.category.label.name') }}</label>
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#name" data-toggle="tab" aria-expanded="false">Vietnamese</a>
                                    </li>
                                    <li class="">
                                        <a href="#name_en" data-toggle="tab" aria-expanded="false">English</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="name">
                                        <input class="form-control" name="name" placeholder="{{ trans('messages.category.label.name') }} ....." value="{{ old('name')}}" />
                                    </div>
                                    <div class="tab-pane fade" id="name_en">
                                        <input class="form-control" name="name_en" placeholder="{{ trans('messages.category.label.name') }} ....." value="{{ old('name_en')}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{ trans('messages.category.label.parent') }}</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0"></option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category['id'] }}">{!! $category['name'] !!}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>{{ trans('messages.category.label.description') }}</label>
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#description" data-toggle="tab" aria-expanded="false">Vietnamese</a>
                                    </li>
                                    <li class="">
                                        <a href="#description_en" data-toggle="tab" aria-expanded="false">English</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="description">
                                        <textarea name="description" placeholder="{{ trans('messages.category.label.description') }} ....." class="form-control" id="editor" rows="10">{{ old('description') }}</textarea>
                                    </div>
                                    <div class="tab-pane fade" id="description_en">
                                        <textarea name="description_en" placeholder="{{ trans('messages.category.label.description') }} ....." class="form-control" id="editor_en" rows="10">{{ old('description_en') }}</textarea>
                                    </div>
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
<script src="//cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script>
<script>
    $(document).ready(function() {
        CKEDITOR.replace('editor', {
            filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
            filebrowserImageUploadUrl: '{{ route('ckfinder_browser') . '?_token=' . csrf_token() }}',
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
        CKEDITOR.replace('editor_en', {
            filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
            filebrowserImageUploadUrl: '{{ route('ckfinder_browser') . '?_token=' . csrf_token() }}',
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
    });
</script>
@endsection
