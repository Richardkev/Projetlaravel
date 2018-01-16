<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikeRequest;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
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
     * @param LikeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(LikeRequest $request)
    {
        $datas = collect($request->except('_token', '_method', 'article_id'));

        $userId = Auth::user()->id;

        $table = $request->only('article_id');
        $articlesId = $table['article_id'];

        $datas = $datas->put('user_id', $userId)->put('articles_id', $articlesId);

        like::create($datas->toArray());

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
     * @param LikeRequest $request
     * @param Like $like
     * @return \Illuminate\Http\Response
     */
    public function update(LikeRequest $request, Like $like)
    {
        $datas = collect($request->except('_token', '_method','article_id'));

        $table = $request->only('article_id');
        $articlesId = $like->articles_id.','.$table['article_id'];

        $datas = $datas->put('articles_id', $articlesId);

        $like->update($datas->toArray());

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param LikeRequest $request
     * @param Like $like
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(LikeRequest $request, Like $like)
    {
        $datas = collect($request->except('_token', '_method','article_id'));

        $table = $request->only('article_id');
        $articlesId = $like->unlike($table['article_id']);

        $datas = $datas->put('articles_id', $articlesId);

        $like->update($datas->toArray());

        if ($like->articles_id === ',' || $like->articles_id === null){
            $like->delete();
        }

        return redirect()->back();
    }
}
