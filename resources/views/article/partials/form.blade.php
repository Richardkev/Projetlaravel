<form action="{{$item->exists ? route('articles.update', [$item->id]) : route('articles.store')}}" method="POST">

    {{csrf_field()}}

    {{method_field($item->exists ? 'PUT' : 'POST')}}

    <div class="form-group">
        <input class="form-control" value="{{old('title', $item->title)}}" placeholder="Titre" type="text" name="title">
    </div>

    <div class="form-group">
        <textarea name="content"
                  id=""
                  cols="30"
                  rows="10"
                  class="form-control" placeholder="Contenue">{{old('content', $item->content)}}</textarea>
    </div>

    <button class="btn btn-primary btn-block">Envoyer</button>
</form>
