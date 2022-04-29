@extends('templates.auth')

@section('page-title', 'Change password')

@section('form')

    <x-form.title>Change password</x-form.title>

    <x-form.form action="{{ route('password.new') }}">

        <x-form.item type="password" name="password" value="{{ old('password_old') }}">
            Old password
        </x-form.item>

        <x-form.item type="password" name="password_new" value="{{ old('password') }}">
            New password
        </x-form.item>

        <x-form.item type="password" name="password_new_confirmation" value="{{ old('password_confirmation') }}">
            Password confirmation
        </x-form.item>


        <x-form.btn>Reset</x-form.btn>

    </x-form.form>

@endsection
