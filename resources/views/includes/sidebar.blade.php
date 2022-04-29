<sidebar class="panel__sidebar sidebar bg-primary">

    <ul class="list-group">

        <x-sidebar.item href="{{ route('users.edit', ['user'=>Auth::id()]) }}">
            PROFILE

            <x-slot name="droplist">

                <x-droplist.list>

                    <x-droplist.item href="{{ route('password.change') }}">
                        CHANGE PASSWORD
                    </x-droplist.item>

                    <x-droplist.item href="{{ route('login.logout') }}">
                        LOGOUT
                    </x-droplist.item>

                </x-droplist.list>

            </x-slot>

        </x-sidebar.item>

        <x-sidebar.item href="{{ route('projects.index') }}">
            PROJECTS

            <x-slot name="droplist">

                <x-droplist.list>

                    <x-droplist.item href="{{ route('projects.create') }}">
                        CREATE
                    </x-droplist.item>

                </x-droplist.list>

            </x-slot>

        </x-sidebar.item>

        <x-sidebar.item href="{{ route('contacts.index') }}">
            CONTACTS

            <x-slot name="droplist">

                <x-droplist.list>

                    <x-droplist.item href="{{ route('contacts.create') }}">
                        CREATE
                    </x-droplist.item>

                </x-droplist.list>

            </x-slot>

        </x-sidebar.item>

        <x-sidebar.item href="{{ route('tasks.index') }}">
            TASKS

            <x-slot name="droplist">

                <x-droplist.list>

                    <x-droplist.item href="{{ route('tasks.create') }}">
                        CREATE
                    </x-droplist.item>

                </x-droplist.list>

            </x-slot>

        </x-sidebar.item>


        <x-sidebar.item href="{{ route('users.index') }}">
            EMPLOYEES

            @if (Auth::user()->is_admin)

                <x-droplist.list>

                    <x-droplist.item href="{{ route('users.create') }}">
                        CREATE
                    </x-droplist.item>

                </x-droplist.list>

            @endif

        </x-sidebar.item>

    </ul>

    <div class="sidebar__company">
        <span>{{ $company }}</span>
    </div>

    <div class="sidebar__close">
        <span>&lsaquo;</span>
    </div>

</sidebar>
