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
                    <li class="active">Editar admissió</li>
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
                        Editar admissió
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
                        <form method="post" action="{{route('admissions.update',['id' => $admission->id])}}">
                            @csrf
                            @method('PATCH')
                            <input name="contact_date" type="hidden" value="{{ date('Y-m-d') }}">
                            <div class="box-body">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Familia</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $admission->name }}">
                                    </div>
                                </div>
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
                                {{-- Contact Date --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Data contacte:</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right datepicker" id="contact_date" name="contact_date"  value="{{ date('d-m-Y',strtotime($admission->contact_date)) }}" readonly="readonly">
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
                                            <input type="text" class="form-control pull-right datepicker" id="enrollment_date" name="enrollment_date" value="@isset($admission->enrollment_date) {{ date('d-m-Y',strtotime($admission->enrollment_date)) }} @endisset">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="phone_one">Telèfon 1</label>
                                        <input type="text" class="form-control" id="phone_one" name="phone_one" value="{{ $admission->phone_one }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="phone_one_desc">Telèfon 1 Descripcció</label>
                                        <input type="text" class="form-control" id="phone_one_desc" name="phone_one_desc"value="{{ $admission->phone_one_desc }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="phone_two">Telèfon 2</label>
                                        <input type="text" class="form-control" id="phone_two" name="phone_two" value="{{ $admission->phone_two }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="phone_two_desc">Telèfon 2 Descripcció</label>
                                        <input type="text" class="form-control" id="phone_two_desc" name="phone_two_desc" value="{{ $admission->phone_two_desc }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email_one">Email 1</label>
                                        <input type="email" class="form-control" id="email_one" name="email_one" value="{{ $admission->email_one }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email_one_desc">Email 1 Descripcció</label>
                                        <input type="text" class="form-control" id="email_one_desc" name="email_one_desc" value="{{ $admission->email_one_desc }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email_two">Email 2</label>
                                        <input type="email" class="form-control" id="email_two" name="email_two" value="{{ $admission->email_two }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email_two_desc">Email 2 Descripcció</label>
                                        <input type="text" class="form-control" id="email_two_desc" name="email_two_desc" value="{{ $admission->email_two_desc }}">
                                    </div>
                                </div>

                                @foreach($questions as $question)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="question_{{$question->id}}">
                                                {{$question->question}}
{{--                                                {{dd($admission->questionsAnswers)}}--}}
                                            </label>
                                            <select class="form-control" id="question_{{$question->id}}" name="question_{{$question->id}}">
                                                <option value=""></option>
                                                @foreach($question->answers as $answer)
                                                    <option value="{{$answer->id}}" @if($admissionService->isQuestionAnswer($admission->id, $question->id, $answer->id)) selected @endif>{{$answer->answer}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Observacions</label>
                                        <textarea class="form-control" name="observations" rows="3" placeholder="">{{ $admission->observations }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" style="margin-top: 3px">
                                        <label class="pull-left" style="margin-right: 20px">Estat</label>
                                        <p>
                                            @if($admission->status->id === 1)<span class="label bg-gray-active">{{ $admission->status->name }}</span>@endif
                                            @if($admission->status->id === 2)<span class="label label-warning">{{ $admission->status->name }}</span>@endif
                                            @if($admission->status->id === 3)<span class="label label-info">{{ $admission->status->name }}</span>@endif
                                            @if($admission->status->id === 4)<span class="label label-danger">{{ $admission->status->name }}</span>@endif
                                            @if($admission->status->id === 5)<span class="label label-success">{{ $admission->status->name }}</span>@endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="active" class="margin-r-5">Tancar</label>
                                        <input type="checkbox" id="closed" class="bt-switch-simple" name="closed" @if($admission->closed)value="1" checked @else value="0"@endif >
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="form-group">
                                    <a class="btn btn-danger" href="{{route('admissions')}}">Tornar</a>
                                    <button type="submit" class="btn btn-primary pull-right">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-md-12">

                <div class="box box-dashboard">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-6">
                                Alumnes
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admissions.students.create',['id' => $admission->id]) }}" class="btn btn-primary pull-right">
                                    <i class="fa fa-plus"></i>
                                    Crear alumne
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table no-margin table-app">
                            <tr>
                                <th>Nom</th>
                                <th>Idioma</th>
                                <th>Curs</th>
                                <th>Summer Maker</th>
                                <th></th>
                            </tr>
                            @foreach($students as $student)
                                <tr>
                                    <td class="vcenter ">{{ $student->name.' '.$student->lastname }}</td>
                                    <td class="vcenter ">@if(isset($student->language->name)) {{ $student->language->name }} @endif </td>
                                    <td class="vcenter ">@if(isset($student->course)) {{$student->course->name}} @endif</td>
                                    <td class="vcenter ">@if(isset($student->summerMaker)) {{$student->summerMaker->name}} @endif</td>
                                    <td class="control-td">
                                        <table class="table-app no-margin pull-right">
                                            <tr>
                                                <td>
                                                    <a href="{{ route('admissions.students.edit',['id' => $admission->id,'idStudent' => $student->id ]) }}" class="btn btn-warning pull-left">
                                                        <i class="fa fa-edit"></i>
                                                        Editar
                                                    </a>
                                                </td>
                                                <td>
                                                    <form method="post" action="{{route('admissions.students.destroy', ['id' => $admission->id,'idStudent'=> $student->id])}}">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger pull-right">
                                                            <i class="fa fa-times"></i>
                                                            Eliminiar
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        </table>

                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>

                </div>

            </div>

            <div class="col-md-12">

                <div class="box box-dashboard">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-6">
                                Visites
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admissions.visits.create',['id' => $admission->id]) }}" class="btn btn-primary pull-right">
                                    <i class="fa fa-plus"></i>
                                    Crear visita
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table no-margin table-app">
                            <tr>
                                <th>Data</th>
                                <th>Observacions</th>
                                <th></th>
                            </tr>
                            @foreach($visits as $visit)
                                <tr>
                                    <td class="vcenter ">{{ date_format(date_create($visit->date), 'd/m/Y H:i') }}</td>
                                    <td class="vcenter ">{{ $visit->observations }}</td>
                                    <td class="control-td">
                                        <table class="table-app no-margin pull-right">
                                            <tr>
                                                <td>
                                                    <a href="{{ route('admissions.visits.edit',['id' => $admission->id,'idVisit' => $visit->id ]) }}" class="btn btn-warning pull-left">
                                                        <i class="fa fa-edit"></i>
                                                        Editar
                                                    </a>
                                                </td>
                                                <td>
                                                    <form method="post" action="{{route('admissions.visits.destroy', ['id' => $admission->id,'idVisit'=> $visit->id])}}">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger pull-right">
                                                            <i class="fa fa-times"></i>
                                                            Eliminiar
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        </table>

                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>

                </div>

            </div>


        </div>

    </section>

@endsection
