@extends('client.layouts.main')
@section('title', 'SIS')
@section('content')
<div class="row" style="padding-top: 40px">
    <div class="col-md-8 col-sm-12">
        <img class="gallery__img" src="{{ asset($gallery->thumbnail_url) }}" />
        <h2 class="mt-3 mb-1" style="font-size: 22px;">{{ $gallery->title }}</h2>
        <div class="row" style="padding: 15px; margin-bottom: 30px">
            @foreach ($images as $image)
            <div class="col-md-4 col-sm-6 d-flex" style="padding: 1px">
                <a target="_blank" class="d-flex w-100" href="{{ asset($image->img_url) }}">
                    <img class="gallery__img--sm" src="{{ asset($image->img_url) }}" />
                </a>
            </div>
            @endforeach
        </div>
        <div class="gallery__div">
            <span>By {{ $gallery->user ? $gallery->user->name : 'SISSVNU' }} &nbsp; | &nbsp; {{ $gallery->created_date }}</span>
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <h2 style="font-size: 20px; margin-bottom: 20px; text-transform: uppercase;">Bài gần đây</h2>
        @foreach ($posts as $post)
        <div class="post-preview__sm">
            <a href="{{ route('categories.show', $post->category_id) . '?post_id=' . $post->id }}">
                <img class="w-50 mr-2 float-left post-preview__img__sm" src="{{ asset($post->thumbnail_url) }}"/>
                <h3 class="mb-1 post-preview__h3__sm">{{ $post->title }}</h3>
                <span class="post-preview__p" style="text-transform: uppercase;">{{ $post->created_date }}</span>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
<style>
    .gallery__img {
        width: 100%;
        max-height: 300px;
        object-fit: contain;
    }
    .gallery__img--sm {
        width: 100%;
        max-height: 150px;
        object-fit: cover;
    }
    .gallery__div {
        color: #666;
        padding: 15px 0;
        border-top: solid 1px #eaeaea;
        border-bottom: solid 1px #eaeaea;
        text-transform: uppercase;
        font-size: 11px;
    }
</style>