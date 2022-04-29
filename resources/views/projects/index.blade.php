@extends('templates.panel')

@section('page-title', 'Projects')

@section('content')

    <x-form.search action="{{ route('projects.search') }}"/>

    <section class="projects">

        <table class="table">
           
            <thead>
                
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                </tr>
           
            </thead>
            
            <tbody>

            @if(count($projects) != 0)

                @foreach ($projects as $project)

                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>
                            <a href="{{ route('projects.show', ['project'=>$project->id]) }}">
                                {{ $project->name }}
                            </a>
                        </td>
                        <td>{{ cutStr($project->description, 0, 50) }}</td>
                        <td @class([
                            'bg-success bg-gradient' => ($project->status == 'implemented'),
                            'bg-warning bg-gradient' => ($project->status == 'in process'),
                            'bg-danger bg-gradient'  => ($project->status == 'not implemented'),
                        ])>{{ ucfirst($project->status) }}</td>
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
