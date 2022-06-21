@extends('layouts.base')

@section('root-title')
    @yield('title')
@endsection

@section('root-meta')
    @yield('meta')
@endsection

@section('root-head-css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('head-css')
@endsection

@section('root-head-js')
    @yield('head-js')
@endsection

@section('root-body-class') skin-ssh-default @endsection

@section('root-content')

    <header class="main-header">
        <!-- Logo -->
        <a href="{{route('dashboard')}}" class="logo">
            <img class="img-responsive" src="{{asset('images/logo.png')}}">
        </a>
    <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            @inject('courseService', 'App\Services\Information\CourseService')

            <div class="navbar-custom-menu pull-left">
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
{{--                                <b>Curs:</b>--}}
                                @if (!empty($courseService->getActive()->name))
                                    {{$courseService->getActive()->name}}
                                @endif
                            </a>
                        </li>
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <b>Data inici:</b>
                                @if (!empty($courseService->getActive()->date_start))
                                    {{ date('d-m-Y',strtotime($courseService->getActive()->date_start)) }}
                                @endif
                            </a>
                        </li>
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <b>Data final:</b>
                                @if (!empty($courseService->getActive()->date_end))
                                    {{ date('d-m-Y',strtotime($courseService->getActive()->date_end)) }}
                                @endif
                            </a>
                        </li>
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <b>Data preinscripció:</b>
                                @if (!empty($courseService->getActive()->date_preins))
                                    {{ date('d-m-Y',strtotime($courseService->getActive()->date_preins)) }}
                                @endif
                            </a>
                        </li>
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <b>Data final preinscripció:</b>
                                @if (!empty($courseService->getActive()->date_preins_end))
                                    {{ date('d-m-Y',strtotime($courseService->getActive()->date_preins_end)) }}
                                @endif
                            </a>
                        </li>
{{--                        <li class="dropdown messages-menu">--}}
{{--                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">--}}
{{--                                <b>Data final:</b>--}}
{{--                                @if (!empty($courseService->getActive()->date_end))--}}
{{--                                    {{ date('d-m-Y',strtotime($courseService->getActive()->date_end)) }}--}}
{{--                                @endif--}}
{{--                            </a>--}}
{{--                        </li>--}}
                    </ul>
                </div>
            </div>
            <div class="navbar-custom-menu">
                @component('layouts._navbar-panel') @endcomponent
            </div>
        </nav>
    </header>

    <aside class="main-sidebar">
        <section class="sidebar">
            @component('layouts._menu') @endcomponent
        </section>
        <!-- /.sidebar -->
    </aside>

    <div class="content-wrapper">

        @yield('content')

    </div>

    <footer class="main-footer" style="height: 51px;">
        <div class="pull-right hidden-xs">

        </div>

    </footer>

@endsection

@section('root-footer-js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).ready(function () {

            $('.sidebar-menu').tree();

            $('.datepicker').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                language: 'ca',
                orientation: 'bottom',
                clearBtn: true,
                todayBtn: true,
                todayHighlight: true
            }).attr('readonly', 'readonly');

            $('.datetimepicker').datetimepicker({
                locale:'ca',
                ignoreReadonly: true,
                showTodayButton: true
            });

        });

        $(document).on('click', '.number-spinner button', function (e) {

            e.preventDefault();

            var btn = $(this),
                oldValue = btn.closest('.number-spinner').find('input').val().trim(),
                newVal = 0;

            if (btn.attr('data-dir') == 'up') {
                newVal = parseInt(oldValue) + 1;
            } else {
                if (oldValue >= 1) {
                    newVal = parseInt(oldValue) - 1;
                } else {
                    newVal = 0;
                }
            }
            btn.closest('.number-spinner').find('input').val(newVal);
        });


    </script>
    @yield('footer-js')
@endsection
