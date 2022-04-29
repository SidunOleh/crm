@extends('templates.auth')

@section('page-title', 'Registration')

@section('form')

    <x-form.title>Registration</x-form.title>

    <x-form.form action="{{ route('reg.store') }}">

        <x-form.item type="email" name="email" value="{{ old('email') }}">
            Email address
        </x-form.item>

        <x-form.item type="password" name="password" value="{{ old('password') }}">
            Password
        </x-form.item>

        <x-form.item type="text" name="company" value="{{ old('company') }}">
            Name of your company
        </x-form.item>

        <p class="text-secondary">By registering, you agree to the Terms of Use and Privacy Policy</p>

       <x-form.btn>Submit</x-form.btn>

    </x-form.form>

@endsection
