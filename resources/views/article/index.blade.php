@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <h1 class="text-center">Articles</h1>
            @foreach( $articles as $article )
                    <div class="container bg-info" style="padding: 10px; margin: 20px auto">
                        <a href="{{ route('articles.show', [$article->id]) }}" style="text-decoration: none; color: black">
                            <h3 class="text-center">{{ $article->title }}</h3>
                        </a>
                    </div>
            @endforeach
        </div>
    </div>

    <form action="{{ route('like.store') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('POST') }}
        <input type="hidden" name="article_id" value="1">
        <input type="submit" class="btn btn-primary" value="like">
    </form>
@endsection