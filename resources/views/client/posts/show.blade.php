@extends('client.layouts.main')
@section('meta')
  <meta property="og:type" content="article" />
  <meta property="og:title" content="{{ Session::get('website_language') == 'en' && isset($post->title_en) ? $post->title_en : $post->title }}" />
  <meta property="og:description" content="{!! Str::limit(strip_tags($post->content), $limit = 200, $end = '...') !!}" />
  <meta property="og:image" content="{{ asset($post->thumbnail_url) }}" />
@endsection
@section('title', 'SIS')
@section('content')
<div class="row" style="padding-top: 20px">
  <div class="col-lg-3 col-md-4 col-sm-12">
    @include('client.layouts.sidebar', ['level' => 0, 'parentSlug' => $categorySlug])
  </div>

  <div class="col-lg-9 col-md-8 col-sm-12 p-0" style="margin-top: 5px">
    <div class="post">
      <div class="post__title">
        <a href="">{{ Session::get('website_language') == 'en' && isset($post->title_en) ? $post->title_en : $post->title }}</a>
        <p>Cập nhật lúc {{ $post->updated_at }} </p>
      </div>
      <div class="post__content">
        <img src="{{ asset($post->thumbnail_url) }}" alt="">
        {!! Session::get('website_language') == 'en' && isset($post->content_en) ? $post->content_en : $post->content !!}
      </div>

      @if (count($similarPosts) > 0)
          <div class="post__other">
          <p>CÁC TIN KHÁC</p>
          <div style="margin-left: 30px">
              @foreach ($similarPosts as $similarPost)
              <div class="content__item">
                  <img class="cate__icon" src="{{ asset('images/next_new_category.png') }}">
                  <a href="{{ route('posts.show', $similarPost->slug) . '?category_id=' . $categoryId }}" class="cate__title">
                  {{ Session::get('website_language') == 'en' && isset($similarPost->title_en) ? $similarPost->title_en : $similarPost->title }}
                  </a>
                  <img class="cate__icon-new" src="{{ asset('images/newnew.gif') }}">
              </div>
              @endforeach
          </div>
          </div>
      @endif
    </div>
  </div>
</div>
@endsection
@section('js')
  <script>
    $(document).ready(function() {
      $(".b-all").on("click", function(e) {
        e.preventDefault();
        let _this = $(this)
        const level = _this.data("id")
        const title  = _this.html()

        $("#exampleModalLongTitle").text(title)

        $.ajax({
          url: '/api/user',
          type: 'GET',
          data: {
              level: level
          }
        }).done(function(res) {
          if (res.length > 0) {
            let html = ""
            res.map(user => {
              const htmlUser = `<div class="col-6 col-md-6 col-lg-4 col-xl-4">
                                  <a href="/user/info?uid=${user.id}">
                                    <div class=user-popup-item>
                                        <div class=user-avatar>
                                            <div class=inner>
                                                <img src="${user.avatar || 'https://iupac.org/wp-content/uploads/2018/05/default-avatar.png'}">
                                            </div>
                                        </div>
                                        <div class=ho-ten>${user.name}</div>
                                        <div class=chuc-vu>${user.position !== null ? user.position : ""}1</div>
                                    </div>
                                  </a>
                              </div>`
              html += htmlUser
            })
            $(".row-eq-height").html(html)
            $("#ReactModalPortal").modal('toggle')
          }
        });
      })
    })
    function onClickCategory(e) {
      const cateId = e.target.dataset.cate_id;
      const cateChild = document.querySelector('div[data-child="' + cateId +'"]');
      if (cateChild) {    
        if (cateChild.style.display === "none") {
          cateChild.style.display = "block";
          e.target.children[1].innerText = "-";
        } else {
          cateChild.style.display = "none";
          e.target.children[1].innerText = "+";
        }
      }
    }
    
  </script>
@endsection