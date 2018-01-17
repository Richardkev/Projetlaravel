@extends('layouts.app')

@section('content')
    <h1 class="text-center">Articles</h1>
    <div class="bs-example container" data-example-id="hoverable-table">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($articles as $article)
                <tr>
                    <th scope="row">{{ $article->id }}</th>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->who($article->user_id) }}</td>
                    <td>
                        <div class="btn-group">
                        <a class="btn btn-primary" href="{{ route("articles.show", [$article->id]) }}">Voir</a>
                        <a class="btn btn-success" href="{{ route("articles.edit", [$article->id]) }}">Modif</a>
                        <a class="btn btn-danger" href="#" onclick="event.preventDefault();
                                document.getElementById('form-{!! $article->id !!}').submit();">Sup</a>
                        </div>
                        <form class="pull-left" id="form-{{$article->id}}" method="POST" action="{{ route('articles.destroy', [$article->id]) }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection