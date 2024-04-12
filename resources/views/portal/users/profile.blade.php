@extends('portal.layouts.main')
@section('title', 'Dashboard')
@section('css')
    <style>
        .panel-heading {
            display: flex;
            justify-content: center;
        }
        .panel-heading #avatar {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 100%;
            cursor: pointer;
            background: white
        }
    </style>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{ trans('messages.user.label.profile') }}</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <img id="avatar" src="{{ isset($user->avatar) ? $user->avatar : "https://www.minervastrategies.com/wp-content/uploads/2016/03/default-avatar.jpg" }}" alt="Flowers in Chania"> 
            </div>
            <div class="panel-body">
                <div class="row">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    <div class="col-lg-12">
                        <form role="form" name="user-form" class="form-transparent clearfix" method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input style="display: none" id="input-avatar" type="file" name="avatar" accept="image/*">
                            <div class="form-group">
                                <label>{{ trans('messages.user.label.name') }} <a style="color:red">*</a></label>
                                <input class="form-control" name="name" placeholder="{{ trans('messages.user.placeholder.name') }}" value="{{ $user->name }}">
                            </div>
                            <div class="form-group">
                                <label>{{ trans('messages.user.label.email') }} <a style="color:red">*</a></label>
                                <input class="form-control" name="email" disabled placeholder="{{ trans('messages.user.placeholder.email') }}" value="{{ $user->email }}">
                            </div>
                            <div class="form-group">
                                <label>{{ trans('messages.user.label.date_of_birth') }}</label>
                                <input type="date" class="form-control" name="date_of_birth" placeholder="{{ trans('messages.user.placeholder.date_of_birth') }}" value="{{ $user->date_of_birth }}">
                            </div>
                            <div class="form-group">
                                <label>{{ trans('messages.user.label.sex') }} <a style="color:red">*</a></label>
                                <select class="form-control" name="sex">
                                    <option value="1" {{ $user->sex === 1 ? "selected" : "" }} >{{ trans('messages.sex.male') }}</option>
                                    <option value="2" {{ $user->sex === 2 ? "selected" : "" }} >{{ trans('messages.sex.female') }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>{{ trans('messages.user.label.phone') }}</label>
                                <input class="form-control" name="phone" placeholder="{{ trans('messages.user.placeholder.phone') }}" value="{{ $user->phone }}">
                            </div>
                            <div class="form-group">
                                <label>{{ trans('messages.user.label.facebook') }}</label>
                                <input class="form-control" name="facebook_link" placeholder="{{ trans('messages.user.placeholder.facebook') }}" value="{{ $user->facebook_link }}">
                            </div>
                            {{-- <div class="form-group">
                                <label>{{ trans('messages.user.label.department') }} <a style="color:red">*</a></label>
                                <select class="form-control" name="department_id">
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" {{ $user->department_id === $department->id ? "selected" : "" }} >{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="form-group">
                                <label>{{ trans('messages.user.label.info') }}</label>
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#info" data-toggle="tab" aria-expanded="false">Vietnamese</a>
                                    </li>
                                    <li class="">
                                        <a href="#info_en" data-toggle="tab" aria-expanded="false">English</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="info">
                                        <textarea name="info" placeholder="Content....." class="form-control" id="editor" rows="10">{!! $user->info !!}</textarea>
                                    </div>
                                    <div class="tab-pane fade" id="info_en">
                                        <textarea name="info_en" placeholder="Content....." class="form-control" id="editor_en" rows="10">{!! $user->info_en !!}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div style="text-align: right">
                                <button type="submit" class="btn btn-default">{{ trans('messages.user.button.submit') }}</button>
                                <button type="reset" class="btn btn-default">{{ trans('messages.user.button.reset') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2"></div>
</div>
@endsection

@section('js')
    <script src="//cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            $("#avatar").click(function() {
                $("#input-avatar").click()
            })
            $("#input-avatar").on("change", function(e) {
                var tmppath = URL.createObjectURL(e.target.files[0]);
                $("#avatar").fadeIn("fast").attr('src',URL.createObjectURL(e.target.files[0]));
            })
            CKEDITOR.replace('editor', {
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
                height: '300'
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
                height: '300'
            });
        })
    </script>
@endsection
