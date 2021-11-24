<?php

namespace App\Http\Controllers;

use App\Models\GarbageSchedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class GarbageScheduleController extends Controller
{
    public function create()
    {
        $categories = DB::table('categories')->where("user_id", auth()->user()->id)->get();
        $days = DB::table('days')->where("user_id", auth()->user()->id)->get();

        $existingList = GarbageSchedule::all()->where("user_id", auth()->user()->id);

        return view('list.complete', [
            'category' => $categories,
            'days' => $days,
        ], compact('existingList'));
    }
    public function store()
    {
        $lists = request()->validate([
            "list" => "required|array|min:1"
        ])["list"];

        foreach ($lists as $list) {
            if ($list == null) {
                return back()->withErrors(['msg' => 'You have to fill in all the fields.']);
            }
            if (strlen($list) > 22) {
                return back()->withErrors(['msg' => 'The time field can be up to 22 characters long.']);
            }
        }
        $lists = array_chunk($lists, 3);
        foreach ($lists as $list) {
            $userId = auth()->user()->id;
            $dayId = $list[0];
            $categoryId = $list[1];
            $handleError = $list[2] ?? $list[2];
            $listTime = $handleError;
            $newlist = new GarbageSchedule();
            $newlist->user_id = $userId;
            $newlist->day_id = $dayId;
            $newlist->category_id = $categoryId;
            $newlist->time = $listTime;
            if (!GarbageSchedule::select("*")
                ->where("day_id", $dayId)
                ->where("category_id", $categoryId)
                ->exists()) {
                $newlist->save();
            } else {
                $day = ucfirst(DB::table('days')->where('id', $dayId)->value('day_name'));
                throw ValidationException::withMessages(['Error!' =>
                "A collection already exists on {$day} at {$listTime}."]);
            }
        }

        return redirect('/list');
    }

    public function show()
    {
        $lists = GarbageSchedule::all()->where("user_id", auth()->user()->id);

        foreach ($lists as $list) {
            $list->day = ucfirst(DB::table('days')->where('id', $list->day_id)->value('day_name'));
            $list->category = ucfirst(DB::table('categories')->where('id', $list->category_id)->value('cat_name'));
        }

        return view('list.show', compact("lists"));
    }
    public function destroy($id)
    {
        $list = GarbageSchedule::find($id);
        $list->delete();

        return redirect('/list');
    }
}
