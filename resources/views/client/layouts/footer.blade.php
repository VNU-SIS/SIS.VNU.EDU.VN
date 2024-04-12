<div class="footer">
  <div class="bg-vnu-gray" style="font-size: 12px">
    <div class="container px-2 py-3">
      <div class="row mr-0">
        @foreach ($categoriesFooter as $category)
          <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
            <ul class="px-0">
              <li class="mb-1"><strong style="font-size: 13px"><a class="text-dark" href="{{ route('categories.show', $category["slug"]) }}">{{ $category['name'] }}</a></strong></li>
              @foreach ($category['categories'] as $subCategory)
                <li class="mb-1"><a class="text-dark" href="{{ route('categories.show', ['parent_id' => $category["slug"], 'child_id' => $subCategory["slug"]]) }}">{{ $subCategory['name'] }}</a></li>
              @endforeach
            </ul>
          </div>
        @endforeach
      </div>
      <div class="row mr-0">
        <div class="col-lg-9 col-md-6 col-sm-6 mb-3"></div>
        <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
          <a class="mr-2" href="https://www.facebook.com/sis.vnu.edu.vn"><img src="{{ url('images/facebook.jpg') }}" style="height: 40px"></a>
          <a class="mr-2" href="https://youtube.com/@khoahocliennganhvanghethuat?si=ug8FWIq0ptDLIH5J"><img src="{{ url('images/youtube.png') }}" style="height: 40px"></a>
          <a class="mr-2" href="truyenthongliennganh@vnu.edu.vn"><img src="{{ url('images/gmail.png') }}" style="height: 40px"></a>
        </div>
      </div>
    </div>
  </div>
  <div class="bg-vnu-blue" style="font-size: 12px">
    <div class="container px-2 py-3 text-right text-white">
      <ul class="px-0" style="list-style-type: none">
        <li class="mb-1">Bản quyền thuộc về Trường Khoa học liên ngành và Nghệ thuật, Đại học Quốc gia Hà Nội</li>
        <li class="mb-1">Nhà G7, Đại học Quốc gia Hà Nội, số 144 Xuân Thủy, Cầu Giấy, Hà Nội</li>
        <li class="mb-1">Tel: 0243 754 7716</li>
        <li class="mb-1">Email: sis@vnu.edu.vn và truyenthongliennganh@vnu.edu.vn</li>
        <li class="mb-1">Facebook: <a href="https://www.facebook.com/khoacackhoahocliennganh" class="text-white">Trường Khoa học liên ngành và Nghệ thuật, Đại học Quốc gia Hà Nội</a></li>
      </ul>
    </div>
  </div>
</div>
