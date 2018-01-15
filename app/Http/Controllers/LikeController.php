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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
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

        return redirect()->to('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $like->update($request->except('_token', '_method'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
