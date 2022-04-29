@extends('templates.panel')

@include('includes.modals.sure')

@section('page-title', 'Edit Contact')

@section('content')

    <section class="contact position-relative">

        <div class="author pb-3 h6">
           Author: <a href="{{ route('users.show', ['user'=>$contact->user_id]) }}">{{$contact->user->email }}</a>
        </div>


        <x-form.switch url="/contacts/activity/{{ $contact->id }}" status="{{ $contact->is_active }}">
            active/inactive
        </x-form.switch>

        <x-form.form action="{{ route('contacts.update', ['contact'=>$contact->id]) }}" enctype="multipart/form-data" class="contact-update__form">

            @method('PUT')

            <x-form.item type="email" name="email" value="{{ old('email') ?? $contact->email }}">
                Email
            </x-form.item>

            <x-form.item type="text" name="name" value="{{ old('name') ?? $contact->name }}">
                Name
            </x-form.item>

            <x-form.item type="text" name="surname" value="{{ old('surname') ?? $contact->surname }}">
                Surname
            </x-form.item>

            <x-form.item type="text" name="phone" value="{{ old('phone') ?? $contact->phone }}">
                Mobile Phone
            </x-form.item>

            <x-select.list name="type" options="{{ implode(',', array_unique([$contact->type, 'partner', 'agent', 'client', ])) }}">           
               Type
            </x-select.list>

            <x-form.btn>Edit Contact</x-form.btn>

        </x-form.form>

        <form method="POST" action="{{ route('contacts.destroy', ['contact'=>$contact->id]) }}" class="form-delete" id="form-delete">
            
            @csrf

            @method('DELETE')

            <button type="submit" class="btn btn-danger" id="btn-delete" data-bs-toggle="modal" data-bs-target="#exampleModal">
                X
            </button>

        </form>

    </section>

@endsection
