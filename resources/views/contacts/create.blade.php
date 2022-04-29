@extends('templates.panel')

@section('page-title', 'Contact Create')

@section('content')

    <section class="contact-create">

        <h1 class="form-title">Input contact data</h1>

        <x-form.form action="{{ route('contacts.store') }}" class="contact-create__form">

            <x-form.item type="email" name="email" value="{{ old('email') }}">
                Email
            </x-form.item>

            <x-form.item type="text" name="name" value="{{ old('name') }}">
                Name
            </x-form.item>

            <x-form.item type="text" name="surname" value="{{ old('surname') }}">
                Surname
            </x-form.item>

            <x-form.item type="tel" name="phone" value="{{ old('phone') }}">
                Mobile Phone
            </x-form.item>

            <x-select.list name="type" options="partner,agent,client">              
               Type
            </x-select.list>

            <x-form.btn>Create Contact</x-form.btn>

        </x-form.form>

    </section>

@endsection
