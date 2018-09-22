@extends('layouts.app')
@section('page_name', 'Home')

@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>Dashboard</h1>
            </div>
            <div class="col-md-12">
                <table id="registry_labs" class="display nowrap" style="width:100%">
                    <thead>
                    <tr>
                        <th style="width: 5%;"></th>
                        <th>Subject</th>
                        <th>Lab</th>
                        <th>Number of Students</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($labs as $lab)
                        <tr>
                            <td></td>
                            <td>{{$lab->subject->name}}</td>
                            <td><strong>{{ $lab->day }}</strong> <strong>({{ date('h:i a', strtotime($lab->start_time)) }} - {{ date('h:i a', strtotime($lab->end_time)) }})</strong> ({{$lab->location}})</td>
                            <td><a href="{{ action('GraduateAssistantController@attendance', ['id' => $lab->id]) }}">{{ count($lab->students) }} / {{ $lab->max_student }} @if(count($lab->students) == $lab->max_student) <strong>(Full)</strong> @endif</a></td>
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
        table {
            background-color: #fff;
        }
        .material-switch > input[type="checkbox"] {
            display: none;
        }

        .material-switch > label {
            cursor: pointer;
            height: 0px;
            position: relative;
            width: 40px;
        }

        .material-switch > label::before {
            background: rgb(0, 0, 0);
            box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            content: '';
            height: 16px;
            margin-top: -8px;
            position:absolute;
            opacity: 0.3;
            transition: all 0.4s ease-in-out;
            width: 40px;
        }
        .material-switch > label::after {
            background: rgb(255, 255, 255);
            border-radius: 16px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
            content: '';
            height: 24px;
            left: -4px;
            margin-top: -8px;
            position: absolute;
            top: -4px;
            transition: all 0.3s ease-in-out;
            width: 24px;
        }
        .material-switch > input[type="checkbox"]:checked + label::before {
            background: inherit;
            opacity: 0.5;
        }
        .material-switch > input[type="checkbox"]:checked + label::after {
            background: inherit;
            left: 20px;
        }
        tr { height: 50px; }
    </style>
@endsection

@section('custom_js')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#registry_labs').DataTable( {
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
        function changeStatus(id) {
            $.get('/change/status/' + id, function( data ) {
                if (data === 'success') {
                    alert("Status changed successfully.")
                } else {
                    alert("Status changed unsuccessful.")
                }
            });
        }

        function changeWeek(week, id) {
            $.get('/change/week/' + id + '/' + week, function( data ) {
                if (data === 'success') {
                    alert("Status changed successfully.")
                } else {
                    alert("Status changed unsuccessful.")
                }
            });
        }
    </script>
@endsection
