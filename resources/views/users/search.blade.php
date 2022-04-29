@if(count($users) != 0)

    @foreach($users as $user)

        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td><a href="{{ route('users.show', ['user'=>$user->id]) }}">{{ $user->email }}</a></td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->surname }}</td>
            <td>{{ $user->phone }}</td>
            <td>
                <span class="isactive {{ $user->is_active ? 'active' : 'inactive' }}"
                      data-bs-toggle="tooltip" data-bs-placement="top"
                      title="{{ $user->is_active ? 'active' : 'inactive' }}">
                </span>
            </td>
        </tr>

    @endforeach

@else
    <tr>
        <td class="border-0">Nothing :((</td>
    </tr>
@endif  

