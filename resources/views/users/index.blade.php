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
                        <li class="active">Usuaris</li>
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
                        <h1 class="left">
                            Usuaris
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
                                    <a href="{{ route('administration.users.create') }}" class="btn btn-primary pull-right">
                                        <i class="fa fa-plus"></i>
                                        Crear usuari
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <table id="users" class="table no-margin table-app">
                                <thead>
                                    <th>Nom usuari</th>
                                    <th>Rol</th>
                                    <th>Nom complet</th>
                                    <th>Observacions</th>
                                    <th>Estat</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    @if(!$user->isSuperAdmin())
                                        <tr>
                                            <td class="vcenter ">{{ $user->username }}</td>
                                            <td class="vcenter ">{{ $user->role->name }}</td>
                                            <td class="vcenter ">{{ $user->fullname }}</td>
                                            <td class="vcenter ">{{ $user->observations }}</td>
                                            <td class="vcenter">
                                                @if($user->active)
                                                    <span class="label label-success">Actiu</span>
                                                @else
                                                    <span class="label label-danger">Desactivat</span>
                                                @endif
                                            </td>
                                            <td class="control-td">
                                                <table class="table-app no-margin pull-right">
                                                    <tr>
                                                        <td>
                                                            <a href="{{ route('administration.users.edit',['id' => $user->id ]) }}" class="btn btn-warning pull-left">
                                                                <i class="fa fa-edit"></i>
                                                                Editar
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <form method="post" action="{{route('administration.users.destroy', ['id'=> $user->id])}}">
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
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>

            </div>


        </section>

@endsection

@section('footer-js')
    <script>
        $(document).ready(function () {

            $('#users').DataTable({
                'language': {
                    'url': '/datatables/i18n/Catalan.json'
                },
                'paging'      : true,
                'lengthChange': false,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })

        });
    </script>
@endsection
