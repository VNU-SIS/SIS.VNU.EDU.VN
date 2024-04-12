<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Gallery;
use Exception;
use App\Http\Controllers\Controller;
use App\Enums\DBConstant;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use DB;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role == 1) {
            return redirect('/admin/users/profile');
        } else if (Auth::user()->role == 3) {
            return redirect('/admin/posts/create');
        }
        $numberCategory = Category::get()->count();
        $numberPost = Post::get()->count();
        $numberUser = User::get()->count();
        $numberGallery = Gallery::get()->count();
        $textBanners = Image::where('gallery_id', DBConstant::SYSTEM_GALLERY_ID)->where('type', DBConstant::BANNER_TEXT_TYPE)->get();

        return view('portal.dashboard.index', compact('numberCategory', 'numberPost', 'numberUser', 'numberGallery', 'textBanners'));
    }

    public function getListImage($id)
    {
        $images = Image::where('gallery_id', DBConstant::SYSTEM_GALLERY_ID)->where('type', $id)->get();

        return view('portal.dashboard.images', compact('images'));
    }

    public function setUrl(Request $request, $id)
    {
        $image = Image::find($id);
        $image->update($request->all());

        return redirect()->back();
    }

    public function getList(Request $request)
    {
        $data = [];
        $images = Image::where('gallery_id', DBConstant::SYSTEM_GALLERY_ID)->where('type', $request->type)->pluck('filename')->toArray();
        $galleryFolder = public_path(config('filesystems.file_upload_path.system_path') . $request->type);
        $files = scandir($galleryFolder);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..' && in_array($file, $images)) {
                $data[] = [
                    'name' => $file,
                    'size' => filesize(config('filesystems.file_upload_path.system_path') . $request->type . '/' . $file),
                    'path' => asset(config('filesystems.file_upload_path.system_path') . $request->type . '/' . $file)
                ];
            }
        }

        return response()->json($data);
    }

    public function upload(Request $request, $id)
    {
        try {
            $userId = Auth::user()->id;
            $image = $request->file('file');
            $fileInfo = $image->getClientOriginalName();
            $fileOriginalName = pathinfo($fileInfo, PATHINFO_FILENAME);
            $fileExtension = pathinfo($fileInfo, PATHINFO_EXTENSION);
            $fileName = $fileOriginalName . '-' . Carbon::now()->format('Y_m_d_his') . '.' . $fileExtension;
            $image->move(public_path(config('filesystems.file_upload_path.system_path') . $id), $fileName);

            Image::insert([
                'filename' => $fileName,
                'path' => config('filesystems.file_upload_path.system_path') . $id,
                'type' => $id,
                'created_by' => $userId
            ]);

            return response()->json(['success' => $fileName]);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Error!'], 500);
        }
    }

    public function remove(Request $request)
    {
        try {
            $filename = $request->get('filename');
            Image::where('filename', $filename)->delete();
            $path = public_path(config('filesystems.file_upload_path.system_path') . $request->type) . '/' . $filename;
            if (File::exists($path)) {
                File::delete($path);
            }

            return response()->json(['success' => $filename]);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Error!'], 500);
        }
    }

    public function test()
    {
        // $posts = Category::all();
        // foreach ($posts as $post) {
        //     $result = $post->replicate();
        //     $post->slug = $result->slug;
        //     $post->save();
        // }
    }
}
