<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected function welcomePage()
    {
        $articles  = Article::all();

        return view('article.index', compact('articles'));
    }
}
