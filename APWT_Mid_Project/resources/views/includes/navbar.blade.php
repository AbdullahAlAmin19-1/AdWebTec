<header>
@if(session()->has('id'))
    <div class="top-section">
        <table style="width: 100%;">
            <tr>
                <td style="width: 65; padding: 10px;">
                    <h2><a href="{{route('public.home')}}">Grocery OS</a></h2>
                </td>
                <td style="width: 35%;" align="right">
                    <span style="font-size: 18px">Welcome! <span><b><a href="{{route('vendor.profile');}}" style="font-size: 18px">{{Session::get('user_name')}}</a></b></span></span>
                    <span style="padding-left: 25px;">
                        <a href="{{route('public.welcome');}}" style="font-size: 18px">Home</a> |
                        <!-- <a href="#" style="font-size: 18px">My Account</a> | -->
                        <a href="{{route('public.logout');}}" style="font-size: 18px">Logout</a>
                    </span>
                </td>
            </tr>
        </table>
    </div>
    @if(session()->get('user_type')=='Vendor')
        <div class="middle-section">
            <center>
                <table>
                    <tr>
                        <td>
                            | <a href="{{route('vendor.profile');}}" style="font-size: 20px;">Manage My Account</a> |
                            <!-- <a href="#" style="font-size: 20px;">My Orders</a> |
                            <a href="#" style="font-size: 20px;">My Reviews</a> |
                            <a href="#" style="font-size: 20px;">Vouchers</a> | -->
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