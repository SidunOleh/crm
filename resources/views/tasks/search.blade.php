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
            <td @class([
                'bg-success bg-gradient' => ((time() - strtotime($task->deadline)) < 0),
                'bg-danger bg-gradient'  => ((time() - strtotime($task->deadline)) > 0),
            ])>{{ date('d/m/Y', strtotime($task->deadline)) }}</td>
        </tr>

    @endforeach

@else
    <tr>
        <td class="border-0">Nothing :((</td>
    </tr>
@endif  
