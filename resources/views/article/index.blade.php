@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <h1 class="text-center">Articles</h1>
            @foreach( $articles as $article )
                <a class="articles-link" href="{{ route('articles.show', [$article->id]) }}">
                    <div class="container articles">
                    <h3 class="text-center">{{ $article->title }}</h3>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

@endsection