<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // get all categories
    public function getAll(){
        $categories = Category::all();
        return response()->json([
            'status' => 'success',
            'data' => $categories,
        ], 200);
    }
}
