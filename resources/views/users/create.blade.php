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
                        <li><a href="{{route('administration.users')}}">Usuaris</a></li>
                        <li class="active">Crear usuari</li>
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
                            Crear usuari
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
                            <form method="post" action="{{route('administration.users.store')}}">
                                @csrf
                                <input name="contact_date" type="hidden" value="{{ date('Y-m-d') }}">
                                <div class="box-body">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label for="name">Nom usuari</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="password">Contrasenya</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label for="role_id">Rol</label>
                                        <select class="form-control" id="role_id" name="role_id">
                                            @foreach($roles as $role)
                                                @if($role->name !== 'SuperAdmin' || auth()->user()->isSuperAdmin())
                                                    <option value="{{$role->id}}" @if($role->name === 'Usuari') selected @endif> {{$role->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                    {{-- Número de visites --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="phone_one">Nom complet</label>
                                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Observacions</label>
                                            <textarea class="form-control" name="observations" rows="3" placeholder=""></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="active" class="margin-r-5">Actiu</label>
                                            <input type="checkbox" id="active" class="bt-switch-simple" name="active" value="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <div class="form-group">
                                        <a class="btn btn-danger" href="{{route('administration.users')}}">Tornar</a>
                                        <button type="submit" class="btn btn-primary pull-right">Crear</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>

            </div>


        </section>

@endsection
