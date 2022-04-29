@extends('templates.auth')

@section('page-title', 'Email')

@section('form')

    <x-form.title>Enter your email</x-form.title>

    <x-form.form action="{{ route('password.email') }}">

        <x-form.item type="email" name="email" value="{{ old('email') }}">
            Email address
        </x-form.item>

        <x-form.btn>Submit</x-form.btn>

    </x-form.form>

@endsection
