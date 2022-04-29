@extends('templates.panel')

@include('includes.modals.sure')

@section('page-title', 'User')

@section('content')

    <section class="user" user-id="{{ $user->id }}">

        <div class="user__top d-flex align-items-end">

            <div class="user__avatar avatar__img">
                <img src="{{ $user->avatar ? '/storage/' . $user->avatar : asset('image/avatars/default.png') }}" alt="">
            </div>

            @if(Auth::user()->is_admin and Auth::user()->id != $user->id)

                <div class="user__active ps-3">

                    <x-form.switch url="/users/activity/{{ $user->id }}" status="{{ $user->is_active }}">
                        access to the system
                    </x-form.switch>

                </div>

            @endif

        </div>


        <ul class="user__info list-group pt-4">

            <li class="list-group-item">
                <strong class="pe-2">Company: </strong> {{ $user->company->name }}
            </li>

            <li class="list-group-item">
                <strong class="pe-2">Email: </strong> {{ $user->email }}
            </li>

            <li class="list-group-item">
                <strong class="pe-2">Name: </strong> {{ $user->name }}
            </li>

            <li class="list-group-item">
                <strong class="pe-2">Surname: </strong> {{ $user->surname }}
            </li>

            <li class="list-group-item">
                <strong class="pe-2">Mobile phone: </strong> {{ $user->phone }}
            </li>

        </ul>

        @if(Auth::user()->is_admin and Auth::user()->id != $user->id)

            <div class="user__permission permission mt-5">

                    @foreach($user->permissions as $resource => $permissions)

                        <div class="permission__resourse h5">
                            {{ ucfirst($resource) }}
                        </div>

                        <div class="permission__block border mb-3">

                            @foreach($permissions as $operation => $permission)

                                <div class="permission__item d-flex justify-content-between p-2 border-bottom">

                                    <div class="permission__info">
                                        <span>{{ ucfirst($operation) }}</span>
                                    </div>

                                    <div class="permission__radio ms-3 d-flex justify-content-between">

                                        @if($operation != 'create')

                                            <x-permissions.item :resource="$resource" :operation="$operation" :permission="$permission" :value="2">

                                            </x-permissions.item>

                                        @endif

                                        <x-permissions.item :resource="$resource" :operation="$operation" :permission="$permission" :value="1">

                                        </x-permissions.item>

                                        <x-permissions.item :resource="$resource" :operation="$operation" :permission="$permission" :value="0">

                                        </x-permissions.item>

                                    </div>

                            </div>

                            @endforeach

                        </div>

                    @endforeach

                    <div class="permission__bottom d-flex aling-items-center mt-4">
                        <p class="d-flex aling-items-cente me-3"><span class="me-2"></span> - all</p>
                        <p class="d-flex aling-items-cente me-3"><span class="me-2"></span> - only created</p>
                        <p class="d-flex aling-items-cente me-3"><span class="me-2"></span> - none</p>
                    </div>

            </div>

            <x-form.form action="{{ route('users.destroy', ['user'=>$user->id]) }}" class="mt-5" id="form-delete">

                @method('DELETE')

                <button type="submit" class="btn btn-danger" id="btn-delete" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Delete
                </button>

            </x-form.form>

        @endif



    </section>

@endsection
