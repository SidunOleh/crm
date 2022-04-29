<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invitation | CRM</title>
</head>
<body>

    <p>Your Login: {{ $user->email }}</p>
    <p>Your Password: {{ $password }}</p>

    <p><a href="{{ route('login.index') }}">{{ route('login.index') }}</a></p>

</body>
</html>
