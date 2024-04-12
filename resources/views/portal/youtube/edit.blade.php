@extends('portal.layouts.main')
@section('title', 'Dashboard')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{ trans('messages.youtube.label.edit') }}</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        @if ($errors->any())
          <div class="alert alert-danger">
              {{ $errors->first() }}
          </div>
        @endif
        @if(Session::has('error'))
        <div class="alert alert-danger">
            {{session::get('error')}}
        </div>
        @endif

        @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
        @endif
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form" name="user-form" class="form-transparent clearfix" method="POST" action="{{ route('youtube.update') }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>{{ trans('messages.youtube.label.link') }}</label>
                                <input class="form-control" name="link" placeholder="{{ trans('messages.youtube.label.link') }} ....." value="{{ isset($youtube[0])?$youtube[0]->link:'' }}">
                                <div style="margin-top: 20px;">
                                  <p><span style="font-weight: 700;">Bước 1:</span> Truy cập <a href="https://www.youtube.com/" target="_blank">Youtube</a></p>
                                  <p><span style="font-weight: 700;">Bước 2:</span> Ấn vào xem video mình muốn gán</p>
                                  <p><span style="font-weight: 700;">Bước 3:</span> Copy URL trên thanh địa chỉ (Ví dụ: https://www.youtube.com/watch?v=KS7LGg1f84A)</p>
                                  <p><span style="font-weight: 700;">Bước 4:</span> Quay trở lại trang này và dán vào ô thông tin phía trên</p>
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
@endsection
