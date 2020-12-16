<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;

 use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use App\Models\settings;
class Dashboard extends Controller
{
    public function index()
    {
         $article1=Article::orderBy('title','ASC')->get();
        $article = Article::all()->count();
        $category = Category::all()->count();
        $page = Page::all()->count();
        return view('back.dashboard',compact('article','category','page','article1'));
    }

  
  
}
