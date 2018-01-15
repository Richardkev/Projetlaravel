<form action="{{ route('comments.update', [$item->id]) }}" method="POST">

    {{csrf_field()}}

    {{method_field('PUT')}}

    <div class="form-group">
        <textarea name="content"
                  id=""
                  cols="30"
                  rows="3"
                  class="form-control" placeholder="Contenue">{{old('content', $item->content)}}</textarea>
    </div>

    <input type="hidden" name="article_id" value="{{ $item->article_id }}">

    <button class="btn btn-primary btn-block">Modifier</button>
</form>
