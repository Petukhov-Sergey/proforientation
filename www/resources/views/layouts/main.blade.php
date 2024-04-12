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
                    <a class="nav-item nav-link" href="{{route('admin.users.index')}}">Main</a>
{{--                    @can('view', auth()->user())--}}
{{--                        <a class="nav-item nav-link" href="{{route('admin.user.index')}}">User administration</a>--}}
{{--                    @endcan--}}
{{--                    @can('view', auth()->user())--}}
{{--                        <a class="nav-item nav-link" href="{{route('admin.user.index')}}">Test administration</a>--}}
{{--                    @endcan--}}
                </div>
            </div>
        </nav>
    </div>
    @yield('content')
</div>
</body>
</html>
