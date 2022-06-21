@extends('layouts.admin')

@section('title')
    Dashboard
@endsection

@section('content')

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i>Tauler Control</a></li>
                        <li><a href="{{route('admissions')}}">Admissions</a></li>
                        <li class="active">Crear admissió</li>
                    </ol>
                </div>
            </div>
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p>{{ $error }}</p>
                </div>
            @endforeach

            @if (session('status'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('status')}}
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="header-page">
                        <div class="header-icon">
                            <i class="fa fa-newspaper-o left" style="vertical-align: middle; padding-right: 10px;"></i>
                        </div>
                        <h1>
                            Crear admissió
                        </h1>
                    </div>
                </div>
            </div>
        </section>


        <section class="content">

            <div class="row">

                <div class="col-md-6">

                    <div class="box box-dashboard">
                        <div class="box-body">
                            <form method="post" action="{{route('admissions.check.store')}}">
                                @csrf
                                <input name="contact_date" type="hidden" value="{{ date('Y-m-d') }}">
                                <div class="box-body">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label for="name">Familia</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="" value="{{$name}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <div class="form-group">
                                        <a class="btn btn-danger" href="{{route('admissions')}}">Tornar</a>
                                        <button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">Crear</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>

            </div>


        </section>

@endsection

