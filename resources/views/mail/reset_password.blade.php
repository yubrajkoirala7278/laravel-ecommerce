<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password Reset</title>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <img src="{{asset('admin/assets/img/logo.png')}}" alt="Company Logo">
        </div>
        <div class="email-body">
            <p>Hello</p>
            <p>You are receiving this email because we received a password reset request for your account.</p>
            <p>
                <a href="{{url('password/reset',$token)}}?email={{urlencode($email)}}" class="btn">Reset Password</a>
            </p>
            <p>This password reset link will be expire in 60 minutes.</p>
            <p>If you did not request a  password request, no further action is required.</p>
        </div>
        <div class="email-footer">
            Regards, <br>
            Company Name 
        </div>
    </div>
</body>
</html>