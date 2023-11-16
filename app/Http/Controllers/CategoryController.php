<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function get_subs(Request $request)
    {
        $request->validate([
            'category_id' => 'required'
        ]);
        $cat = Category::where('category_id', $request->category_id)->get();
        return response()->json([
            'sub_categories' => $cat
        ]);
    }
}
