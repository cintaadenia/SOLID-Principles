<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuillPad</title>
    <link rel="icon" href="{{ asset('img/avatarsaya.png') }}" type="image/png">

    @yield('style')

    @include('include.style')
</head>

<body>
    <div id="app">

        @include('include.sidebar')

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            {{-- <div class="page-heading">
                <h3>Catatan saya</h3>
            </div> --}}
            @yield('content')

            @include('include.footer')
        </div>
    </div>

    @include('include.script')
    @yield('script')
</body>

</html>
