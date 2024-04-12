<div class="row">
  @foreach ($galleries as $gallery)
      <div class="col-md-6 py-0" style="padding: 15px; margin-bottom: 30px">
          <div class="gallery position-relative">
              <a href="{{ route('galleries.show', $gallery->id) }}">
                  <img class="gallery__img" src="{{ asset($gallery->thumbnail_url) }}" />
                  <div class="gallery__div">
                      <h2 class="mt-3 mx-3 mb-1" style="text-transform: uppercase; font-size: 16px;">{{ $gallery->title }}</h2>
                      <p class="mx-3" style="font-size: 13px;">{{ $gallery->created_date }}</p>
                  </div>
              </a>
          </div>
      </div>
  @endforeach
</div>
<div class="d-flex justify-content-center">
  {{ $galleries->links() }}
</div>
<style>
    .gallery__img {
        width: 100%;
        max-height: 300px;
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
</style>