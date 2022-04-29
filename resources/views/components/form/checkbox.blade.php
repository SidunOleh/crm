<div class="mb-3 form-check">

    <input type="checkbox" {{ old('remember') ? 'checked' : '' }} {{ $attributes->merge([
        'class' => 'form-check-input',
    ]) }} id={{ $attributes->get('name') }}>

    <label class="form-check-label" for="{{ $attributes->get('name') }}">{{ $slot }}</label>

</div>
