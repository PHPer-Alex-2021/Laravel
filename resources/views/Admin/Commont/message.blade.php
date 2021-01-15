@foreach(['success','danger'] as $t)
    @if(session()->has($t))
        <div class="alert alert-{{$t}} text-center" role="alert">
            <strong>{{session()->get($t)}}</strong>
        </div>
    @endif
@endforeach
