@extends('layouts.app')
@section('page_name', 'Home')

@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1 class="pull-left">Attendance</h1>
                <a class="btn btn-default pull-right" target="__blank" href="{{action('AttendanceController@downloadCSV', ['id' => $lab->id])}}">Download CSV</a>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-12">
                <table id="table_id" class="display nowrap" style="width:100%">
                    <thead>
                    <tr>
                        <th></th>
                        <th>&nbsp;</th>
                        @php($counter = 0)

                        @for($i = 0; $i < $lab->total_weeks; $i ++)
                            <th style="width: 7%;text-align: center;">Wk {{ $counter + 1 }}</th>
                            @php($counter++)
                        @endfor
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td></td>
                                <td>{{$student->name}}</td>
                                @for($i = 0; $i < $counter; $i++)
                                    @if($i < $lab->week)
                                        @php($found = 0)

                                        @foreach($attendances as $attendance)
                                            @if($attendance->student_id == $student->id && $attendance->week == ($i+1))
                                                <td style="width: 7%;"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                                @php($found++)
                                            @endif
                                        @endforeach
                                        @if($found === 0)
                                            <td style="width: 7%;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                        @endif
                                    @else
                                        <td style="font-weight: bold;width: 7.5%;">TBD</td>
                                    @endif

                                @endfor
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">

    <style>
        .page-header {
            margin-top: 0px;
            padding: 0 16px;
            border: none;
        }
    </style>
@endsection

@section('custom_js')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable( {
                responsive: {
                    details: {
                        type: 'column'
                    }
                },
                columnDefs: [ {
                    className: 'control',
                    orderable: false,
                    targets:   0
                } ],
                order: [ 1, 'asc' ]
            } )
        } );
    </script>
@endsection
