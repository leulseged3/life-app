<!DOCTYPE html>
<html>
<head>
    <title>New Admin</title>
</head>

<body>
<h2>Welcome to Life app {{$admin['name']}}</h2>
<br/>
  you are registered as an admin.
<br/>
your Role is: <b>{{$admin['roles'][0]->name}}</b>
email:<b>{{$admin['email']}}</b>
password:<b>{{$admin['password']}}</b>
</body>

</html>