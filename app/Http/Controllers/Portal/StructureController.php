<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class StructureController extends Controller
{
    public function index(Request $request)
    {
        $level = $request->level;
        $levels = DB::table('levels')->get();
        $users = [];

        if (isset($level)) {
            $users = DB::table("users")
                ->leftJoin('user_level', 'users.id', '=', 'user_level.user_id')
                ->leftJoin('levels', 'levels.id', '=', 'user_level.level_id')
                ->leftJoin('positions', 'positions.id', '=', 'user_level.position_id')
                ->where('user_level.level_id', $request->level)
                ->select(
                    "users.*", 
                    "levels.id as level", 
                    "positions.id as position_id", 
                    "user_level.display_order",
                    DB::raw('IFNULL(positions.name, "") as position')
                )
                ->orderBy('display_order', 'asc')
                // ->orderBy('position_id', 'asc')
                ->get()
                ->toArray();

            if (!isset($users)) $users = [];

            return view('portal.structures.index', compact('levels', 'users'));
        }
        
        return view('portal.structures.index', compact('levels', 'users'));
    }

    public function updateStructure(Request $request)
    {
        $itemOrder = $request->itemOrder;
        $levelId = $request->level_id;

        foreach ($itemOrder as $key => $item) {
            DB::table('user_level')
                ->where('user_id', $item)
                ->where('level_id', $levelId)
                ->update([
                    'display_order' => $key + 1,
                ]);
        }
        
        return true;
    }
}
