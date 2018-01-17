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
                <th>Role</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->is_admin ? 'admin' : 'user' }}</td>
                    <td>
                        @if(\Illuminate\Support\Facades\Auth::user()->id != $user->id)
                        <div class="btn-group">
                            <a class="btn btn-primary" href="#" onclick="event.preventDefault();
                                    document.getElementById('form_{!! $user->id !!}').submit();">{{ $user->is_admin ? 'to user' : 'to admin' }}</a>
                            <a class="btn btn-danger" href="#" onclick="event.preventDefault();
                                    document.getElementById('form-{!! $user->id !!}').submit();">Sup</a>
                        </div>
                        <form id="form_{{$user->id}}" method="POST" action="{{ route('users.update', [$user->id]) }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                        </form>
                        <form id="form-{{$user->id}}" method="POST" action="{{ route('users.destroy', [$user->id]) }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                        @else
                            Vous ne pouvez pas vous auto-modifier
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection