<html>
<head>
    <title>Admin</title>
</head>
<body>
    <div class="top-section">
        <table style="width: 100%;">
            <tr>
                <td style="width: 65; padding: 5px;">
                    <h2><a href="{{route('admin.adashboard')}}">Grocery OS</a></h2>
                </td>
                <td style="width: 35%;">
                    <span style="font-size: 18px">Hello <span>{{Session::get('user_type')}},<b>
                        <a href="{{route('admin.aprofile');}}" style="font-size: 18px">{{Session::get('username')}}!</a></b></span></span>
                    <span style="padding-left: 35px;">
                        <a href="{{route('admin.adashboard');}}" style="font-size: 18px">Home</a> |
                        <a href="{{route('admin.aeditprofile');}}" style="font-size: 18px">Edit Profile</a> | 
                        <a href="{{route('public.logout');}}" style="font-size: 18px">Logout</a>
                    </span>
                </td>
            </tr>
        </table>
    </div>
    <div class="footer-section">
    @yield('content')
    </div>
</body>
</html>
