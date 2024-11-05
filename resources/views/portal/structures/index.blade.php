@extends('portal.layouts.main')
@section('title', 'Portal')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{ trans('messages.departments.label.department_list') }}</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <p>Bộ phận</p>
            </div>
            <div class="panel-body" style="height: 70vh; overflow-y: auto;">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <tbody>
                            @foreach ($levels as $key => $level)
                                <tr class="odd gradeX">
                                    <td>
                                        <a href="{{ route('structures.list') . "?level=" . $level->id }}">
                                            <div style="display: flex; flex-direction: row; justify-content: space-between; line-height: 30px;">
                                                {{ $level->title }}
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading" style="display: flex; flex-direction: row; justify-content: space-between;">
                <p>Nhân sự</p>
                <button id="btn-update-structure" data-url="{{ route("structures.update") }}" type="button" class="btn btn-default">{{ trans('messages.departments.button.submit') }}</button>
            </div>
            <div class="panel-body" style="height: 70vh; overflow-y: auto;">
                <div class="dataTable_wrapper">
                    <table id="tblLocations" cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered table-hover">
                        <tr>
                            <th>#</th>
                            <th>{{ trans('messages.user.label.name') }}</th>
                            <th>{{ trans('messages.user.label.email') }}</th>
                            <th>{{ trans('messages.user.label.role') }}</th>
                        </tr>
                        @foreach ($users as $key => $user)
                            <tr class="odd gradeX" id="{{ $user->id }}" style="cursor: pointer">
                                <td style="text-align: center;">{{ $key + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="center" style="text-align: center;">
                                    {{ $user->role === \App\Enums\DBConstant::TEACHER 
                                        ? trans('messages.role.teacher') 
                                        :  trans('messages.role.sp_admin') }}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <input style="display: none" type="none" value="{{ Request::get('level') }}" id="level_id">
</div>
@endsection

@section('js')
<script type="text/javascript">
    jQuery.browser = {};
    $(function () {
        jQuery.browser.msie = false;
        jQuery.browser.version = 0;
        if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
            jQuery.browser.msie = true;
            jQuery.browser.version = RegExp.$1;
        }
        $("#tblLocations").sortable({
            items: 'tr:not(tr:first-child)',
            cursor: 'pointer',
            axis: 'y',
            dropOnEmpty: false,
            start: function (e, ui) {
                ui.item.addClass("selected");
            },
            stop: function (e, ui) {
                ui.item.removeClass("selected");
                // $(this).find("tr").each(function (index) {
                //     if (index > 0) {
                //         $(this).find("td").eq(2).html(index);
                //     }
                // });
            }
        });
    });
    $(document).on("click", "#btn-update-structure", function() {
        const _this = $(this)
        const url = _this.attr('data-url');
        const itemOrder = $('#tblLocations').sortable("toArray");
        const level_id = $("#level_id").val()

        $.ajax({
        url: url,
        type: 'POST',
        data: {
            itemOrder: itemOrder,
            level_id: level_id
        }
        }).done(function(res) {
            console.log(res);
            location.reload();
        });
    })
</script>
@endsection
@section('css')
<style type="text/css">
    table th, table td
    {
        width: 100px;
        padding: 5px;
        border: 1px solid #ccc;
    }
    .selected
    {
        background-color: #666;
        color: #fff;
    }
</style>
@endsection