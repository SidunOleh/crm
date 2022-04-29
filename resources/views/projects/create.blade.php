@extends('templates.panel')

@section('page-title', 'Project Create')

@section('content')

    <section class="project-create">

        <h1 class="form-title">Input project data</h1>

        <x-form.form action="{{ route('projects.store') }}" class="project-create__form">

            <x-form.item type="text" name="name" value="{{ old('name') }}">
                Name
            </x-form.item>

            <x-form.item type="textarea" name="description" value="{{ old('description') }}">
                Description
            </x-form.item>

            <x-select.list name="status" options="in process,implemented,not implemented">              
               Status
            </x-select.list>

            <x-form.btn>Create project</x-form.btn>

        </x-form.form>

    </section>

@endsection
