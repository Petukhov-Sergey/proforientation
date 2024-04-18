<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <title>My posts</title>
</head>
<body>
<div class="container">
    <div class="row">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    @can('view', auth()->user())
                        @if(auth()->user()->isAdmin())
                            <a class="nav-item nav-link" href="{{route('admin.users.index')}}">User administration</a>
                        @endif
                    @endcan
                    @can('view', auth()->user())
                        @if(auth()->user()->isEditor())
                        <a class="nav-item nav-link" href="{{route('admin.users.index')}}">Test administration</a>
                        @endif
                    @endcan
                </div>
            </div>
        </nav>
    </div>
    @yield('content')
</div>
</body>
</html>
