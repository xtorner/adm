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
                        <li class="active">Escoles</li>
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
                            <i class="fa fa-gear left" style="vertical-align: middle; padding-right: 10px;"></i>
                        </div>
                        <h1 class="left">
                            Escoles
                        </h1>
                    </div>
                </div>
            </div>
        </section>


        <section class="content">

            <div class="row">

                <div class="col-md-6">

                    <div class="box box-dashboard">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('administration.schools.create') }}" class="btn btn-primary pull-right">
                                        <i class="fa fa-plus"></i>
                                        Crear escola
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <table class="table no-margin table-app">
                                <tr>
                                    <th>Nom escola</th>
                                    <th></th>
                                </tr>
                                @foreach($schools as $school)
                                    <tr>
                                        <td class="vcenter">{{ $school->name }}</td>
                                        <td class="control-td">

                                            <table class="table-app no-margin pull-right">
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('administration.schools.edit',['id' => $school->id ]) }}" class="btn btn-warning pull-left">
                                                            <i class="fa fa-edit"></i>
                                                            Editar
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <form method="post" action="{{route('administration.schools.destroy', ['id'=> $school->id])}}">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger pull-right">
                                                                <i class="fa fa-times"></i>
                                                                Eliminar
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
