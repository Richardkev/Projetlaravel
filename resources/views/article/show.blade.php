@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">

            <div class="container bg-light article">
                <h1 class="text-center">{{ $article->title }}</h1>
                <div class="text-center">{{ $article->content }}</div>
                <div class="container">
                    <ul class="list-unstyled">
                        <li><em>écrit le : {{ $article->created_at }}</em></li>
                        <li><em>par : {{ $article->who($article->user_id) }}</em></li>
                        <li><em>Modifié le : {{ $article->updated_at }}</em></li>
                    </ul>
                </div>
                @guest
                @else
                    <div class="btn-article">
                    @if((\Illuminate\Support\Facades\Auth::user()->id === $article->user_id) || \Illuminate\Support\Facades\Auth::user()->isAdmin())
                        <div class="btn-group">
                        <a class="btn btn-success" href="{{ route("articles.edit", [$article->id]) }}">Modif</a>
                        <a class="btn btn-danger" href="#" onclick="event.preventDefault();
                                document.getElementById('form-{!! $article->id !!}').submit();">Sup</a>
                        </div>
                        <form class="pull-left" id="form-{{$article->id}}" method="POST" action="{{ route('articles.destroy', [$article->id]) }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                    @endif
                    @if($likes===null || $likes->isLiked($article->id) === false)
                        <form class="pull-right" action="{{ $likes!=null ? route('like.update', [$likes->id]) : route('like.store') }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field($likes!=null ? 'PUT' : 'POST') }}
                            <input type="hidden" name="article_id" value="{{ $article->id }}">
                            <input type="submit" class="btn btn-primary" value="like">
                        </form>
                    @else
                        <form class="pull-right" action="{{ route('like.destroy', [$likes->id])}}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="article_id" value="{{ $article->id }}">
                            <input type="submit" class="btn btn-danger" value="unlike">
                        </form>
                    @endif
                    </div>
                @endguest
            </div>

            @guest
                <div class="container bg-primary comment">
                    <p class="text-center">Connectez-vous pour commenter l'article</p>
                </div>
            @else
                <div class="container bg-light row comment">
                    <label for="content">Ajouter un commentaire</label>
                    <form action="{{ route('comments.store') }}" method="POST">

                        {{csrf_field()}}
                        <textarea id="content" type="text" class="form-control" name="content" value="{{ old('content') }}"></textarea>

                        <input type="hidden" name="article_id" value="{{ $article->id }}">

                        <button type="submit" class="btn btn-primary col-md-12 btn-comment">Envoyer</button>
                    </form>
                </div>
            @endguest

            @foreach($comments as $comment)
                <div class="container bg-success comments">
                    <p>{{ $comment->content }}</p>
                    <ul class="pull-right list-unstyled">
                        <li><em>écrit le : {{ $comment->updated_at }}</em></li>
                        <li><em>par : {{ $article->who($comment->user_id) }}</em></li>
                    </ul>
                    @guest
                    @else
                        @if((\Illuminate\Support\Facades\Auth::user()->id === $comment->user_id) || \Illuminate\Support\Facades\Auth::user()->isAdmin())
                            <div class="btn-group">
                            <a class="btn btn-success" href="{{ route("comments.edit", [$comment->id]) }}">Modif</a>
                            <a class="btn btn-danger" href="#" onclick="event.preventDefault();
                                    document.getElementById('form-{!! $comment->id !!}').submit();">Sup</a>
                            </div>
                            <form id="form-{{$comment->id}}" method="POST" action="{{ route('comments.destroy', [$comment->id]) }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                        @endif
                    @endguest
                </div>
            @endforeach


        </div>
    </div>
@endsection