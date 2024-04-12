<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Gallery;
use DB;

class CategoryController extends Controller
{
    public function show($parentSlug, $childSlug = null)
    {
        $cats = Category::orderBy('order')->get();
        $categoriesHeader = [];
        $this->getChild($categoriesHeader, $cats);

        $categoriesFooter = Category::where('parent_id', 0)
            ->orderBy('order')
            ->get()
            ->map(function($query) {
                $query->categories = Category::where('parent_id', $query->id)
                    ->orderBy('order')
                    ->get();

                return $query;
            })
            ->toArray();

        $categoryBySlugs = Category::whereIn('slug', [$parentSlug, $childSlug])->pluck('id', 'slug')->toArray();
        $parentId = $categoryBySlugs[$parentSlug];
        $childId = $childSlug ? $categoryBySlugs[$childSlug] : null;
        $categories = $this->getSubCategories($parentId);

        $cats1 = Category::all();
        $childCategories = [];
        foreach ($cats1 as $key => $cat1) {
            $childCategories[$cat1->id][] = $cat1->id;
            $this->getChildCategories($childCategories[$cat1->id], $cats1, [$cat1->id]);
        }

        if ($childId) {
            if ($childId == 12) {
                return view('client.categories.show', compact('categoriesHeader', 'categoriesFooter', 'categories', 'parentId', 'parentSlug', 'childId'));
            } elseif ($childId == 13) {
                $galleries = Gallery::select(
                    '*',
                    DB::raw('DATE_FORMAT(created_at, "%M %e, %Y") as created_date')
                )->orderBy('created_at', 'DESC')->paginate(6);

                return view('client.categories.show', compact('categoriesHeader', 'categoriesFooter', 'categories', 'galleries', 'parentId', 'parentSlug', 'childId'));
            } else {
                if ($childId == 10) {
                    $posts = Post::where('status', 1)->where('category_id', 10)->orderByRaw('CASE WHEN event_at IS NOT NULL THEN event_at ELSE created_at END DESC')->paginate(4);
                    if ($posts->count() == 1) {
                        $post = $posts->first();
                        
                        return redirect(route('posts.show', $post->slug) . '?category_id=' . $parentId);
                    }
                } else {
                    $posts = Post::where('status', 1)->whereIn('category_id', $childCategories[$childId])->orderByRaw('CASE WHEN event_at IS NOT NULL THEN event_at ELSE created_at END DESC')->paginate(4);
                }
            }
        } else {
            $posts = Post::where('status', 1)->whereIn('category_id', $childCategories[$parentId])->orderByRaw('CASE WHEN event_at IS NOT NULL THEN event_at ELSE created_at END DESC')->paginate(4);
        }

        return view('client.categories.show', compact('categoriesHeader', 'categoriesFooter', 'categories', 'posts', 'parentId', 'parentSlug', 'childId'));
    }

    public function getChild(&$arr, $categories, $parentId = 0)
    {
        foreach ($categories as $key => $category) {
            if ($category->parent_id === $parentId) {
                $arr[$key]['id'] = $category->id;
                $arr[$key]['name'] = $category->name;
                $arr[$key]['name_en'] = $category->name_en;
                $arr[$key]['slug'] = $category->slug;
                $arr[$key]['child'] = [];
                unset($categories[$key]);
                $this->getChild($arr[$key]['child'], $categories, $category->id);
            }
        }
    }

    public function getChildCategories(&$arr, $categories, $parentId = [])
    {
        foreach ($categories as $key => $category) {
            if (in_array($category->parent_id, $parentId) || (count($parentId) === 0 && $category->parent_id === 0)) {
                if ($category->parent_id === 0) {
                    $arr[$category->id][] = $category->id;    
                    unset($categories[$key]);
                    $this->getChildCategories($arr[$category->id], $categories, [$category->id]);
                } else {
                    $arr[] = $category->id;
                    $this->getChildCategories($arr, $categories, [$category->id]);
                }
            }
        }
    }

    private function getSubCategories($parent_id, $ignore_id = null)
    {
        $categories = Category::where('parent_id', $parent_id)
            ->where('id', '<>', $ignore_id)
            ->orderBy('order')
            ->get()
            ->map(function($query) use ($ignore_id) {
                $query->sub = $this->getSubCategories($query->id, $ignore_id);

                return $query;
            });

        return $categories;
    }
}
