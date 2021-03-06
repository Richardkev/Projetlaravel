<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use App\Like;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        $datas = collect();

        if ($user->is_admin == true){
            $bool = false;
        }
        else{
            $bool = true;
        }
        $datas = $datas->put('is_admin', $bool);
        $user->update($datas->toArray());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $articles = Article::where('user_id', $user->id)->get();
        foreach ($articles as $article) {
            $comments = comment::where('article_id', $article->id)->get();
            foreach ($comments as $comment) {
                $comment->delete();
            }
            $likes = like::all();
            foreach ($likes as $like) {
                if ($like->isLiked($article->id) === true) {
                    $articlesId = $like->unlike($article->id);
                    $datas      = collect();
                    $datas      = $datas->put('articles_id', $articlesId);

                    $like->update($datas->toArray());

                    if ($like->articles_id === ',' || $like->articles_id === null) {
                        $like->delete();
                    }
                }
            }
            $article->delete();
        }
        $user->delete();

        return redirect()->back();
    }
}
