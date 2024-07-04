<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Recz</title>

    <link rel="stylesheet" href="{{ secure_asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/responsive.css') }}">
    <link rel="icon" type="image/png" href="{{ secure_asset('img/favicon.png')  }}">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'" media='all'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body cz-shortcut-listen="true">

    {{-- @include('frontend.includes.header') --}}
    @yield('content')
    @include('frontend.includes.footer')




</body>

</html>
