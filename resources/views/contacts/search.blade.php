@if(count($contacts) != 0)

    @foreach ($contacts as $contact)

        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>
                <a href="{{ route('contacts.show', ['contact'=>$contact->id]) }}">
                    {{ $contact->email }}
                </a>
            </td>
            <td>{{ $contact->name }}</td>
            <td>{{ $contact->surname }}</td>
            <td>{{ $contact->phone }}</td>
            <td>{{ ucfirst($contact->type) }}</td>
            <td>
                <span class="isactive {{ $contact->is_active ? 'active' : 'inactive' }}"
                    data-bs-toggle="tooltip" data-bs-placement="top"
                    title="{{ $contact->is_active ? 'active' : 'inactive' }}"></span>
            </td>
        </tr>

    @endforeach

@else
    <tr>
        <td class="border-0">Nothing :((</td>
    </tr>
@endif  
