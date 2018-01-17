@extends('layouts.app')

@section('content')
    <h1 class="text-center">Administration</h1>
    <div class="container">
        <a href="{{ route('admin.users') }}" style="text-decoration: none; color: black">
            <div class="col-xs-5 bg-info" style="margin-top: 20%; padding: 8vh 0">
                <h3 class="text-center">Users</h3>
            </div>
        </a>
        <a href="{{ route('admin.articles') }}" style="text-decoration: none; color: black">
            <div class="col-xs-5 col-xs-offset-2 bg-danger" style="margin-top: 20%; padding: 8vh 0">
                <h3 class="text-center">Articles</h3>
            </div>
        </a>
    </div>
@endsection