<li class="list-group-item list-group-item-primary m-0 py-3 text-center bg-info opacity-80
    {{ url()->current() == $attributes->get('href') ? 'active' : '' }}">

    <a {{ $attributes->merge([
        'class' => 'h4 text-decoration-none text-white',
    ]) }}>

        {{ $slot }}

    </a>

    {{ $droplist ?? '' }}

</li>
