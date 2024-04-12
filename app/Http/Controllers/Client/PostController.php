<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use Exception;

class PostController extends Controller
{
    public function show(Request $request, $slug)
    {
        try {
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

            $post = Post::where('status', 1)->where('slug', $slug)->first();

            $categoryId = $request->category_id;
            $category = Category::find($categoryId);
            $categorySlug = $category->slug;
            $categories = $this->getSubCategories($categoryId);

            $cats1 = Category::all();
            $childCategories = [];
            foreach ($cats1 as $key => $cat1) {
                $childCategories[$cat1->id][] = $cat1->id;
                $this->getChildCategories($childCategories[$cat1->id], $cats1, [$cat1->id]);
            }
            
            $similarPosts = Post::where('status', 1)->whereIn('category_id', $childCategories[$categoryId])
                ->orderByRaw('CASE WHEN event_at IS NOT NULL THEN event_at ELSE created_at END DESC')
                ->limit(10)
                ->get();
                
            return view('client.posts.show', compact('categoriesHeader', 'categoriesFooter', 'categories', 'post', 'similarPosts', 'categoryId', 'categorySlug'));
        } catch (Exception $e) {
            return redirect()->route('home.index');
        }
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

    private function getSubCategories($parent_id, $ignore_id=null)
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

    public function handleSearch(Request $request)
    {
        return redirect()->route('posts.search', $request->keyword);
    }

    public function search($keyword = null)
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

        $cats1 = Category::all();
        $parentCategories = [];
        $this->getParentCategory($parentCategories, $cats1);

        $posts = isset($keyword) ? Post::where('status', 1)->where('title', 'LIKE', "%$keyword%")->orderByRaw('CASE WHEN event_at IS NOT NULL THEN event_at ELSE created_at END DESC')->paginate(5) : [];

        return view('client.posts.search', compact('posts', 'categoriesHeader', 'categoriesFooter', 'parentCategories'))->with('keyword', $keyword);
    }

    public function getParentCategory(&$arr, $categories, $categoryId = null, $parentId = null) {
        foreach ($categories as $category) {
            if (is_null($categoryId)) {
                $arr[$category->id] = $category->id;
                $this->getParentCategory($arr, $categories, $category->id, $category->parent_id);
            } else {
                if ($parentId != 0 && $category->id == $parentId) {
                    $arr[$categoryId] = $category->id;
                    $this->getParentCategory($arr, $categories, $categoryId, $category->parent_id);
                }
            }
        }
    }
}
