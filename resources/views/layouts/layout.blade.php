<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{'img/favicon.png'}}">
</head>
<body>
<nav class="container navbar navbar-expand (-sm | -md | -lg | -xl)) navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('address.index')}}">Home <span class="sr-only">(current)</span></a>
            </li>

            @auth
                <li class="nav-item active offset-3">
                    <a class="nav-link" href="{{route('address.create')}}">Create IP<span class="sr-only">(current)</span></a>
                </li>
            @if(Auth::user()->role == 1)
            <li class="nav-item active offset-3 ">
                <a class="nav-link" href="{{route('address.show')}}">Users <span class="sr-only">(current)</span></a>
            </li>
            @endif
                @if(Session::get('id'))

                    <form id = "log" action="{{route('address.newLogin',Session::get('id'))}}" method="post" enctype="multipart/form-data">
                        <div class="nav-item active offset-3">
                            <a class="nav-link" type="submit" href="{{route('address.newLogin',Session::get('id'))}}"
                            onclick="event.preventDefault(); document.getElementById('log').submit();">Back to admin</a>
                        </div>
                        @csrf
                    </form>
                @endif

                @endauth

        </ul>
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>
<div class="container">

    @if($errors->any())
        @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$error}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endforeach
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @yield('content')
</div>

<script src="{{asset('js/app.js')}}"></script>
</body>
</html>