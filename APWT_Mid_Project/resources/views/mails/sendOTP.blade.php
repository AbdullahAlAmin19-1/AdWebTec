{{-- {{$user_type}} {{$username}} {{$email}} {{$otp}} --}}

<div class="mail-body">

    <h3>Hi! {{$username}}</h3>
    <p>Forgot your password?</P>
    <p>We received a request to reset the password for your account. To reset your password, Use the OTP Code below...</P>

    <center>
        <h2>{{$otp}}</h2>
    </center>

    <p>If you did not request a password reset, You can safely ignore this email.</p>
    <h4>Thank You! <br>- Grocery OS</h4>

</div>
