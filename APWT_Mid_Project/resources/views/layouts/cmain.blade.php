<html>
    <head>
        <title>@yield('title')</title>
    </head>
    <body>
        @include('includes.cnavbar')
        <div>
            @yield('content')
        </div>
        {{-- @include('includes.products') --}}
    </body>
</html>