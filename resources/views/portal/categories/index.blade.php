@extends('portal.layouts.main')
@section('title', 'Post')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{ trans('messages.category.label.list') }}</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('messages.category.label.name') }} (Vi)</th>
                                <th>{{ trans('messages.category.label.name') }} (En)</th>
                                <th>{{ trans('messages.category.label.parent') }}</th>
                                <th>{{ trans('messages.category.label.description') }} (Vi)</th>
                                <th>{{ trans('messages.category.label.description') }} (En)</th>
                                <th>{{ trans('messages.options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key => $category)
                            <tr class="odd gradeX">
                                <td style="text-align: center;">{{ $key + 1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->name_en }}</td>
                                <td class="text-center">
                                    @if ($category->category)
                                        {{ $category->category->name }}
                                    @endif
                                </td>
                                <td>{!! Str::limit(strip_tags($category->description), $limit = 1000, $end = '...') !!}</td>
                                <td>{!! Str::limit(strip_tags($category->description_en), $limit = 1000, $end = '...') !!}</td>
                                <td class="text-center d-flex">
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline-block"  onsubmit="if(!confirm('Bạn có chắc chắn xóa danh mục này không?')){return false;}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </form>
                                </td>
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
