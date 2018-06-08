
<!DOCTYPE html>
<html>
<head>
    <title>Confirm registration</title>
</head>
<body>
<h1>Mail from E-commer</h1>
<p>Thank you for creating an account in e-commer.pl</p>
<p>Please click the link below to verify:  </p>
<a href="{{URL::to('register/verify/' . $confirmation_code) }}">{{URL::to('register/verify/' . $confirmation_code) }}</a>
</body>
</html>