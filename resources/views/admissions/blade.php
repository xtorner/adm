@extends('layouts.admin')

@section('title')
    Dashboard
@endsection

@section('content')
        <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
        <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
        @inject('visitService', 'App\Services\Admission\VisitService')

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i>Tauler Control</a></li>
                        <li class="active">Admissions</li>
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
                <div class="col-md-6">
                    <div class="header-page">
                        <div class="header-icon">
                            <i class="fa fa-newspaper-o left" style="vertical-align: middle; padding-right: 10px;"></i>
                        </div>
                        <h1 class="left">
                            Admissions
                        </h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="datepicker_from">
                        </div>
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
                                    <a href="{{ route('admissions.create') }}" class="btn btn-primary pull-right">
                                        <i class="fa fa-plus"></i>
                                        Crear admissió
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <table id="admissions" class="table no-margin table-app">
                                <thead>
                                    <th>Familia</th>
                                    <th>Data contacte</th>
                                    <th>Data visita</th>
                                    <th>Núm. fills</th>
                                    <th>Curs fills</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                @foreach($admissions as $admission)
                                    <tr>
                                        <td class="vcenter text-uppercase">{{ $admission->name }}</td>
                                        <td class="vcenter text-uppercase">{{ date_format(date_create($admission->contact_date), 'd/m/Y') }}</td>
                                        <td class="vcenter text-uppercase">@if(isset($visitService->findLatest($admission)->date)){{ date_format(date_create($visitService->findLatest($admission)->date), 'd/m/Y H:i') }}@endif</td>
                                        <td class="vcenter text-uppercase">{{ $admission->students->count() }}</td>
                                        <td class="vcenter text-uppercase">
                                            @foreach($admission->students as $student)
                                                {{$student->name}} - @isset($student->course) {{ $student->course->name }} @endisset<br />
                                            @endforeach
                                        </td>
                                        <td class="control-td">
                                            <table class="table-app no-margin pull-right">
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('admissions.edit',['id' => $admission->id ]) }}" class="btn btn-warning pull-left">
                                                            <i class="fa fa-edit"></i>
                                                            Editar
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <form method="post" action="{{route('admissions.destroy', ['id'=> $admission->id])}}">
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
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>

            </div>


        </section>

@endsection

@section('footer-js')
    <script src="https://adminlte.io/themes/AdminLTE/bower_components/moment/min/moment.min.js"></script>
    <script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
         


    $(document).ready(function () {

        // $.fn.dataTable.moment( 'DD/MM/YYYY HH:mm');
        // $.fn.dataTable.moment( 'DD/MM/YYYY');
        // $.fn.dataTable.moment = function ( format, locale ) {
        //     var types = $.fn.dataTable.ext.type;
        //     types.detect.unshift( function ( d ) {
        //         return moment( d, format, locale, true ).isValid() ?
        //             'moment-'+format :
        //             null;
        //     } );
        //     types.order[ 'moment-'+format+'-pre' ] = function ( d ) {
        //         return moment( d, format, locale, true ).unix();
        //     };
        // };
        
        var table = $('#admissions').DataTable({
            'language': {
                'url': '/datatables/i18n/Catalan.json'
            },
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false,
            'stateSave'   : true
        });
        function search(){
            $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                    var min =  $('#datepicker_from').val();
                    if(min != ''){
                        min = moment(min, 'DD/MM/YYYY');
                        var max = moment(min,'DD/MM/YYYY').add(1, 'years').subtract(1,'d');
                        var dat = moment(data[1], 'DD/MM/YYYY');
                        if(dat >= min && dat <= max )
                        {
                            console.log("entro");
                            return true;
                        }
                        return false;
                    }
                }
            );
        }
        
         var date = $('#datepicker_from').datepicker({
            format: 'dd/mm/yyyy',
         }).on("input change", function (e) {
                search();
                table.draw();
        });
    });
    </script>
@endsection
