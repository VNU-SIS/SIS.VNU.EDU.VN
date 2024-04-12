<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use Carbon\Carbon;
use Auth;
use DB;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'user'])->orderBy('created_at', 'DESC')->get();

        return view('portal.posts.index', compact('posts'));
    }

    public function create()
    {
        $cats = Category::all();
        $categories = [];
        $this->getChild($categories, $cats);

        return view('portal.posts.create', compact('categories'));
    }

    public function getChild(&$arr, $categories, $id = null, $parentId = 0, $char = '')
    {
        foreach ($categories as $key => $category) {
            if ($category->parent_id === $parentId) {
                $arr[$key] = [
                    'id' => $category->id,
                    'name' => $char . $category->name
                ];
                unset($categories[$key]);
                if ($id !== $category->id) {
                    $this->getChild($arr, $categories, $id, $category->id, $char . '&nbsp;&nbsp;&nbsp;');
                }
            }
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->only([
                'title', 'title_en', 'category_id', 'content', 'content_en', 'event_at', 'status'
            ]);
            $data = array_merge($data, ['created_by' => Auth::user()->id]);
            $data['created_at'] = date("Y-m-d h:i:s");
            $data['updated_at'] = date("Y-m-d h:i:s");
            $data['title'] = $data['title']??'(Không có tiêu đề) - Bản nháp';
            $post = Post::create($data);
            if ($request->hasFile('thumbnail_url')) {
                $image = $request->file('thumbnail_url');
                $name = Carbon::now()->format('Y_m_d_his') . '.' . $image->getClientOriginalExtension();
                $path = config('filesystems.file_upload_path.post_path') . $post->id;
                $image->move($path, $name, 'public');
                $post->update(['thumbnail_url' => $path . '/' . $name]);
            }
            DB::commit();

            return redirect()->route('posts.index');
        } catch (Exception $e) {
            DB::rollBack();
            //dd($e);
            return redirect()->route('posts.index');
        }
    }

    public function edit($id)
    {
        $cats = Category::all();
        $categories = [];
        $this->getChild($categories, $cats);
        $post = Post::find($id);
        //dd($post);

        return view('portal.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $post = Post::find($id);
            $data = $request->only([
                'title', 'title_en', 'category_id', 'content', 'content_en', 'event_at', 'updated_at', 'status'
            ]);
            if ($request->hasFile('thumbnail_url')) {
                if (File::exists($post->thumbnail_url)) {
                    File::delete($post->thumbnail_url);
                }
                $image = $request->file('thumbnail_url');
                $name = Carbon::now()->format('Y_m_d_his') . '.' . $image->getClientOriginalExtension();
                $path = config('filesystems.file_upload_path.post_path') . $id;
                $image->move($path, $name, 'public');
                $data['thumbnail_url'] = $path . '/' . $name;
            }
            $data['updated_by'] = Auth::user()->id;
            $post->update($data);
            DB::commit();

            return redirect()->route('posts.index');
        } catch (Exception $e) {
            DB::rollBack();
            //dd($e);
            return redirect()->route('posts.index');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $post = Post::find($id);
            if (File::exists($post->thumbnail_url)) {
                File::delete($post->thumbnail_url);
                $path = public_path(config('filesystems.file_upload_path.post_path') . $id);
                $files = scandir($path);
                if (count($files) <= 2) {
                    File::deleteDirectory($path);
                }
            }
            $post->delete();
            DB::commit();

            return redirect()->route('posts.index');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->route('posts.index');
        }
    }
}
