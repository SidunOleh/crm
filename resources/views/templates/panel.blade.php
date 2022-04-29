@include('includes.header')

<div class="wrapper">
    
    <div class="panel">

        @include('includes.sidebar')

        <main class="panel__content p-5 bg-light">
            
            <div class="panel__body">

                @yield('content')

            </div>
        
        </main>

    </div>

</div>

@include('includes.footer')
