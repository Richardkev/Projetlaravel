<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use App\Http\Requests\ArticleRequest;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create','edit','store','update','destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles  = Article::all();

        return view('article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $article = new Article();

        return view('article.create', compact('article'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArticleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $datas = collect($request->except('_token', '_method'));

        $userId = Auth::user()->id;

        $datas = $datas->put('user_id', $userId);

        article::create($datas->toArray());

        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Article $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $comments  = comment::where('article_id', $article->id)->get();
        $item = new Comment();
        if (Auth::check() && Like::where('user_id', Auth::user()->id)->first()!=null){
            $likes = Like::where('user_id', Auth::user()->id)->first();
        }
        else{
            $likes = null;
        }

        return view('article.show', compact('article', 'comments','item','likes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Article $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArticleRequest $request
     * @param Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $article->update($request->except('_token', '_method'));

        return redirect()->route('articles.show', [$article->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Article $article)
    {
        $comments  = comment::where('article_id', $article->id)->get();
        foreach ($comments as $comment){
            $comment->delete();
        }
        $likes = like::all();
        foreach ($likes as $like){
            if ($like->isLiked($article->id) === true){
                $articlesId = $like->unlike($article->id);
                $datas = collect();
                $datas = $datas->put('articles_id', $articlesId);

                $like->update($datas->toArray());

                if ($like->articles_id === ',' || $like->articles_id === null){
                    $like->delete();
                }
            }
        }
        $article->delete();

        return redirect()->route('articles.index');
    }
}
