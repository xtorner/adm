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
                        <li>Informació</li>
                        <li><a href="{{route('administration.information.courses')}}">Cursos</a></li>
                        <li class="active">Editar Curs</li>
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
                            Editar Curs
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
                            <form method="post" action="{{route('administration.information.courses.update', $course->id)}}">
                                @csrf
                                @method('PATCH')
                                <div class="box-body">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label for="port">Nom</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="" value="{{ $course->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Any</label>
                                            <div class="input-group number-spinner">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" data-dir="dwn" style="padding: 6px 10px"><span class="glyphicon glyphicon-minus"></span></button>
                                            </span>
                                                <input type="text" name="year" class="form-control text-center" value="{{ $course->year }}">
                                                <span class="input-group-btn">
                                                <button class="btn btn-default" data-dir="up" style="padding: 6px 10px"><span class="glyphicon glyphicon-plus"></span></button>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Data preinscripció:</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right datepicker" id="date_preins" name="date_preins" value="{{ date('d-m-Y',strtotime($course->date_preins)) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Data final preinscripció:</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right datepicker" id="date_preins_end" name="date_preins_end" value="{{ date('d-m-Y',strtotime($course->date_preins_end)) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Data inici:</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right datepicker" id="date_start" name="date_start" value="{{ date('d-m-Y',strtotime($course->date_start)) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Data final:</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right datepicker" id="date_end" name="date_end" value="{{ date('d-m-Y',strtotime($course->date_end)) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Data admissió:</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right datepicker" id="date_admission" name="date_admission" value="{{ date('d-m-Y',strtotime($course->date_admission)) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Data final admissió:</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right datepicker" id="date_admission_end" name="date_admission_end" value="{{ date('d-m-Y',strtotime($course->date_admission_end)) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="active" class="margin-r-5">Actiu</label>
                                            <input type="checkbox" id="active" class="bt-switch-simple" name="active" @if($course->active)value="1" checked @else value="0"@endif>
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
