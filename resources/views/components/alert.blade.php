<div>
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @elseif(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <div>
                @foreach ($errors->all() as $error)
                    <p> {{ $error }} </p>
                @endforeach
            </div>
        </div>
    @endif
</div>