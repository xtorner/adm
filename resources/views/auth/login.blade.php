@extends('layouts.app')

@section('title')
    Login
@endsection

@section('body-class')body-white login-page @endsection

@section('content')

    <div class="login-box">
        <div class="login-logo">
            <img src="{{asset('images/logo.png')}}" class="img-responsive" style="vertical-align: text-bottom; height: 60px; margin-top:35px; margin:auto">
        </div>
        <div class="login-box-body">
            <form action="{{route('login.store')}}" method="post" role="form">
                @csrf
                <div class="input-group m-top10">
                    <span class="input-group-addon" id="basic-addon1">
                        <i class="glyphicon glyphicon-user" style="font-size: 100%; vertical-align: middle;"></i>
                    </span>
                    <input type="text" class="form-control" id="email" name="username" value="" placeholder="nom d'usuari" aria-describedby="basic-addon1">
                </div>
                <div class="input-group m-top10">
                    <span class="input-group-addon" id="basic-addon2">
                        <i class="fa fa-key" style="font-size: 100%; vertical-align: middle;"></i>
                    </span>
                    <input type="password" class="form-control" id="password" name="password" value="" placeholder="contrasenya" aria-describedby="basic-addon2">
                </div>
                <button type="submit" class="btn btn-default btn-block m-top10">
                    <i class="fa fa-sign-in" style="vertical-align: middle; padding-right: 10px;"></i>
                    Entrar
                </button>
            </form>
        </div>
    </div>

@endsection
