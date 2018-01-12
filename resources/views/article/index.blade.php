@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <h1>Articles</h1>
            @foreach( $articles as $article )
                <div class="container" style="padding: 10px; background-color: #9d9d9d">
                    <h3 class="text-center">{{ $article->title }}</h3>
                    <div>{{ $article->content }}</div>
                    <span>{{ $article->created_at }}</span>
                    <span>{{ $article->updated_at }}</span>
                </div>
            @endforeach
        </div>
    </div>
@endsection