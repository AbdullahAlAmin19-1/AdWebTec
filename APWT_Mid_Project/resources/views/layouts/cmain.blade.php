<html>
    <head>
        <title>@yield('title')</title>
    </head>
    <body>
        @include('includes.cnavbar')
        <div>
            @yield('content')
        </div>
    </body>
</html>