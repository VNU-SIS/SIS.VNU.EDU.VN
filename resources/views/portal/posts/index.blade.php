@php $user = Auth::user(); @endphp
@extends('portal.layouts.main')
@section('title', 'Post')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{ trans('messages.post.label.list') }}</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            {{-- <div class="panel-heading">
                DataTables Advanced Tables
            </div> --}}
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th width="50">#</th>
                                <th width="200">{{ trans('messages.post.label.title') }} (Vi)</th>
                                <th width="200">{{ trans('messages.post.label.title') }} (En)</th>
                                <th width="100">{{ trans('messages.post.label.category') }} (Vi)</th>
                                <th width="100">{{ trans('messages.post.label.category') }} (En)</th>
                                <th width="200">{{ trans('messages.post.label.thumbnail') }}</th>
                                <th>{{ trans('messages.post.label.content') }} (Vi)</th>
                                <th>{{ trans('messages.post.label.content') }} (En)</th>
                                <th>{{ trans('messages.created_by') }}</th>
                                <th width="100">{{ trans('messages.options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $key => $post)
                            <tr class="odd gradeX">
                                <td style="text-align: center;">{{ $key + 1 }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->title_en }}</td>
                                <td>
                                    @if ($post->category)
                                        {{ $post->category->name }}
                                    @endif
                                </td>
                                <td>
                                    @if ($post->category)
                                        {{ $post->category->name_en }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    <img style="width: 100%" src="{{ asset($post->thumbnail_url) }}">
                                </td>
                                <td class="text-left">
                                    <div class="content">{!! Str::limit(strip_tags($post->content), $limit = 1000, $end = '...') !!}</div>
                                </td>
                                <td class="text-left">
                                    <div class="content">{!! Str::limit(strip_tags($post->content_en), $limit = 1000, $end = '...') !!}</div>
                                </td>
                                <td class="text-left">
                                    @if ($post->user)
                                        {{ $post->user->name }}
                                    @endif
                                </td>
                                <td class="text-center d-flex">
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info btn-sm">
                                        @if($user->role==2)
                                        <i class="fa fa-pencil"></i>
                                        @endif
                                        @if($user->role!=2)
                                        <i class="fas fa-eye"></i>
                                        @endif
                                    </a>
                                    @if($user->role==2)
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline-block" onsubmit="if(!confirm('Bạn có chắc chắn xóa bài viết này không?')){return false;}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </form>
                                    @endif
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
<style>
    .content {
        max-height: 200px;
        word-break: break-word;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
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
