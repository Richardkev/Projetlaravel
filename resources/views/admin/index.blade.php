@extends('layouts.app')

@section('content')
    <h1 class="text-center">Administration</h1>
    <div class="container">
        <a class="admin-link" href="{{ route('admin.users') }}">
            <div class="col-xs-5 admin-panel">
                <h3 class="text-center">Users</h3>
            </div>
        </a>
        <a class="admin-link" href="{{ route('admin.articles') }}">
            <div class="col-xs-5 col-xs-offset-2 admin-panel">
                <h3 class="text-center">Articles</h3>
            </div>
        </a>
    </div>
@endsection