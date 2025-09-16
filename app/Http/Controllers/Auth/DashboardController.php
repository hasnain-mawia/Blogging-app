<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\categories;
use App\Models\posts;
use App\Models\tags;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function dashboard(){

    $postCount = posts::count();  
    $tagCount = tags::count();  
    $categoryCount = categories::count();  
    $userCount = User::count();  
    return view('auth.dashboard', compact('postCount', 'tagCount', 'categoryCount', 'userCount'));
   }
}
