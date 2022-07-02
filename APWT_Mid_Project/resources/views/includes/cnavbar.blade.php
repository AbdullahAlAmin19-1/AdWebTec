<header>
    @if(session()->has('id'))
    <div class="top-section">
        <table style="width: 100%;">
            <tr>
                <td style="width: 25%; padding: 10px;">
                    <h2><a href="{{route('public.home')}}">Grocery OS</a></h2>
                </td>
                <td style="width: 25%; padding-top:18px;">
                    <form action="{{route('public.searchproduct')}}" method="POST">
                        {{@csrf_field()}}
                        <input type="search" name="search_name" id="search_name" placeholder="Search here">
                        @error('search_name')
                                    {{$message}}
                                    @enderror
                        <input type="submit" name="search" value="Search">
                    </form>
                </td>
                <td style="width: 50%;" align="right">
                    <span style="font-size: 18px">Welcome! <span>{{Session::get('user_type')}}, <b><a
                                    href="{{route('customer.cprofileinfo');}}"
                                    style="font-size: 18px">{{Session::get('user_name')}}</a></b></span></span>
                    <span style="padding-left: 25px;">
                        <a href="{{route('customer.cdashboard');}}" style="font-size: 18px">Home</a> |
                        <a href="#" style="font-size: 18px">Track Order</a> |
                        <a href="{{route('customer.clogout');}}" style="font-size: 18px">Logout</a>
                    </span>
                </td>
            </tr>
        </table>
    </div>
    @if(session()->get('user_type')=='Customer')
    <div class="middle-section">
        <center>
            <table>
                <tr>
                    <td>
                        <a href="{{route('customer.cprofile');}}" style="font-size: 20px;">Manage Account</a> |
                        <a href="{{route('customer.ccart')}}" style="font-size: 20px;">Cart</a> |
                        <a href="{{route('customer.corder')}}" style="font-size: 20px;">Orders</a> |
                        <a href="#" style="font-size: 20px;">Reviews</a> |
                        <a href="#" style="font-size: 20px;">Coupons</a>
                    </td>
                </tr>
            </table>
        </center>
    </div>
    @endif
    @else
    <div class="top-section">
        <table style="width: 100%;">
            <tr>
                <td style="width: 65; padding: 10px;">
                    <h2><a href="{{route('public.home')}}">Grocery OS</a></h2>
                </td>
                <td style="width: 35%;" align="right">
                    <a href="{{route('public.home')}}" style="font-size: 18px">Home</a> |
                    <a href="{{route('public.registration')}}" style="font-size: 18px">Registration</a> |
                    <a href="{{route('public.login')}}" style="font-size: 18px">Login</a>
                </td>
            </tr>
        </table>
    </div>
    @endif
</header>
