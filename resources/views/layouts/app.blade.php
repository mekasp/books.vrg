<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Books App</title>
    <link href="{{ asset('css/datatables-1.13.4.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body class="container mt-5">
    <div style="text-align: center">
        <a style="color: black" href="{{ route('book') }}">Books page</a>
        <a style="color: black; margin-left: 20px" href="{{ route('author') }}">Authors page</a>
    </div>
    @yield('content')
    <script src="{{ asset('js/libraries/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('js/libraries/datatables-1.13.4.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html>
