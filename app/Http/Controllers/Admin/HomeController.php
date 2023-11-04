<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Project;
use App\Models\Product;
use App\Models\Category;






class HomeController extends Controller
{
    function index() : View {
        $users = User::where('role', '=', 2)->count();
        $projects=Project::where('status', 1)->count() ;
        $products=Product::where('status', 1)->count() ;
        $cats=Category::where('status', 1)->count() ;


        return view('admin.dashboard',compact('users','projects','products','cats'));
    }
}