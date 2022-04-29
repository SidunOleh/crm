@extends('templates.panel')

@include('includes.modals.sure')

@section('page-title', 'Edit Project')

@section('content')

    <section class="project position-relative">

        <div class="author pb-3 h6">
           Author: <a href="{{ route('users.show', ['user'=>$project->user_id]) }}">{{$project->user->email }}</a>
        </div>

        <x-form.form action="{{ route('projects.update', ['project'=>$project->id]) }}" enctype="multipart/form-data" class="project-update__form">

            @method('PUT')

            <x-form.item type="text" name="name" value="{{ old('name') ?? $project->name }}">
                Name
            </x-form.item>

            <x-form.item type="textarea" name="description" value="{{ old('description') ?? $project->description }}">
                Description
            </x-form.item>

            <x-select.list name="status" options="{{ implode(',', array_unique([$project->status, 'in process', 'implemented', 'not implemented', ])) }}">           
               Status
            </x-select.list>

            <x-form.btn>Edit project</x-form.btn>

        </x-form.form>

        <form method="POST" action="{{ route('projects.destroy', ['project'=>$project->id]) }}" class="form-delete" id="form-delete">
            
            @csrf

            @method('DELETE')

            <button type="submit" class="btn btn-danger" id="btn-delete" data-bs-toggle="modal" data-bs-target="#exampleModal">
                X
            </button>

        </form>

    </section>

@endsection
