<form {{ $attributes->merge([
    'method'  => 'POST',
    'enctype' => 'application/x-www-form-urlencoded',
    'class'   => 'form',
])  }}>

    @if (session('status'))
       
        @if (session('status') == 'ok')
             <div class="alert alert-success">
        @elseif (session('status') == 'error')
            <div class="alert alert-danger">
        @endif
            
            {{ session('message') }}
        
        </div>
    
    @endif

    @csrf

    {{ $slot }}

</form>
