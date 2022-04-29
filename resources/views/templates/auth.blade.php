@include('includes.header')

<div class="wrapper min-vh-100 d-flex flex-column">

    <header class="header">
        
        <nav class="navbar navbar-expand-lg navbar-light bg-light py-3">
            
            <div class="container d-flex justify-content-between">
               
                <span class="navbar-brand">{{ config('app.name') }}</span>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        
                        @auth

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('users.edit', ['user' => request()->user()->id]) }}">Profile</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login.logout') }}">Logout</a>
                            </li>
                        
                        @endauth

                        @guest
                        
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('reg.index') ? 'active' : '' }} " href="{{ route('reg.index') }}">Registration</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('login.index') ? 'active' : '' }} " href="{{ route('login.index') }}">Login</a>
                            </li>
                    
                        @endguest

                    </ul>
                
                </div>

            </div>
        </nav>
   
    </header>

    <main class="main flex-grow-1 py-3 d-flex">
            
        <div class="form-wrapper flex-grow-1 d-flex justify-content-center align-items-start">

            <div class="form-container border p-3">

                @yield('form')

            </div>

        </div>
           
    </main>

    <footer class="footer bg-primary">
       
        <div class="footer__body py-4 text-center">
            
            &#169; {{ date('Y') }}
        
        </div>
    
    </footer>

</div>

@include('includes.footer')
