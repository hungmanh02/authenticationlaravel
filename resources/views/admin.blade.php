<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashbroad</title>
</head>
<body>
    @if (Auth::check())
    <h1> Đã đăng nhập</h1>
    @else
    <h1> Chưa đăng nhập</h1>
    @endif

</body>
</html>
