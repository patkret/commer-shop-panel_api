<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
<h1>Mail from E-commer</h1>
<p>Please click the link below to change your password:  </p>
<a href="{{URL::to('user/' . $user_id . '/reset-password')}}">{{URL::to('user/' . $user_id . '/reset-password') }}"</a>
</body>
</html>