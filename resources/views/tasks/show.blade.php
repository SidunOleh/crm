@extends('templates.panel')

@include('includes.modals.sure')

@section('page-title', 'Edit Task')

@section('content')

    <section class="task position-relative">

        <div class="author pb-3 h6">
           Author: <a href="{{ route('users.show', ['user'=>$task->user_id]) }}">{{$task->user->email }}</a>
        </div>

        <x-form.form action="{{ route('tasks.update', ['task'=>$task->id]) }}" enctype="multipart/form-data" class="task-update__form">

            @method('PUT')

            <x-form.item type="text" name="name" value="{{ old('name') ?? $task->name }}">
                Name
            </x-form.item>

            <x-form.item type="textarea" name="description" value="{{ old('description') ?? $task->description }}">
                Description
            </x-form.item>

            <x-form.item type="text" name="deadline" value="{{ old('deadline') ? date('d/m/Y', strtotime(old('deadline'))) : date('m/d/Y', strtotime($task->deadline)) }}" class="tcal">
                Deadline
            </x-form.item>


            <x-form.btn>Edit Task</x-form.btn>

        </x-form.form>

        <form method="POST" action="{{ route('tasks.destroy', ['task'=>$task->id]) }}" class="form-delete" id="form-delete">
            
            @csrf

            @method('DELETE')

            <button type="submit" class="btn btn-danger" id="btn-delete" data-bs-toggle="modal" data-bs-target="#exampleModal">
                X
            </button>

        </form>

    </section>

@endsection
