@extends('client.layouts.main')
@section('title', 'SIS')
@section('content')
@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="{{ asset('OwlCarousel2-2.3.4/dist/owl.carousel.min.js') }}">
  <style>
    #carouselSlider ol li {
      width: 7px;
      height: 7px;
      border-radius: 100%;
    }

    .title {
      position: relative;
      background-color: var(--blue-vnu);
    }
    .title::after {
      background-color: var(--blue-vnu);
      font-size: 16px;
      content: "";
      position: absolute;
      top: 0;
      bottom: 0;
      left: 100%;
      width: 1em;
      clip-path: polygon(0 0, 100% 50%, 0 100%, 0 50%);
      transform: translateX(-0.1px);
    }
    .bg-vnu-gray {
      background-color: #e6e6e8;
    }

    .bg-vnu-blue {
      background-color: var(--blue-vnu);
    }

    .gallery__img {
        width: 100%;
        height: 120px;
        object-fit: cover;
    }
    .gallery__div {
        position: absolute;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        background: rgb(0, 0, 0);
        color: #f1f1f1;
        width: 100%;
        transition: .5s ease;
        opacity: 0;
        color: white;
        padding: 5px 20px;
    }
    .gallery:hover .gallery__div {
        opacity: 1;
    }

    .owl-dots{
      display: none;
    }
  </style>
@endsection
<div class="row">
  <div class="col-lg-8 col-md-8 col-sm-12 d-flex align-items-center justify-content-center px-2">
    <div id="carouselSlider" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        @foreach ($sliders as $key => $slide)
          @if ($key == 0)
            <li data-target="#carouselSlider" data-slide-to="{{ $key }}" class="active"></li>
          @else
            <li data-target="#carouselSlider" data-slide-to="{{ $key }}"></li>
          @endif
        @endforeach
      </ol>
      <div class="carousel-inner">
        @foreach ($sliders as $key => $slide)
          @if ($key == 0)
            <div class="carousel-item active">
          @else
            <div class="carousel-item">
          @endif
            <a href="{{ $slide->url }}">
              <img class="d-block image-slider w-100" src="{{ asset($slide->path . '/' . $slide->filename) }}" alt="First slide" style="height: 350px;">
            </a>
          </div>
        @endforeach
      </div>
      <a class="carousel-control-prev" href="#carouselSlider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselSlider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-12 px-2" style="padding: 0px!important;">  
    <div class="list-group list-group-flush" style="font-size: 13px;">
      @foreach ($textBanners as $textBanner)
        <a href="{{ $textBanner->url }}" class="list-group-item list-group-item-action py-2"><i class="bi bi-caret-right-fill"></i> {{ $textBanner->filename }}</a>
      @endforeach
      @foreach ($topBanners as $banner)
        <a href="{{ $banner->url }}" class="col-lg-12 col-md-12 col-sm-6 px-2"><img class="w-100" src="{{ asset($banner->path . '/' . $banner->filename) }}" style="max-height: 120px; margin-top: 0.5rem; margin-bottom: 0.5rem;"/></a>
      @endforeach
    </div>
  </div>
</div>
<div class="row mb-3">
  @foreach ($botBanners as $banner)
    <div class="col-lg-4 col-md-4 col-sm-12 px-2" style="text-align: center;">
      <a href="{{ $banner->url }}">
        <img class="w-100" src="{{ asset($banner->path . '/' . $banner->filename) }}" style="object-fit: contain; margin-top: 0.5rem; margin-bottom: 0.5rem;" />
      </a>
    </div>
  @endforeach
