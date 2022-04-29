@extends('templates.panel')

@section('page-title', 'Profile')

@section('content')

    <section class="panel__main">

        <x-form.form action="{{ route('users.update', ['user'=>$user->id]) }}" enctype="multipart/form-data" class="profile__form">

            @method('PUT')

            <x-form.avatar src="{{ $user->avatar ? '/storage/' . $user->avatar : asset('image/avatars/default.png') }}">
                Change avatar
            </x-form.avatar>

            <div class="profile__email py-2 h4">{{ $user->email }}</div>

            <x-form.item type="text" name="name" value="{{ old('name') ?? $user->name }}">
                Name
            </x-form.item>

            <x-form.item type="text" name="surname" value="{{ old('surname') ?? $user->surname }}">
                Surname
            </x-form.item>

            <x-form.item type="text" name="phone" value="{{ old('phone') ?? $user->phone }}">
                Mobile Phone
            </x-form.item>

            <x-form.btn>Update</x-form.btn>

        </x-form.form>

    </section>

@endsection
