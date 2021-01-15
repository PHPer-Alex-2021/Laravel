@if(count($errors)>0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger text-center" role="alert">
            <strong>{{$error}}</strong>
        </div>
    @endforeach
@endif
