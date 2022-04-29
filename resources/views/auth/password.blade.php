@extends('templates.auth')

@section('page-title', 'Reset password')

@section('form')

    <x-form.title>Reset password</x-form.title>

    <x-form.form action="{{ route('password.update') }}">

        <x-form.item type="email" name="email" value="{{ old('email') }}">
            Email address
        </x-form.item>

        <x-form.item type="password" name="password" value="{{ old('password') }}">
            Password
        </x-form.item>

        <x-form.item type="password" name="password_confirmation" value="{{ old('password_confirmation') }}">
            Password confirmation
        </x-form.item>

        <input type="hidden" name="token" value="{{ $token }}">


        <x-form.btn>Reset</x-form.btn>

    </x-form.form>

@endsection
