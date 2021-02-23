<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function articles_api()
    {
        return view('spa.articles');
    }

    public function categories_api()
    {
        return view('spa.categories');
    }
}
