@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('comment.partials.errors')
            <div class="col-xs-12 panel">
                <div class="panel-heading">Modification du commentaire</div>
                @include('comment.partials.form', ['item' => $comment])
            </div>
        </div>
    </div>
@endsection