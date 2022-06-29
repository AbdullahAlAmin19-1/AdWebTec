<header align="right">
@if(session()->has('id'))
    <a href="{{route('public.welcome')}}">Home</a>
    <a href="{{route('public.logout')}}">Logout</a>
@else 
    <a href="{{route('public.home')}}">Home</a>
    <a href="{{route('public.registration')}}">Registration</a>
    <a href="{{route('public.login')}}">Login</a>
@endif
</header>