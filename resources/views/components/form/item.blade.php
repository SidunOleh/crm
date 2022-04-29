<div class="mb-3">

    @error($attributes->get('name'))
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror


    @if(!empty($slot->__toString()))
        <label class="form-label">{{ $slot }}</label>
    @endif

    @if($attributes->get('type') == 'textarea')

        <textarea {{ $attributes->merge([
            'class' => 'form-control',
        ]) }}>{{ $attributes->get('value') }}</textarea>
    
    @else
       
        <input {{ $attributes->merge([
            'class' => 'form-control',
        ]) }}>
    
    @endif

</div>
