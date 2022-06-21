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
                        <li>Admissions</li>
                        <li><a href="{{route('admissions.edit',['id' => $admission->id])}}">Alumnes</a></li>
                        <li class="active">Crear alumne</li>
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
                            Crear alumne
                        </h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">

            <div class="row">

                <div class="col-md-12">

                    <div class="box box-dashboard">
                        <div class="box-body">
                            <form method="post" action="{{route('admissions.students.store', ['id'=>$admission->id])}}">
                                @csrf
                                <input name="admission_id" type="hidden" value="{{ $admission->id }}">
                                <div class="box-body">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label for="port">Nom</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="port">Cognoms</label>
                                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="" value="{{ $admission->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Data de naixement:</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right datepicker" id="birth_date" name="birth_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="language">Escola de procedència</label>
                                            <select class="form-control" id="origin_school_id" name="origin_school_id">
                                                <option value=""></option>
                                                @foreach($schools as $school)
                                                    <option value="{{$school->id}}"> {{$school->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="course_id">Curs</label>
                                            <select class="form-control" id="course_id" name="course_id">
                                                <option value=""></option>
                                                @foreach($courses as $course)
                                                    <option value="{{$course->id}}"> {{$course->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Data inici curs:</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right datepicker" id="course_date" name="course_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Data matricula:</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right datepicker" id="enrollment_date" name="enrollment_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="port">Identificador</label>
                                            <input type="text" class="form-control" id="reference" name="reference" placeholder="">
                                        </div>
                                    </div>
                                    @if(auth()->user()->isAdmin() || auth()->user()->isSummerMaker())
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="course_summer_makers_id">Summer Makers</label>
                                            <select class="form-control" id="course_summer_makers_id" name="course_summer_makers_id">
                                                <option value=""></option>
                                                @foreach($summerMakers as $summerMaker)
                                                    <option value="{{$summerMaker->id}}"> {{$summerMaker->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="language">Idioma</label>
                                            <select class="form-control" id="language_id" name="language_id">
                                                <option value=""></option>
                                                @foreach($languages as $language)
                                                    <option value="{{$language->id}}" @if($language->id == $admission->language_id) selected @endif> {{$language->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="lunch_room">Menjador</label>
                                            <input type="checkbox" id="lunch_room" class="bt-switch-simple" name="lunch_room">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Observacions</label>
                                            <textarea class="form-control" name="observations" rows="3" placeholder=""></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <div class="form-group">
                                        <a class="btn btn-danger" href="{{route('admissions.edit',['id'=>$admission->id])}}">Tornar</a>
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
