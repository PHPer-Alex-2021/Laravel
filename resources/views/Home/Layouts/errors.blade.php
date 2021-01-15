{{--@if(count($errors)>0)--}}
@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            <strong>{{$error}}</strong>
        </div>
    @endforeach
@endif
