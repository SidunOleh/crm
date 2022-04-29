<div class="mb-3">

    @error('avatar')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="avatar d-flex align-items-center">

        <div class="avatar__img flex-shrink-0">

            <img {{ $attributes->merge([
                        'src' => asset('image/avatars/default.png'),
                 ]) }}>

        </div>

        <div class="avatar__input ps-3 d-flex flex-column">

            <label for="avatar" class="pb-2" for="avatar">{{ $slot }}</label>

            <input type="file" name="avatar" id="avatar">

        </div>

    </div>

</div>
