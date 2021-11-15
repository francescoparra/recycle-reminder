<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    public function create(){
        
        $standard_categories=[
            'plastic', 'paper', 'organic', 'glass', 'mixed', 'specials ( Furniture, etc. )'
        ];

        $existing_categories= Category::all()->where('user_id', auth()->user()->id)->toArray();
        if (count($existing_categories)>0) {
            $existing_categories = array_merge_recursive ( ...$existing_categories )['cat_name'];
        } else {
            $existing_categories = [];
        }
        if (is_string($existing_categories)) {
            $existing_categories = [$existing_categories];
        }

        $diff = array_diff($existing_categories, $standard_categories);

        $category = Category::all();

        return view("list.category", compact('standard_categories', 'existing_categories', 'category', 'diff'));
    }
    public function store()
    {
        function recursive_add($array) {
            $array = array_filter($array);
            foreach ($array as $category) {
                if (!empty($category) && str_contains($category, ',')) {
                    $arr = explode(",", $category);
                    recursive_add($arr);
                    continue;
                }
                $new_category = new Category();
                $user_id = auth()->user()->id;
                $new_category->user_id = $user_id;
                $new_category->cat_name = $category;
                if (!Category::select("*")
                    ->where("user_id", $user_id)
                    ->where("cat_name", strtolower($category))
                    ->exists()) {                
                    $new_category->save();
                } else {
                    throw ValidationException::withMessages(['Error!' => "That type already exists."]);
                }
            };
        };

        $cat_name = request()->validate([
            "cat_name" => "required|array|min:1"
        ])['cat_name'];
        
        recursive_add($cat_name);
        
        return redirect('/complete');
    }

    public function delete(){
        $existing_categories= Category::all()->where('user_id', auth()->user()->id)->toArray();
        if (count($existing_categories)>0) {
            $existing_categories = array_merge_recursive ( ...$existing_categories )['cat_name'];
        } else {
            $existing_categories = [];
        }
        if (is_string($existing_categories)) {
            $existing_categories = [$existing_categories];
        }
        $categories = Category::all()->where('user_id', auth()->user()->id);
        return view('list.categorydelete', compact('existing_categories', 'categories'));
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        
        return redirect('/categorydelete');
    }
}
