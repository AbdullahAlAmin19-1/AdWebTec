<div class="top-section">
    <table style="width: 100%;">
        <tr>
            <td style="width: 35%; padding-top:18px;">
                <h2><a href="{{route('public.home')}}">Grocery OS</a></h2>
            </td>
            <td style="width: 35%; padding-top:18px;">
                <form action="{{route('public.searchproduct')}}" method="POST">
                    {{@csrf_field()}}
                    <input type="search" name="search_name" id="search_name" placeholder="Search here">
                    @error('search_name')
                                {{$message}}
                                @enderror
                    <input type="submit" name="search" value="Search">
                </form>
            </td>
            <td style="width: 30%;" align="right">
                <a href="{{route('public.home')}}" style="font-size: 18px">Home</a> |
                <a href="{{route('public.registration')}}" style="font-size: 18px">Registration</a> |
                <a href="{{route('public.login')}}" style="font-size: 18px">Login</a>
            </td>
        </tr>
    </table>
</div>