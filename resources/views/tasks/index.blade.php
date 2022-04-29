@extends('templates.panel')

@section('page-title', 'Tasks')

@section('content')

    <x-form.search action="{{ route('tasks.search') }}"/>

    <section class="panel__main">

        <table class="table">
           
            <thead>
                
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Deadline</th>
                </tr>
           
            </thead>
            
            <tbody>

            @if(count($tasks) != 0)

                @foreach ($tasks as $task)

                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>
                            <a href="{{ route('tasks.show', ['task'=>$task->id]) }}">
                                {{ $task->name }}
                            </a>
                        </td>
                        <td>{{ cutStr($task->description, 0, 50) }}</td>

                        @php($deadline = strtotime($task->deadline))

                        <td @class([
                            'bg-success bg-gradient' => ((time() - $deadline) < 0),
                            'bg-danger bg-gradient'  => ((time() - $deadline) > 0),
                        ])>{{ date('m/d/Y', $deadline) }}</td>
                    </tr>

                @endforeach
                
            @else
                <tr>
                    <td class="border-0">Nothing :((</td>
                </tr>
            @endif    

            </tbody>
        
        </table>

    </section>

@endsection
