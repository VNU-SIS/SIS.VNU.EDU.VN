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
use Exception;
use Illuminate\Support\Facades\Session;

class YoutubeController extends Controller
{
    public function edit()
    {
        $youtube = DB::table('youtube')->get();

        return view('portal.youtube.edit', compact('youtube'));
    }

    public function update(Request $request)
    {
      if(strlen($request->link)<43){
        Session::flash('error', 'Cập nhật URL video thất bại');
        return redirect()->back();
      }
      DB::table('youtube')->delete();
      DB::table('youtube')->updateOrInsert([
        'id' => 1,
        'link' => $request->link
      ]);

      Session::flash('success', 'Cập nhật URL video thành công');
      return redirect()->back();
    }
}
