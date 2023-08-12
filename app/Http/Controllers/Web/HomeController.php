<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class HomeController extends Controller
{
    public function index(){
        $user = Auth::user();
        $user_categories = $user->categories;
        $categories = Category::whereNotIn('id', $user_categories->pluck('id'))->get();
        $categories = $categories->concat($user_categories);
        
        foreach($categories as $category){
             $category->im_path = URL::to('').'/storage/'.$category->image_path;

            if(!$category->pivot){
                $category->pivot = [
                    'user_id' => $user->id,
                    'category_id' => $category->id,
                    'score' => 0,
                    'total' => $category->data()->count()
                ];
            }
        }
        return view('user.home', get_defined_vars());
    }
}
