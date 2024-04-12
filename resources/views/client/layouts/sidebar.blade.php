@forelse ($categories as $category)
    <div class="sidebar" data-cate_id="{{ $category->id }}" data-parent_id="{{ $category->parent_id }}" style="margin-left: {{ $level * 10 }}px;" onclick="onClickCategory(event)">
        <a class="text-white" style="max-width: 90%" href="{{ route('categories.show', ['parent_id' => $parentSlug, 'child_id' => $category->slug]) }}">
            {{ Session::get('website_language') == 'en' && isset($category['name_en']) ? $category->name_en : $category->name }}
        </a>
        <span style="color: white; pointer-events: none;">+</span>
    </div>
    <div data-child="{{ $category->id }}" style="display: none">
        @includeWhen($category->sub->count() ,'client.layouts.sidebar', ['categories' => $category->sub, 'level' => $level + 1, 'parentSlug' => $parentSlug])
    </div>
@empty
<div class="item-menu"><span></span></div> 
@endforelse