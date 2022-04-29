@extends('templates.panel')

@section('page-title', 'User Create')

@section('content')

    <section class="user-create">

        <x-form.form action="{{ route('users.store') }}" class="user-create__form">

            <x-form.item type="email" name="email" value="{{ old('email')  }}">
                Email
            </x-form.item>

            <x-form.btn>Send invitation</x-form.btn>

        </x-form.form>

    </section>

@endsection