</div>
<div class="row mb-3">
  <div class="col-lg-4 col-md-4 col-sm-12 px-2">
    <div class="mb-3">
      <strong class="title fw-bold p-2 text-white" style="font-size: 16px">Tin tức</strong>
    </div>
    @foreach ($news as $new)
      <div class="post-preview__sm">
        <a href="{{ route('posts.show', $new->slug) . '?category_id=' . $newCate }}">
          <img class="w-50 mr-2 float-left post-preview__img__sm" src="{{ asset($new->thumbnail_url) }}"/>
          <h3 class="mb-1 post-preview__h3__sm">{{ $new->title }}</h3>
          <span class="post-preview__p">{!! Str::limit(strip_tags($new->content), $limit = 250, $end = '...') !!}</span>
        </a>
      </div>
    @endforeach
    <div class="mb-3" style="margin-top: 25px">
      <strong class="title fw-bold p-2 text-white" style="font-size: 16px">Sự kiện</strong>
    </div>
    <div class="list-group list-group-flush" style="font-size: 12px; margin-bottom: 20px">
      @foreach ($events as $event)
        <a href="{{ route('posts.show', $event->slug) . '?category_id=' . $eventCate }}" class="list-group-item list-group-item-action px-0">
          <div class="row w-100 mx-0">
            <div class="col-2 d-flex flex-column justify-content-center" style="padding-left: 0; padding-right: 10px">
              <strong class="text-center bg-vnu-gray" style="font-size: 15px">{{ $event->event_at?date('d', strtotime($event->event_at)):date('d', strtotime($event->created_at)) }}</strong>
              <p class="text-white text-center mb-0 bg-vnu-blue" style="font-size: 10px; text-transform: uppercase">{{ $event->event_at?date('M', strtotime($event->event_at)):date('M', strtotime($event->created_at)) }}</p>
            </div>
            <div class="col-10 px-0">{{ $event->title }}</div>
          </div>
        </a>
      @endforeach
    </div>
    {{-- <nav aria-label="navigation" style="font-size: 12px">
      <ul class="pagination">
        <li class="page-item">
          <a class="page-link text-secondary" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <li class="page-item"><a class="page-link text-secondary" href="#">1</a></li>
        <li class="page-item"><a class="page-link text-secondary" href="#">2</a></li>
        <li class="page-item"><a class="page-link text-secondary" href="#">3</a></li>
        <li class="page-item">
          <a class="page-link text-secondary" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav> --}}
  </div>
  <div class="col-lg-8 col-md-8 col-sm-12 px-2">
    <div class="mb-3">
      <strong class="title fw-bold p-2 text-white" style="font-size: 16px">Tuyển sinh</strong>
    </div>
    @foreach ($admissions as $admiss)
      <div class="row post-preview mr-0">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <a href="{{ route('posts.show', $admiss->slug) . '?category_id=' . $admissCate }}">
            <img class="w-100 border-0 post-preview__img" src="{{ asset($admiss->thumbnail_url) }}"/>
          </a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 post-preview__div">
          <a href="{{ route('posts.show', $admiss->slug) . '?category_id=' . $admissCate }}">
            <h3 class="post-preview__h3">{{ $admiss->title }}</h3>
            <p class="post-preview__p">{!! Str::limit(strip_tags($admiss->content), $limit = 300, $end = '...') !!}</p>
            <span class="post-preview__span">By {{ $admiss->user ? $admiss->user->name : 'SISSVNU' }} &nbsp; | &nbsp; {{ $admiss->category->name }}</span>
          </a>
        </div>
      </div>
    @endforeach
  </div>
  {{-- <div class="col-lg-4 col-md-4 col-sm-12 px-2">
    <div class="mb-3">
      <div class="mb-3">
        <strong class="title fw-bold p-2 text-white" style="font-size: 16px">Thông báo</strong>
      </div>
      <div class="list-group list-group-flush" style="font-size: 12px">
        @for ($i = 0; $i < 10; $i++)
          <a href="#" class="list-group-item list-group-item-action py-2 px-0"><i class="bi bi-caret-right-fill"></i> Thông báo: Về việc thực hiện thu tiền bảo hiểm y tế (BHYT) sinh viên năm 2022 (đợt tháng 01/2022)</a>
        @endfor
      </div>
    </div>
    <div class="mb-3">
      <div class="mb-3">
        <strong class="title fw-bold p-2 text-white" style="font-size: 16px">Sắp diễn ra</strong>
      </div>
      <div class="list-group list-group-flush" style="font-size: 12px">
        @for ($i = 0; $i < 3; $i++)
          <a href="#" class="list-group-item list-group-item-action px-0">
            <div class="row">
              <div class="col-2 pr-1 d-flex flex-column justify-content-center">
                <strong class="text-center bg-vnu-gray" style="font-size: 15px">23</strong>
                <p class="text-white text-center mb-0 bg-vnu-blue" style="font-size: 10px">NOV</p>
              </div>
              <div class="col-10 px-0">
                UEB JOB FAIR 2021 – Ngày hội tuyển dụng việc làm lớn nhất UEB năm nay có gì khác biệt? 
              </div>
            </div>
          </a>
        @endfor
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-12 px-2">
    <div class="mb-3">
      <div class="mb-3">
        <strong class="title fw-bold p-2 text-white" style="font-size: 16px">Tuyển sinh đại học</strong>
      </div>
      <div class="list-group list-group-flush" style="font-size: 12px">
        @for ($i = 0; $i < 5; $i++)
          <a href="#" class="list-group-item list-group-item-action py-2 px-0"><i class="bi bi-caret-right-fill"></i> Những điều cần biết về chương trình đào tạo đại học chất lượng cao - Trường Đại học Kinh tế - ĐHQGHN</a>
        @endfor
      </div>
    </div>
    <div class="mb-3">
      <div class="mb-3">
        <strong class="title fw-bold p-2 text-white" style="font-size: 16px">Tuyển sinh sau đại học</strong>
      </div>
      <div class="list-group list-group-flush" style="font-size: 12px">
        @for ($i = 0; $i < 5; $i++)
          <a href="#" class="list-group-item list-group-item-action py-2 px-0"><i class="bi bi-caret-right-fill"></i> Phương án tổ chức tuyển sinh sau đại học Đợt 2 năm 2021 theo hình thức trực tuyến</a>
        @endfor
      </div>
    </div>
    <div class="mb-3">
      <div class="input-group" style="border-radius: 0.25rem">
        <input type="text" class="form-control" placeholder="Tìm trong thư viện ĐHQG" style="font-size: 15px">
        <button class="btn btn-outline-primary text-white bg-vnu-blue" type="button" style="border:1px solid #0d2c6c"><i class="bi bi-search"></i></button>
      </div>
    </div>
  </div> --}}
