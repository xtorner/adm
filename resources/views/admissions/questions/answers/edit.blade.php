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
                    <li>Admissions</li>
                    <li><a href="{{route('administration.admissions.questions')}}">Preguntes</a></li>
                    <li class="active">Editar Resposta</li>
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
                        Editor Resposta
                    </h1>
                </div>
            </div>
        </div>
    </section>


    <section class="content">

        <div class="row">

            <div class="col-md-4">

                <div class="box box-dashboard">
                    <div class="box-header">
                        {{$question->question}}
                    </div>
                    <div class="box-body">
                        <form method="post" action="{{route('administration.admissions.questions.answers.update', ['id'=>$question->id, 'idAnswer'=>$answer->id])}}">
                            @csrf
                            @method('PATCH')
                            <div class="box-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="port">Resposta</label>
                                        <input type="text" class="form-control" id="answer" name="answer" value="{{ $answer->answer }}">
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary pull-right">
                                        <i class="fa fa-check"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>

        </div>


    </section>

@endsection
