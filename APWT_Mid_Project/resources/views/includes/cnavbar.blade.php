<html>

<head>
    <title>Customer Page</title>
</head>

<body>

    <div class="top-section">

        <table style="width: 100%;">

            <tr>
                <td style="width: 65; padding: 5px;">
                    <h2><a href="{{route('public.home')}}">Grocery OS</a></h2>
                </td>
                <td style="width: 35%;">
                    <span style="font-size: 18px">Welcome! <span><b><a href="{{route('customer.cprofile');}}" style="font-size: 18px">{{Session::get('username')}}</a></b></span></span>
                    <span style="padding-left: 35px;">
                        <a href="{{route('customer.cdashboard');}}" style="font-size: 18px">Home</a> |
                        <a href="#" style="font-size: 18px">Track Order</a> |
                        <a href="{{route('customer.clogout');}}" style="font-size: 18px">Logout</a>
                    </span>
                </td>
            </tr>

        </table>

    </div>

    <div class="footer-section">

        <center>
            <table>

                <tr>
                    <td>
                        <a href="{{route('customer.cprofile');}}" style="font-size: 20px;">Manage My Account</a> |
                        <a href="#" style="font-size: 20px;">My Orders</a> |
                        <a href="#" style="font-size: 20px;">My Reviews</a> |
                        <a href="#" style="font-size: 20px;">Vouchers</a>
                    </td>
                </tr>

            </table>
        </center>

    </div>


</body>

</html>