</div>
<div class="row mb-3">
  <div class="col-lg-6 col-md-6 col-sm-12 px-2" style="margin-bottom: 20px;">
    <div style="height: 180px; overflow: hidden;">
      <div class="mb-3">
        <strong class="title fw-bold p-2 text-white" style="font-size: 16px">Tin mới lên</strong>
      </div>
      @foreach ($newNews as $new)
        <div class="content__item">
          <img class="cate__icon" src="{{ asset('images/next_new_category.png') }}">
          <a href="{{ route('posts.show', $new->slug) . '?category_id=' . $newCate }}" class="cate__title">
          {{ Session::get('website_language') == 'en' && isset($new->title_en) ? $new->title_en : $new->title }}
          </a>
          <img class="cate__icon-new" src="{{ asset('images/newnew.gif') }}">
        </div>
      @endforeach
    </div>
    <div class="row" style="margin: 0px -6px;">
      <div class="col-lg-6 col-md-6 col-sm-6 px-2">
      <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fweb.facebook.com%2Fsis.vnu.edu.vn%3Fmibextid%3DLQQJ4d%26_rdc%3D1%26_rdr&tabs=timeline&width=270&height=280&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=639960768003776" width="270" height="280" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 px-2">
      <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fweb.facebook.com%2Ftuyensinhvnusis%3Fmibextid%3DLQQJ4d%26_rdc%3D1%26_rdr&tabs=timeline&width=270&height=280&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=639960768003776" width="270" height="280" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
      </div>
    </div>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-12 px-2">
  <div class="mb-3">
    <strong class="title fw-bold p-2 text-white" style="font-size: 16px">Ảnh và Video</strong>
    </div>
    <iframe width="100%" height="300" src="https://www.youtube.com/embed/{{ isset($youtube[0]) && strlen($youtube[0]->link)==43 ? substr($youtube[0]->link, 32, 42) : 'KS7LGg1f84A' }}" frameborder="0" allowfullscreen></iframe>
    <div class="gallery-wrapper">
        <div class="gallery-scroller owl-carousel owl-theme">
          @foreach ($galleries as $gallery)
            <div class="item">
                <div class="gallery position-relative">
                    <a href="{{ route('galleries.show', $gallery->id) }}">
                        <img class="gallery__img" src="{{ asset($gallery->thumbnail_url) }}" />
                        <div class="gallery__div">
                            <h2 class="mt-3 mx-3 mb-1" style="text-transform: uppercase; font-size: 16px; overflow: hidden;
   display: -webkit-box;
   -webkit-line-clamp: 3; /* number of lines to show */
           line-clamp: 2; 
   -webkit-box-orient: vertical;">{{ $gallery->title }}</h2>
                            <p class="mx-3" style="font-size: 13px;">{{ $gallery->created_date }}</p>
                        </div>
                    </a>
                </div>
            </div>
          @endforeach
        </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
	$(document).ready(function() {
		$('.owl-carousel').owlCarousel({
			items:3,
			loop:true,
			margin:10,
			autoplay:true,
			autoplayTimeout:5000,
			autoplayHoverPause:true
		})
	})
</script>
@endsection