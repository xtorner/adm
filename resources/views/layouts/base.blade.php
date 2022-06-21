<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>
        @yield('root-title')
    </title>
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--<meta name="keywords" content="">--}}
    {{--<meta name="description" content="">--}}
    @yield('root-meta')
    @yield('root-head-css')
    @yield('root-head-js')
</head>
<body class="@yield('root-body-class')">
@yield('root-content')
@yield('root-footer-js')
</body>
</html>