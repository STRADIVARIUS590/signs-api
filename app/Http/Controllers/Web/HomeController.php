<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $user = Auth::user();
        $user_categories = $user->categories;
        $categories = Category::whereNotIn('id', $user_categories->pluck('id'))->get();
        $categories = $categories->concat($user_categories);
        
        foreach($categories as $category){
            if(!$category->pivot){
                $category->pivot = [
                    'user_id' => $user->id,
                    'category_id' => $category->id,
                    'score' => 0
                ];
            }
        }
        $categories = $categories->sort();
        return $categories;
    }
}
