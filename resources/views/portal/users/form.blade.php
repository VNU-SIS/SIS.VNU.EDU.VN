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
        <h1 class="page-header">Forms</h1>
    </div>
</div>
<div class="row">
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <img id="avatar" src="{{ isset($user[0]->avatar) ? $user[0]->avatar : "https://www.minervastrategies.com/wp-content/uploads/2016/03/default-avatar.jpg" }}" alt="Flowers in Chania"> 
            </div>
            <div class="panel-body">
                <form role="form" name="user-form" class="form-transparent clearfix" method="POST" action="{{ isset($user[0]) ? route('user.updateUser', $user[0]->id) : route('user.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>{{ trans('messages.user.label.name') }} <a style="color:red">*</a></label>
                                <input class="form-control" name="name" placeholder="{{ trans('messages.user.placeholder.name') }}" value="{{ isset($user[0]) ? $user[0]->name : old('name') }}">
                            </div>
                            <div class="form-group">
                                <label>{{ trans('messages.user.label.email') }} <a style="color:red">*</a></label>
                                <input class="form-control" name="email" placeholder="{{ trans('messages.user.placeholder.email') }}" value="{{ isset($user[0]) ? $user[0]->email : old('email') }}">
                            </div>
                            <div class="form-group">
                                <label>{{ trans('messages.user.label.password') }} <a style="color:red">*</a></label>
                                <input type="password" class="form-control" name="password" placeholder="{{ trans('messages.user.placeholder.password') }}" value="{{ old('password')}}">
                            </div>
                            <div class="form-group">
                                <label>{{ trans('messages.user.label.role') }} <a style="color:red">*</a></label>
                                <select class="form-control" name="role" value="{{ old('role')}}">
                                    <option value="{{ \App\Enums\DBConstant::TEACHER }}" {{ isset($user[0]) ? $user[0]->role === \App\Enums\DBConstant::TEACHER ? "selected" : "" : "" }}>{{ trans('messages.role.teacher') }}</option>
                                    <option value="{{ \App\Enums\DBConstant::TEACHER_POST }}" {{ isset($user[0]) ? $user[0]->role === \App\Enums\DBConstant::TEACHER_POST ? "selected" : "" : "" }}>{{ trans('messages.role.teacher_post') }}</option>
                                    <option value="{{ \App\Enums\DBConstant::SUPPER_ADMIN  }}" {{ isset($user[0]) ? $user[0]->role === \App\Enums\DBConstant::SUPPER_ADMIN ? "selected" : "" : "" }}>{{ trans('messages.role.sp_admin') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <input style="display: none" id="input-avatar" type="file" name="avatar" accept="image/*">
                            <div class="form-group">
                                <label>{{ trans('messages.user.label.date_of_birth') }}</label>
                                <input type="date" class="form-control" name="date_of_birth" placeholder="{{ trans('messages.user.placeholder.date_of_birth') }}" value="{{ isset($user[0]) ? $user[0]->date_of_birth : old('date_of_birth') }}">
                            </div>
                            <div class="form-group">
                                <label>{{ trans('messages.user.label.sex') }} <a style="color:red">*</a></label>
                                <select class="form-control" name="sex">
                                    <option value="1" {{ isset($user[0]) ? $user[0]->sex === 1 ? "selected" : "" : "" }} >{{ trans('messages.sex.male') }}</option>
                                    <option value="2" {{ isset($user[0]) ? $user[0]->sex === 2 ? "selected" : "" : "" }} >{{ trans('messages.sex.female') }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>{{ trans('messages.user.label.phone') }}</label>
                                <input class="form-control" name="phone" placeholder="{{ trans('messages.user.placeholder.phone') }}" value="{{ isset($user[0]) ? $user[0]->phone : old('phone') }}">
                            </div>
                            <div class="form-group">
                                <label>{{ trans('messages.user.label.facebook') }}</label>
                                <input class="form-control" name="facebook_link" placeholder="{{ trans('messages.user.placeholder.facebook') }}" value="{{ isset($user[0]) ? $user[0]->facebook_link : old("facebook_link") }}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group" id="structure-position">
                                <label>{{ trans('messages.user.label.structure') }} | <button id="btn-append-row" type="button" class="btn btn-info btn-sm"><i class="fa fa-plus-circle"></i></button></label>
                                @if (isset($user[0]))
                                    @foreach ($user as $key => $item)
                                        <div style="display: flex; flex-direction: row; margin-bottom: 10px">
                                            <select class="form-control" name="level[]" style="margin-right: 10px">
                                                <option value="">--- {{ trans('messages.user.label.structure') }} ----</option>
                                                @foreach ($levels as $level)
                                                    <option value="{{ $level->id }}" {{ isset($user[$key]) ? ($user[$key]->level_id === $level->id ? "selected" : "") : "" }}>{{ $level->title }}</option>
                                                @endforeach
                                            </select>
                                            <select class="form-control" name="position[]" style="margin-right: 10px">
                                                <option value="">--- {{ trans('messages.user.label.position') }} ----</option>
                                                @foreach ($positions as $position)
                                                    <option value="{{ $position->id }}" {{ isset($user[$key]) ? ($user[$key]->position_id === $position->id ? "selected" : "") : "" }}>{{ $position->name }}</option>
                                                @endforeach
                                            </select>
                                            <input class="form-control" name="display_order[]" type="number" style="margin-right: 10px;width: 15rem;" value="{{ isset($user[$key]) ? $user[$key]->display_order : 1 }}"/>
                                            <button type="button" class="btn-del-row btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </div>
                                    @endforeach
                                @else
                                    <div style="display: flex; flex-direction: row; margin-bottom: 10px">
                                        <select class="form-control" name="level[]" style="margin-right: 10px">
                                            <option value="">--- {{ trans('messages.user.label.structure') }} ----</option>
                                            @foreach ($levels as $level)
                                                <option value="{{ $level->id }}">{{ $level->title }}</option>
                                            @endforeach
                                        </select>
                                        <select class="form-control" name="position[]" style="margin-right: 10px">
                                            <option value="">--- {{ trans('messages.user.label.position') }} ----</option>
                                            @foreach ($positions as $position)
                                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn-del-row btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12">
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
                                        <textarea name="info" placeholder="Content....." class="form-control" id="editor" rows="10">{!! isset($user[0]) ? $user[0]->info : "" !!}</textarea>
                                    </div>
                                    <div class="tab-pane fade" id="info_en">
                                        <textarea name="info_en" placeholder="Content....." class="form-control" id="editor_en" rows="10">{!! isset($user[0]) ? $user[0]->info_en : "" !!}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div style="text-align: right">
                                <button type="submit" class="btn btn-default">{{ trans('messages.user.button.submit') }}</button>
                                <button type="reset" class="btn btn-default">{{ trans('messages.user.button.reset') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="row-append" style="display: none">
        <div style="display: flex; flex-direction: row; margin-bottom: 10px">
            <select class="form-control" name="level[]" style="margin-right: 10px">
                <option value="">--- {{ trans('messages.user.label.structure') }} ----</option>
                @foreach ($levels as $level)
                    <option value="{{ $level->id }}">{{ $level->title }}</option>
                @endforeach
            </select>
            <select class="form-control" name="position[]" style="margin-right: 10px">
                <option value="">--- {{ trans('messages.user.label.position') }} ----</option>
                @foreach ($positions as $position)
                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                @endforeach
            </select>
            <input class="form-control" name="display_order[]" type="number" style="margin-right: 10px" value="1"/>
            <button type="button" class="btn-del-row btn btn-danger"><i class="fa fa-trash"></i></button>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="//cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script>
<script>
    $(document).ready(function() {
        $("#btn-append-row").click(function() {
            $("#row-append").children().clone().appendTo("#structure-position");
        })

        $(document).on("click", ".btn-del-row", function() {
            const parent = $(this).parent()
            parent.remove()
        })

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