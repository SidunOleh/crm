<div class="search-form">

    <x-form.form action="{{ $attributes->get('action') }}" method="GET">

        <x-form.item name="search" value="{{ old('search') }}" placeholder="Search"/>

    </x-form.form>

</div>
