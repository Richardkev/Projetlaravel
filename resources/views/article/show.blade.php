@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">

            <div class="container bg-light" style="padding: 10px; background-color: #9d9d9d; margin: 20px auto; color: black;">
                <h1 class="text-center">{{ $article->title }}</h1>
                <div class="text-center">{{ $article->content }}</div>
                <span>{{ $article->created_at }}</span>
                <span class="pull-right">{{ $article->updated_at }}</span>
                @guest
                @else
                    @if((\Illuminate\Support\Facades\Auth::user()->id === $article->user_id) || \Illuminate\Support\Facades\Auth::user()->isAdmin())
                        <a class="btn btn-success" href="{{ route("articles.edit", [$article->id]) }}">Modif</a>
                        <a class="btn btn-danger" href="#" onclick="event.preventDefault();
                                document.getElementById('form-{!! $article->id !!}').submit();">Sup</a>
                        <form id="form-{{$article->id}}" method="POST" action="{{ route('articles.destroy', [$article->id]) }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                    @endif
                    @if($likes===null || $likes->isLiked($article->id) === false)
                        <form action="{{ $likes!=null ? route('like.update', [$likes->id]) : route('like.store') }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field($likes!=null ? 'PUT' : 'POST') }}
                            <input type="hidden" name="article_id" value="{{ $article->id }}">
                            <input type="submit" class="btn btn-primary" value="like">
                        </form>
                    @else
                        <form action="{{ route('like.destroy', [$likes->id])}}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="article_id" value="{{ $article->id }}">
                            <input type="submit" class="btn btn-danger" value="unlike">
                        </form>
                    @endif
                @endguest
            </div>

            @guest
                <div class="container bg-primary" style="padding: 10px; background-color: #9d9d9d; margin: 20px auto; color: black;">
                    <p class="text-center">Connectez-vous pour commenter l'article</p>
                </div>
            @else
                <div class="container bg-light row" style="padding: 10px; background-color: #9d9d9d; margin: 20px auto; color: black;">
                    <h5>Ajouter un {{ Auth::user()->id }}</h5>
                    <form action="{{ route('comments.store') }}" method="POST">

                        {{csrf_field()}}

                        <textarea id="content" type="text" class="form-control" name="content" value="{{ old('content') }}"></textarea>

                        <input type="hidden" name="article_id" value="{{ $article->id }}">

                        <button type="submit" class="btn btn-primary col-md-12" style="margin-top: 10px;">Envoyer</button>
                    </form>
                </div>
            @endguest

            @foreach($comments as $comment)
                <div class="container bg-success" style="margin-top: 20px">
                    <p>{{ $comment->content }}</p>
                    <span class="pull-right">{{ $comment->updated_at }}</span>
                    @guest
                    @else
                        @if((\Illuminate\Support\Facades\Auth::user()->id === $comment->user_id) || \Illuminate\Support\Facades\Auth::user()->isAdmin())
                            <a class="btn btn-success" href="{{ route("comments.edit", [$comment->id]) }}">Modif</a>
                            <a class="btn btn-danger" href="#" onclick="event.preventDefault();
                                    document.getElementById('form-{!! $comment->id !!}').submit();">Sup</a>
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