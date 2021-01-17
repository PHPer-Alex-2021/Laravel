@foreach(['success','danger','warning'] as $t)
    @if(session()->has($t))
        <div role="alert" class="alert alert-contrast alert-{{$t}} alert-dismissible">
            <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                <span aria-hidden="true" class="mdi mdi-close"></span>
            </button>
            <div class="icon">
                @if($t == 'success')
                    <span class="mdi mdi-check"></span>
                @else
                    <span class="mdi mdi-alert-triangle"></span>
                @endif
            </div>
            <div class="message">
                <span style="color:#000000">
                     {{session()->get($t)}} <br>
                </span>
            </div>
        </div>
    @endif
@endforeach
