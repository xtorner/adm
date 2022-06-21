@extends('layouts.admin')

@section('title')
    Dashboard
@endsection

@section('content')

    @inject('visitService', 'App\Services\Admission\VisitService')


    <section class="content">

        <div class="row">

            <div class="col-md-12">

                <div class="box box-dashboard">
                    <div class="box-header">
                        <h3 class="box-title">Admissions</h3>
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
                                <th>Nom familia</th>
                                <th>Data contacte</th>
                                <th>Data ultima visita</th>
                                <th>Estat</th>
                                <th>Núm. fills</th>
                                <th>Curs fills</th>
                                <th>Telefon</th>
                                <th>Email</th>
                                <th>Data matricula</th>
                            </thead>
                            <tbody>
                            @foreach($admissions as $admission)
                                <tr>
                                    <td class="vcenter"> <a href="{{ route('admissions.edit',['id' => $admission->id ]) }}">{{ $admission->name }}</a></td>
                                    <td class="vcenter">{{ date_format(date_create($admission->contact_date), 'd/m/Y') }}</td>
                                    <td class="vcenter">@if(isset($visitService->findLatest($admission)->date)){{ date_format(date_create($visitService->findLatest($admission)->date), 'd/m/Y H:i') }}@endif</td>
                                    <td class="vcenter">
                                        @if($admission->status->id === 1)<span class="label bg-gray-active">{{ $admission->status->name }}</span>@endif
                                        @if($admission->status->id === 2)<span class="label label-warning">{{ $admission->status->name }}</span>@endif
                                        @if($admission->status->id === 3)<span class="label label-info">{{ $admission->status->name }}</span>@endif
                                        @if($admission->status->id === 4)<span class="label label-danger">{{ $admission->status->name }}</span>@endif
                                        @if($admission->status->id === 5)<span class="label label-success">{{ $admission->status->name }}</span>@endif
                                    </td>
                                    <td class="vcenter">{{ $admission->students->count() }}</td>
                                    <td class="vcenter">
                                        @foreach($admission->students as $student)
                                            {{$student->name}} - @isset($student->course) {{ $student->course->name }} @endisset<br />
                                        @endforeach
                                    </td>
                                    <td class="vcenter">{{$admission->phone_one}}</td>
                                    <td class="vcenter">{{$admission->email_one}}</td>
                                    <td class="vcenter">@if(isset($admission->enrollment_date)){{ date_format(date_create($admission->enrollment_date), 'd/m/Y') }}@endif</td>
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
            });

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

            $('#datepicker_from').change(function (e) {

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
