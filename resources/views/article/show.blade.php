@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="container bg-light" style="padding: 10px; background-color: #9d9d9d; margin: 20px auto; color: black;">
                <h1 class="text-center">{{ $article->title }}</h1>
                <div class="text-center">{{ $article->content }}</div>
                <span>{{ $article->created_at }}</span>
                <span class="pull-right">{{ $article->updated_at }}</span>
            </div>
        </div>
    </div>
@endsection