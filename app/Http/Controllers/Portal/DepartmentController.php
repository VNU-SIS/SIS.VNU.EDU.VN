<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = DB::table('departments')->get();

        return view('portal.departments.index', compact('departments'));
    }

    public function store(Request $request)
    {
        $data = $request->only(['name']);
        if (strlen(trim($data['name'])) > 0) {
            $data['created_at'] = now();
            $data['updated_at'] = now();
            DB::table('departments')->insert($data);
        }

        return redirect()->route('department.list');
    }

    public function destroy($id)
    {
        $department = DB::table("departments")->where("id", $id)->first();

        if (isset($department)) {
            DB::table("departments")->where("id", $id)->delete();
        }

        return redirect()->route('department.list');
    }
}
