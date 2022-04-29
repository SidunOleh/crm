@props(['status',])

<div class="mb-3">

    <div  {{ $attributes->merge([
        'class' => 'form-check form-switch',
    ]) }} id="switch-active">
        
        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $status ? 'checked' : '' }}>
        <label class="form-check-label" for="flexSwitchCheckDefault">{{ $slot }}</label>

    </div>

</div>
