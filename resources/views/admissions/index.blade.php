@extends('layouts.admin')

@section('title')
    Dashboard
@endsection
@section('content')
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select name="" class="form-control pull-right" id="datepicker_from" multiple="multiple">
                                        @foreach ($courses as $course)
                                            <option value="{{$course->date_admission}}/{{$course->date_admission_end}}">{{$course->name}}</option>
                                        @endforeach
                                        <
                                    </select>
                                </div>
                            </div>
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
    <script>

    $(document).ready(function () {

        $.fn.dataTable.moment( 'DD/MM/YYYY HH:mm');
        $.fn.dataTable.moment( 'DD/MM/YYYY');
        $.fn.dataTable.moment = function ( format, locale ) {
            var types = $.fn.dataTable.ext.type;
            types.detect.unshift( function ( d ) {
                return moment( d, format, locale, true ).isValid() ?
                    'moment-'+format :
                    null;
            } );
            types.order[ 'moment-'+format+'-pre' ] = function ( d ) {
                return moment( d, format, locale, true ).unix();
            };
        };

        $('#datepicker_from').multiselect({
            allSelectedText: 'Tot seleccionat',
            buttonWidth: '300px',
            includeSelectAllOption: true,
            nonSelectedText: 'Seleccionar curs…',
            selectAllText: 'Seleccionar tot',
        }).multiselect('updateButtonText');

        var table = $('#admissions').DataTable({
            'language': {
                'url': '/datatables/i18n/Catalan.json'
            },
            //"dom"         : '<".col-sm-3"l><".col-sm-3 filterC"><".col-sm-6"f>t<".col-sm-6"i><".col-sm-6"p>',
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false,
            'stateSave'   : true,
            "stateSaveParams": function (settings, data) {
                var selected=[];
                $('#datepicker_from :selected').each(function(){
                    selected.push($(this).val());
                });
                Object.assign(data, {courses: selected});
            },
            "stateLoadParams": function (settings, data) {
                $('#datepicker_from').multiselect('select', data.courses);
            },
            'initComplete': function(settings) {
                $('#datepicker_from').trigger('change');
            }
        })

        var entrar = "a"
        var min = moment('2080-05-20', 'YYYY-MM-DD');
        var max = moment('2001-01-01', 'YYYY-MM-DD');

        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                var dat = moment(data[1], 'DD/MM/YYYY');
                    min = moment(min, 'DD/MM/YYYY');
                    max = moment(max, 'DD/MM/YYYY');
                    if(entrar == "a" || (dat.diff(min,'days') >= 0 && max.diff(dat,'days') >= 0))
                    {
                        return true;
                    }
                    return false;

            }
        );

        var date = $('#datepicker_from').change(function (e) {

                min = moment('2080-01-01', 'YYYY-MM-DD');
                max = moment('2001-01-01', 'YYYY-MM-DD');
                var selected=[];
                $('#datepicker_from :selected').each(function(){
                selected.push($(this).val());
                });
                var fech = selected.join(", ");
                var fechall = fech.split(',');;
                if(fech == "")
                    entrar = "a";
                else
                {
                    fechall.forEach(function(fechs)
                    {
                        fechs1 = fechs.split('/');
                        if(entrar == "a" || min >  moment(fechs1[0], 'YYYY-MM-DD'))
                        {
                            min = moment(fechs1[0], 'YYYY-MM-DD');
                        }
                        if(entrar == "a" || max <  moment(fechs1[1], 'YYYY-MM-DD')){
                            max = moment(fechs1[1], 'YYYY-MM-DD');
                        }
                        entrar = "b";
                    });
                    min = moment(min).format('DD/MM/YYYY')
                    max = moment(max).format('DD/MM/YYYY')
                }
                table.draw();
        });


    });
    </script>
@endsection
