<!DOCTYPE html>
<html>
<head>
    <title>Verify Email</title>
</head>

<body>
<h2>Dear {{$info['name']}},</h2><br/>
Your Verification Code is <b>{{$info['verification']}}</b>
<h4>The code will expire after 30 minutes.</h4>
</body>

</html>