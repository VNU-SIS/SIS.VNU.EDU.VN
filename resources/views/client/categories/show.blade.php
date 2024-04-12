@extends('client.layouts.main')
@section('title', 'SIS')
@section('content')
<div class="row" style="padding-top: 20px">
  <div class="col-lg-3 col-md-4 col-sm-12">
    @include('client.layouts.sidebar', ['level' => 0, 'parentSlug' => $parentSlug])
  </div>

  <div class="col-lg-9 col-md-8 col-sm-12 p-0" style="margin-top: 5px">
    @if ($childId == 12)
      @include('client.components.structure')
    @elseif ($childId == 13)
      @include('client.components.galleries')
    @else
      @foreach ($posts as $post)
        <div class="row post-preview">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <a href="{{ route('posts.show', $post->slug) . '?category_id=' . $parentId }}">
              <img class="w-100 mr-2 border-0 post-preview__img" src="{{ asset($post->thumbnail_url) }}"/>
            </a>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 post-preview__div">
            <a href="{{ route('posts.show', $post->slug) . '?category_id=' . $parentId }}">
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
      {{-- @php $posts = $posts->toArray() @endphp
      @if ($posts['last_page'] > 1)    
        <nav aria-label="navigation" style="margin-top: 20px;">
          <ul class="pagination justify-content-center">
            <li class="page-item">
              <a class="page-link" href="{{ $posts['prev_page_url'] !== null ?  $posts['prev_page_url'] : "#"}}" aria-label="Previous">
              <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
              <span class="sr-only">Previous</span>
              </a>
            </li>
            @for ($i = 1; $i <= $posts["last_page"]; $i++)  
              <li class="page-item {{ $posts["current_page"] === $i ? "active" : "" }}">
                <a class="page-link" href="{{ route('categories.show', ['parent_id' => $parentId, 'child_id' => $childId]) . "?page=" . $i }}">{{ $i }}</a>
              </li>
            @endfor
            <li class="page-item">
              <a class="page-link" href="{{ $posts['next_page_url'] !== null ?  $posts['next_page_url'] : "#"}}" aria-label="Next">
              <span aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
              <span class="sr-only">Next</span>
              </a>
            </li>
          </ul>
        </nav>
      @endif --}}
    @endif
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

            $("#exampleModalLongTitle").text(title.replaceAll('<br>', ' '))

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
                                                  <div class=chuc-vu>${user.position}</div>
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