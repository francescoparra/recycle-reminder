<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    public function create()
    {

        $standardCategories = [
            'plastic', 'paper', 'organic', 'glass', 'mixed', 'specials ( Furniture, etc. )'
        ];

        $existingCategories = Category::all()->where('user_id', auth()->user()->id)->toArray();

        if (count($existingCategories) > 0) {
            $existingCategories = array_merge_recursive(...$existingCategories)['cat_name'];
        }
        /* questo if viene usato nel caso l'utente abbia solo un valore che producerebbe una stringa e quindi causerebbe un problema nel array_diff */
        if (is_string($existingCategories)) {
            $existingCategories = [$existingCategories];
        }

        $diff = array_diff($existingCategories, $standardCategories);

        return view("list.category", compact('standardCategories', 'existingCategories',  'diff'));
    }

    public function store(Request $request)
    {
        $catName = $request->validate([
            "cat_name" => "required|array|min:1"
        ])['cat_name'];

        $catName = array_filter($catName);
        foreach ($catName as $category) {
            if (!empty($category) && str_contains($category, ',')) {
                $category = explode(",", $category);
            }
            /* questo if viene usato nel caso l'utente mandi solo un valore che producerebbe una stringa e quindi causerebbe un problema nel foreach */
            if (is_string($category)) {
                $category = [$category];
            }
            foreach ($category as $category) {
                $newCategory = new Category();
                $userId = auth()->user()->id;
                $newCategory->user_id = $userId;
                $newCategory->cat_name = $category;
                if (!Category::select("*")
                    ->where("user_id", $userId)
                    ->where("cat_name", strtolower($category))
                    ->exists()) {
                    $newCategory->save();
                } else {
                    throw ValidationException::withMessages(['Error!' => "That type already exists."]);
                }
            }
        }
        return redirect('/complete');
    }

    public function update()
    {
        $existingCategories = Category::all()->where('user_id', auth()->user()->id);

        return view('list.categoryupdate', compact('existingCategories'));
    }

    public function edit(Request $request, $id)
    {
        if (Category::where('cat_name', $request->category)->exists()) {
            //throw an error if the name already exists
            throw ValidationException::withMessages(['Error!' => "You cannot choose a name that already exists for your garbage category."]);
        }
        if ($request->category == ''){
            //throw an error if the name already exists
            throw ValidationException::withMessages(['Error!' => "You can't set an empty value"]);
        }
        //update the item if it doesn't
        Category::find($id)->update(['cat_name' => strtolower($request->category)]);
        return redirect('/list');
    }

    public function delete()
    {
        $existingCategories = Category::all()->where('user_id', auth()->user()->id)->toArray();
        if (count($existingCategories) > 0) {
            $existingCategories = array_merge_recursive(...$existingCategories)['cat_name'];
        }
        if (is_string($existingCategories)) {
            $existingCategories = [$existingCategories];
        }
        $categories = Category::all()->where('user_id', auth()->user()->id);
        return view('list.categorydelete', compact('existingCategories', 'categories'));
    }

    public function destroy($id)
    {
        Category::find($id)->delete();

        return redirect('/categorydelete');
    }
}
