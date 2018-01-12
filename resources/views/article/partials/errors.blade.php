@if(count($errors)>0)
    <div class="col-xs-12 bg-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>
                    <b>{{$error}}</b>
                </li>
            @endforeach
        </ul>
    </div>
@endif