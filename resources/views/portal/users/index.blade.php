@extends('portal.layouts.main')
@section('title', 'Dashboard')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{ trans('messages.user.label.user_list') }}</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                @if (Auth::user()->role === \App\Enums\DBConstant::SUPPER_ADMIN )
                    <a href="{{ route('user.create') }}">+ Thêm nhân sự</a>
                @endif
            </div>
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('messages.user.label.name') }}</th>
                                <th>{{ trans('messages.user.label.email') }}</th>
                                <th>{{ trans('messages.user.label.role') }}</th>
                                @if (Auth::user()->role === \App\Enums\DBConstant::SUPPER_ADMIN )
                                    <th>{{ trans('messages.user.label.option') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr class="odd gradeX">
                                    <td style="text-align: center;">{{ $key + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td class="center" style="text-align: center;">
                                        {{ $user->role === \App\Enums\DBConstant::TEACHER 
                                            ? trans('messages.role.teacher') 
                                            :  ($user->role === \App\Enums\DBConstant::TEACHER_POST 
                                            ? trans('messages.role.teacher_post')
                                            : trans('messages.role.sp_admin')) }}
                                    </td>
                                    @if (Auth::user()->role === \App\Enums\DBConstant::SUPPER_ADMIN)
                                        <td class="center" style="text-align: center;">
                                            {{-- <a href="#" class="btn btn-primary btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </a> --}}
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-info btn-sm">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <form action="{{ route('user.delete', $user->id) }}" method="POST" style="display: inline-block" onsubmit="if(!confirm('Bạn có chắc chắn xóa người dùng này không?')){return false;}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true,
            "language": {
                "decimal":        "",
                "emptyTable":     "Không có dữ liệu trong bảng",
                "info":           "Hiển thị _START_ đến _END_ trong số _TOTAL_ mục nhập",
                "infoEmpty":      "Hiển thị 0 đến 0 trong số 0 mục nhập",
                "infoFiltered":   "(được lọc từ _MAX_ tổng số mục nhập)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "Hiển thị _MENU_ mục",
                "loadingRecords": "Đang tải...",
                "processing":     "Xử lý...",
                "search":         "Tìm kiếm:",
                "zeroRecords":    "Không tìm thấy kết quả",
                "paginate": {
                    "first":      "Đầu",
                    "last":       "Cuối",
                    "next":       "Tiếp",
                    "previous":   "Trước"
                },
                "aria": {
                    "sortAscending":  ": kích hoạt để sắp xếp cột tăng dần",
                    "sortDescending": ": kích hoạt để sắp xếp cột giảm dần"
                }
            }
        });
    });
</script>
@endsection
