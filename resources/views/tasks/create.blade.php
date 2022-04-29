@extends('templates.panel')

@section('page-title', 'task Create')

@section('content')

    <section class="task-create">

        <h1 class="form-title">Input task data</h1>

        <x-form.form action="{{ route('tasks.store') }}" class="task-create__form">

            <x-form.item type="text" name="name" value="{{ old('name') }}">
                Name
            </x-form.item>

            <x-form.item type="textarea" name="description" value="{{ old('description') }}">
                Description
            </x-form.item>

            <x-form.item type="text" name="deadline" value="{{ old('deadline') ? date('d/m/Y', strtotime(old('deadline'))) : '' }}" class="tcal">
                Deadline
            </x-form.item>


            <x-form.btn>Create Task</x-form.btn>

        </x-form.form>

    </section>

@endsection
