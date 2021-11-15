<?php

namespace App\Http\Controllers;

use App\Models\Lists;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ListController extends Controller
{
    public function create()
    {
        $categories = DB::table('categories')->where("user_id", auth()->user()->id)->get();
        $days = DB::table('days')->where("user_id", auth()->user()->id)->get();

        $existing_list = Lists::all()->where("user_id", auth()->user()->id);

        return view('list.complete', [
            'category' => $categories,
            'days' => $days,
        ], compact('existing_list'));
    }
    public function store()
    {

        $lists = request()->validate([
            "list" => "required|array|min:1"
        ])["list"];

        function savefunc($list)
        {
            $user_id = auth()->user()->id;
            $day_id = $list[0];
            $category_id = $list[1];
            $handle_error = $list[2] ?? $list[2];
            $list_time = $handle_error;
            $newlist = new Lists;
            $newlist->user_id = $user_id;
            $newlist->day_id = $day_id;
            $newlist->category_id = $category_id;
            $newlist->time = $list_time;
            $day = ucfirst(DB::table('days')->where('id', $day_id)->value('day_name'));
            if (!Lists::select("*")
                ->where("day_id", $day_id)
                ->where("category_id", $category_id)
                ->exists()) {
                $newlist->save();
            } else {
                throw ValidationException::withMessages(['Error!' =>
                "A collection already exists on {$day} at {$list_time}."]);
            }
        }

        foreach ($lists as $list) {
            if ($list == null) {
                return back()->withErrors(['msg' => 'You have to fill in all the fields.']);
            }
            if (strlen($list) > 22) {
                return back()->withErrors(['msg' => 'The time field can be up to 22 characters long.']);
            }
        }

        if (count($lists) > 3) {
            $lists = array_chunk($lists, 3);
            foreach ($lists as $list) {
                savefunc($list);
            }
        }

        savefunc($lists);
        return redirect('/list');
    }
    public function show()
    {
        $lists = Lists::all()->where("user_id", auth()->user()->id);

        foreach ($lists as $list) {
            $list->day = ucfirst(DB::table('days')->where('id', $list->day_id)->value('day_name'));
            $list->category = ucfirst(DB::table('categories')->where('id', $list->category_id)->value('cat_name'));
        }

        return view('list.show', compact("lists"));
    }
    public function destroy($id)
    {

        $list = Lists::findOrFail($id);
        $list->delete();

        return redirect('/list');
    }
}
