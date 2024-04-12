@foreach ($categories as $category)
  @if (count($category['child']) > 0)
    <li class="dropdown-submenu">
      <a href="{{ route('categories.show', ['parent_id' => $parentId, 'child_id' => $category["slug"]]) }}" class="text-white d-block py-2 px-3">
        {{ Session::get('website_language') == 'en' && isset($category['name_en']) ? $category['name_en'] : $category['name'] }}
      </a>
      <ul class="dropdown-menu">
        @include('client.layouts.navbar', ['categories' => $category['child'], 'parentId' => $parentId])
      </ul>
    </li>
  @else
    <li>
      <a href="{{ route('categories.show', ['parent_id' => $parentId, 'child_id' => $category["slug"]]) }}" class="text-white d-block py-2 px-3">
        {{ Session::get('website_language') == 'en' && isset($category['name_en']) ? $category['name_en'] : $category['name'] }}
      </a>
    </li>
  @endif
@endforeach