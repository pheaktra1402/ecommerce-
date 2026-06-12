<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class UserController extends Controller
{

     public function index() {
        $categories = Category::all();
        return view('category.index')->with('categories', $categories);
    }


    public function show($id)
    {
        return "User ID is " . $id . " (from UserController)";
    }
}
