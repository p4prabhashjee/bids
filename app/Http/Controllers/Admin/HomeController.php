<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Blog;




class HomeController extends Controller
{
    function index() : View {
        $users = User::where('role', '=', 2)->count();
        $blogs=Blog::count() ;
        return view('admin.dashboard',compact('users','blogs'));
    }
}