@extends('templates.auth')

@section('page-title', 'Login')

@section('form')

    <x-form.title>Login</x-form.title>

    <x-form.form action="{{ route('login.login') }}">

        <x-form.item type="email" name="email" value="{{ old('email') }}">
            Email address
        </x-form.item>

        <x-form.item type="password" name="password" value="{{ old('password') }}">
            Password
        </x-form.item>

        <x-form.checkbox name="remember">Remember me</x-form.checkbox>

        <x-form.btn>Submit</x-form.btn>

        <div class="forgot text-center mt-2">
            <a href="{{ route('password.request') }}">Forgot password?</a>
        </div>

    </x-form.form>

@endsection
