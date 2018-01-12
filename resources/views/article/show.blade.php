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

            @foreach($comments as $comment)
                <div class="container bg-success">
                    <p>{{ $comment->content }}</p>
                    <span>{{ $comment->updated_at }}</span>
                </div>
            @endforeach

            <div class="container bg-light row" style="padding: 10px; background-color: #9d9d9d; margin: 20px auto; color: black;">
                <h5>Ajouter un commentaire</h5>
                <form action="{{ route('comments.store') }}" method="POST">

                    {{csrf_field()}}

                    <textarea id="content" type="text" class="form-control" name="content" value="{{ old('content') }}"></textarea>

                    <input type="hidden" name="article_id" value="{{ $article->id }}">

                    <button type="submit" class="btn btn-primary col-md-12" style="margin-top: 10px;">Envoyer</button>
                </form>
            </div>

        </div>
    </div>
@endsection