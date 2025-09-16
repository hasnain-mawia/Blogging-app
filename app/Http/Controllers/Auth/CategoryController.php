<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function openCategoriesPage(){
        
        $categories = categories::all();
        return view( 'auth.categories.index', compact('categories'));
    }
}
