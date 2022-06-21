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
                        <li class="active">Cursos</li>
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
                            Cursos
                        </h1>
                    </div>
                </div>
            </div>
        </section>


        <section class="content">

            <div class="row">

                <div class="col-md-12">

                    <div class="box box-dashboard">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('administration.information.courses.create') }}" class="btn btn-primary pull-right">
                                        <i class="fa fa-plus"></i>
                                        Crear curs
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <table class="table no-margin table-app">
                                <tr>
                                    <th>Nom curs</th>
                                    <th>Any</th>
                                    <th>Data preinscripció</th>
                                    <th>Data final preinscripció</th>
                                    <th>Data inici</th>
                                    <th>Data final</th>
                                    <th>Data admissió</th>
                                    <th>Data final admissió</th>
                                    <th>Estat</th>
                                    <th></th>
                                </tr>
                                @foreach($courses as $course)
                                    <tr>
                                        <td class="vcenter">{{ $course->name }}</td>
                                        <td class="vcenter">{{ $course->year }}</td>
                                        <td class="vcenter">{{ date('d-m-Y',strtotime($course->date_preins)) }}</td>
                                        <td class="vcenter">{{ date('d-m-Y',strtotime($course->date_preins_end)) }}</td>
                                        <td class="vcenter">{{ date('d-m-Y',strtotime($course->date_start)) }}</td>
                                        <td class="vcenter">{{ date('d-m-Y',strtotime($course->date_end)) }}</td>
                                        <td class="vcenter">{{ date('d-m-Y',strtotime($course->date_admission)) }}</td>
                                        <td class="vcenter">{{ date('d-m-Y',strtotime($course->date_admission_end)) }}</td>
                                        <td class="vcenter">
                                            @if($course->active)
                                            <span class="label label-success">Actiu</span>
                                            @else
                                            <span class="label label-danger">Desactivat</span>
                                            @endif
                                        </td>
                                        <td class="control-td">

                                            <table class="table-app no-margin pull-right">
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('administration.information.courses.edit',['id' => $course->id ]) }}" class="btn btn-warning pull-left">
                                                            <i class="fa fa-edit"></i>
                                                            Editar
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <form method="post" action="{{route('administration.information.courses.destroy', ['id'=> $course->id])}}">
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
