@extends('client.layouts.main')
@section('title', 'SIS')
@section('content')
<div class="row" style="padding-top: 20px">
  <div class="col-12 p-0" style="margin-top: 5px">
    @if (!isset($keyword))
      Vui lòng nhập từ khóa
    @elseif (isset($keyword) && count($posts) == 0)
      Không tìm được kết quả nào phù hợp
    @else
      @foreach ($posts as $post)
        <div class="row post-preview">
          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <a href="{{ route('posts.show', $post->slug) . '?category_id=' . $parentCategories[$post->category_id] }}">
              <img class="w-100 mr-2 border-0 post-preview__img" src="{{ asset($post->thumbnail_url) }}"/>
            </a>
          </div>
          <div class="col-lg-9 col-md-6 col-sm-6 col-xs-12 post-preview__div">
            <a href="{{ route('posts.show', $post->slug) . '?category_id=' . $parentCategories[$post->category_id] }}">
              <h3 class="post-preview__h3">{{ Session::get('website_language') == 'en' && isset($post->title_en) ? $post->title_en : $post->title }}</h3>
              @if (Session::get('website_language') == 'en' && isset($post->content_en))
                  <p class="post-preview__p">{!! Str::limit(strip_tags($post->content_en), $limit = 300, $end = '...') !!}</p>
              @else
                  <p class="post-preview__p">{!! Str::limit(strip_tags($post->content), $limit = 300, $end = '...') !!}</p>
              @endif
              <span class="post-preview__span">By {{ $post->user ? $post->user->name : 'SISSVNU' }} | {{ Session::get('website_language') == 'en' && isset($post->category->name_en) ? $post->category->name_en : $post->category->name }}</span>
            </a>
          </div>
        </div>
      @endforeach
      <div class="d-flex justify-content-center">
        {{ $posts->links() }}
      </div>
    @endif
  </div>
</div>
@endsection