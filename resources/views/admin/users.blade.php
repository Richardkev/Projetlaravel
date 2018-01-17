@extends('layouts.app')

@section('content')
    <h1 class="text-center">Users</h1>
    <div class="bs-example container" data-example-id="hoverable-table">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>E-mail</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a class="btn btn-danger" href="#" onclick="event.preventDefault();
                                document.getElementById('form-{!! $user->id !!}').submit();">Sup</a>
                        <form id="form-{{$user->id}}" method="POST" action="{{ route('users.destroy', [$user->id]) }}">
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