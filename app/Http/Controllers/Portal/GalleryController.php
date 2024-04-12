<?php

namespace App\Http\Controllers\Portal;

use App\Models\Gallery;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\File;
use DB;
use App\Http\Requests\GalleryRequest;
use Exception;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('created_at', 'DESC')->get();

        return view('portal.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('portal.galleries.create');
    }

    public function store(GalleryRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->only([
                'title', 'title_en'
            ]);
            $data = array_merge($data, ['created_by' => Auth::user()->id]);
            $gallery = Gallery::create($data);
            if ($request->hasFile('thumbnail_url')) {
                $image = $request->file('thumbnail_url');
                $name = 'thumbnail_' . Carbon::now()->format('Y_m_d_his') . '.' . $image->getClientOriginalExtension();
                $path = config('filesystems.file_upload_path.gallery_path') . $gallery->id;
                $image->move($path, $name, 'public');
                $gallery->update(['thumbnail_url' => $path . '/' . $name]);
            } else {
                return redirect()->back()->withErrors(['msg' => trans('messages.gallery.validate.thumbnail_image')]);
            }
            DB::commit();

            return redirect()->route('galleries.edit', $gallery->id)->with('type', true);
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->route('galleries.create');
        }
    }

    public function edit($id)
    {
        $gallery = Gallery::find($id);

        return view('portal.galleries.edit', compact('gallery'));
    }

    public function update(GalleryRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $gallery = Gallery::find($id);
            $data = $request->only([
                'title', 'title_en'
            ]);
            if ($request->hasFile('thumbnail_url')) {
                if (File::exists($gallery->thumbnail_url)) {
                    File::delete($gallery->thumbnail_url);
                }
                $image = $request->file('thumbnail_url');
                $name = 'thumbnail_' . Carbon::now()->format('Y_m_d_his') . '.' . $image->getClientOriginalExtension();
                $path = config('filesystems.file_upload_path.gallery_path') . $id;
                $image->move($path, $name, 'public');
                $data['thumbnail_url'] = $path . '/' . $name;
            }
            $data['updated_by'] = Auth::user()->id;
            $gallery->update($data);
            DB::commit();

            return redirect()->route('galleries.index');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->route('galleries.edit', $id);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $path = public_path(config('filesystems.file_upload_path.gallery_path') . $id);
            Gallery::find($id)->delete();
            Image::where('gallery_id', $id)->delete();
            if (File::exists($path)) {
                File::deleteDirectory($path);
            }
            DB::commit();

            return redirect()->route('galleries.index');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->route('posts.index');
        }
    }

    public function getList($id)
    {
        $data = [];
        $images = Image::where('gallery_id', $id)->pluck('filename')->toArray();
        $galleryFolder = public_path(config('filesystems.file_upload_path.gallery_path') . $id);
        $files = scandir($galleryFolder);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..' && in_array($file, $images)) {
                $data[] = [
                    'name' => $file,
                    'size' => filesize(config('filesystems.file_upload_path.gallery_path') . $id . '/' . $file),
                    'path' => asset(config('filesystems.file_upload_path.gallery_path') . $id . '/' . $file)
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
            $image->move(public_path(config('filesystems.file_upload_path.gallery_path') . $id), $fileName);
            
            Image::insert([
                'filename' => $fileName,
                'path' => config('filesystems.file_upload_path.gallery_path') . $id,
                'gallery_id' => $id,
                'created_by' => $userId
            ]);
            Gallery::find($id)->update(['updated_by' => $userId]);

            return response()->json(['success' => $fileName]);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Error!'], 500);
        }
    }

    public function remove(Request $request, $id)
    {
        try {
            $filename = $request->get('filename');
            Image::where('filename', $filename)->delete();
            Gallery::find($id)->update(['updated_by' => Auth::user()->id]);
            $path = public_path(config('filesystems.file_upload_path.gallery_path') . $id) . '/' . $filename;
            if (File::exists($path)) {
                File::delete($path);
            }

            return response()->json(['success' => $filename]);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Error!'], 500);
        }
    }
}
