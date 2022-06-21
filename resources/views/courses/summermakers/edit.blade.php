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
                        <li>Administració</li>
                        <li><a href="{{route('administration.courses')}}">Cursos</a></li>
                        <li><a href="{{route('administration.courses.summermakers')}}">Summer Makers</a></li>
                        <li class="active">Editar Summer Maker</li>
                    </ol>
                </div>
            </div>
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p>{{ $error }}</p>
                </div>
            @endforeach
            <div class="row">
                <div class="col-md-12">
                    <div class="header-page">
                        <div class="header-icon">
                            <i class="fa fa-gear left" style="vertical-align: middle; padding-right: 10px;"></i>
                        </div>
                        <h1 class="left">
                            Editar Summer Maker
                        </h1>
                    </div>
                </div>
            </div>
        </section>


        <section class="content">

            <div class="row">

                <div class="col-md-4">

                    <div class="box box-dashboard">
                        <div class="box-body">
                            <form method="post" action="{{route('administration.courses.summermakers.update', $summerMaker->id)}}">
                                @csrf
                                @method('PATCH')
                                <div class="box-body">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label for="port">Nom</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="" value="{{ $summerMaker->name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <div class="form-group">
                                        <a class="btn btn-danger" href="{{route('administration.courses')}}">Tornar</a>
                                        <button type="submit" class="btn btn-primary pull-right">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>

            </div>


        </section>

@endsection
