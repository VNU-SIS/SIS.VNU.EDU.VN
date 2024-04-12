<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('category')->get();

        return view('portal.categories.index', compact('categories'));
    }

    public function getChild(&$arr, $categories, $parentId = 0, $char = '')
    {
        foreach ($categories as $key => $category) {
            if ($category->parent_id === $parentId) {
                $arr[$key] = [
                    'id' => $category->id,
                    'name' => $char . $category->name
                ];
                unset($categories[$key]);
                $this->getChild($arr, $categories, $category->id, $char . '&nbsp;&nbsp;&nbsp;');
            }
        }
    }

    public function create()
    {
        $cats = Category::all();
        $categories = [];
        $this->getChild($categories, $cats);

        return view('portal.categories.create', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->only([
            'name', 'description', 'parent_id', 'name_en', 'description_en'
        ]);
        Category::create($data);

        return redirect()->route('categories.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::where('id', '!=', $id)->get();
        $cats = [];
        $this->getChild($cats, $categories);

        return view('portal.categories.edit', compact('category', 'cats'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $data = $request->only([
            'name', 'description', 'parent_id', 'name_en', 'description_en'
        ]);
        Category::find($id)->update($data);

        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        Category::find($id)->delete();

        return redirect()->route('categories.index');
    }
}
