<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ Route::currentRouteNamed('home-main') ? 'active': '' }}">
                    <a href="{{ route('home-main') }}" class="nav-link">
                        Головна
                    </a>
                    <!-- /.nav-link -->
                </li>
                <!-- /.nav-item -->
                <li class="nav-item">
                    <a href="{{route('post-all')}}" class="nav-link">Статті</a>
                </li>
                <!-- /.nav-item -->
                <li class="nav-item {{ Route::currentRouteNamed('about') ? 'active': '' }}">
                    <a href="{{ route('page', ['alias'=>'abaut']) }}" class="nav-link">
                        Про нас
                    </a>
                    <!-- /.nav-link -->
                </li>
                <!-- /.nav-item -->
                <li class="nav-item {{ Route::currentRouteNamed('feedback.index') ? 'active': '' }}">
                    <a href="{{ route('feedback.index') }}" class="nav-link">
                        Контакти
                    </a>
                    <!-- /.nav-link -->
                </li>
                <!-- /.nav-item -->


            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    @if ((int)auth()->user()->role === 10)
                        <li class="nav-item {{ Route::currentRouteNamed('admin') ? 'active': '' }}">
                            <a href="{{ url('/admin') }}" class="nav-link">
                                Адмінка
                            </a>
                            <!-- /.nav-link -->
                        </li>
                        <!-- /.nav-item -->
                    @endif
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
