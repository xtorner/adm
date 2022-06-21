@extends('layouts.base')

@section('root-title')
    @yield('title')
@endsection

@section('root-meta')
    @yield('meta')
@endsection

@section('root-head-css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    @yield('head-css')
@endsection

@section('root-head-js')
    @yield('head-js')
@endsection

@section('root-body-class')@yield('body-class')@endsection

@section('root-content')

{{--    <!-- Fixed navbar -->--}}
{{--    <nav class="navbar navbar-login navbar-fixed-top">--}}
{{--        <div class="container">--}}
{{--            <div id="navbar" class="collapse navbar-collapse">--}}
{{--                <ul class="nav navbar-nav navbar-right">--}}
{{--                    <li class="active"><a href="#">ca</a></li>--}}
{{--                    <li><a href="#about">es</a></li>--}}
{{--                </ul>--}}
{{--            </div><!--/.nav-collapse -->--}}
{{--        </div>--}}
{{--    </nav>--}}

    @yield('content')

{{--    <footer class="footer">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-8">--}}

{{--                </div>--}}
{{--                <div class="col-md-4" style="margin-bottom: 5px; margin-top: 10px;">--}}
{{--                    <p class="pull-right center-block"></p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </footer>--}}
@endsection

@section('root-footer-js')
    <script src="{{ asset('js/login.js') }}"></script>
    @yield('footer-js')
@endsection