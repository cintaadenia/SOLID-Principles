<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link rel="icon" href="{{ asset('img/Simple_Studio-new.png') }}" type="image/png">

    <style>
        .text-center {
            text-align: center;
        }

        .align-text {
            display: inline-block;
            margin: 0 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="img">
            <img src="{{ asset('img/login_new.png') }}" alt="Background Image">
        </div>
        <div class="login-content">
            @yield('content')
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
</body>

</html>
