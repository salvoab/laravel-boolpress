<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Article;

class ArticleController extends Controller
{
    public function index()
    {
        return response()->json([
            'success'=> true,
            'data'=> Article::all()
        ], 200);
    }
}
