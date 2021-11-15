<?php

namespace App\Http\Controllers;

use App\Models\Day;

class DaysController extends Controller
{
    public function create()
    {

        $days = [
            "monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"
        ];

        $existing_days = Day::all()->where('user_id', auth()->user()->id);

        $array = $existing_days->toArray();
        if (count($array)>0) {
            $names = array_merge_recursive ( ...$array )['day_name'];
        } else {
            $names = [];
        }
        if (is_string($names)) {
            $names = [$names];
        }

        return view('list.days', compact('days', 'names', 'existing_days'));
    }
    public function store()
    {
        $days = request()->validate([
            "day_name" => "required|array|min:1"
        ])["day_name"];
        
        foreach ($days as $day) {
            $newday = new Day;
            $user_id = auth()->user()->id;
            $newday->user_id = $user_id;
            $newday->day_name = $day;
            if (!Day::select("*") 
                    ->where("user_id", $user_id)
                    ->where("day_name", $day)
                    ->exists()) {
                $newday->save();
            }   
        }

        return redirect("/category");
    }

    public function delete(){
        $existing_days = Day::all()->where('user_id', auth()->user()->id);
        $array = $existing_days->toArray();
        if (count($array)>0) {
            $names = array_merge_recursive ( ...$array )['day_name'];
        } else {
            $names = [];
        }
        if (is_string($names)) {
            $names = [$names];
        }
        return view('list.daydelete', compact('existing_days', 'names'));
    }

    public function destroy($id)
    {
        $day = Day::findOrFail($id);
        $day->delete();

        return redirect('/daysdelete');
    }
}
