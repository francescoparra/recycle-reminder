<?php

namespace App\Http\Controllers;

use App\Models\Day;
use Illuminate\Http\Request;

class DaysController extends Controller
{
    public function create()
    {

        $days = [
            "monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"
        ];

        $existingDays = Day::all()->where('user_id', auth()->user()->id)->toArray();

        if (count($existingDays) > 0) {
            $existingDays = array_merge_recursive(...$existingDays)['day_name'];
        }
        /* questo if viene usato nel caso l'utente abbia solo un valore che producerebbe una stringa e quindi causerebbe un problema nel foreach di days.blade.php */
        if (is_string($existingDays)) {
            $existingDays = [$existingDays];
        }

        return view('list.days', compact('days', 'existingDays'));
    }
    public function store(Request $request)
    {
        $days = $request->validate([
            "day_name" => "required|array|min:1"
        ])["day_name"];
        
        foreach ($days as $day) {
            $newday = new Day;
            $userId = auth()->user()->id;
            $newday->user_id = $userId;
            $newday->day_name = $day;
            if (!Day::select("*") 
                    ->where("user_id", $userId)
                    ->where("day_name", $day)
                    ->exists()) {
                $newday->save();
            }   
        }

        return redirect("/category");
    }

    public function delete(){
        $existingDays = Day::all()->where('user_id', auth()->user()->id)->toArray();
        if (count($existingDays) > 0) {
            $existingDays = array_merge_recursive(...$existingDays)['day_name'];
        }
        /* questo if viene usato nel caso l'utente abbia solo un valore che producerebbe una stringa e quindi causerebbe un problema nel foreach di daysdelete.blade.php */
        if(is_string($existingDays)){
            $existingDays = [$existingDays];
        }
        $days = Day::all()->where('user_id', auth()->user()->id);
        return view('list.daydelete', compact('existingDays', 'days'));
    }

    public function destroy($id)
    {
        Day::find($id)->delete();

        return redirect('/daysdelete');
    }
}
