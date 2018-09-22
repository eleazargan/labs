@extends('layouts.app')
@section('page_name', 'Home')

@section('content')
    <div class="container">
        @if(isset($successMessage))
        <div class="row">
            <div class="alert alert-success" role="alert">{{ $successMessage }}</div>
        </div>
        @endif

        <div class="row">
            <div class="page-header">
                <h1>Dashboard</h1>
            </div>
            <div class="col-md-6 col-md-push-6">
                <div class="panel panel-success">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 text-center">
                                @if($ongoing)
                                    <div id="inside">
                                        <h4>{{ $ongoing->subject->name }}</h4>
                                        <p>Time: {{ date('h:i a', strtotime($ongoing->start_time)) }} - {{ date('h:i a', strtotime($ongoing->end_time)) }}</p>
                                        <form method="post" action="{{action('StudentController@checkIn')}}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="lab" value="{{ $ongoing->id }}"/>
                                            <input type="submit" class="btn btn-block btn-success" value="Check-In">
                                        </form>
                                    </div>
                                    <div id="outside">
                                        <p><strong>Hi, {{ Auth::user()->name }}!</strong> You are not around the lab area. Please go to the lab to be able to check-in for attendance.</p>
                                    </div>
                                @else
                                    <p><strong>Hi, {{ Auth::user()->name }}!</strong> You have no ongoing lab</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-md-pull-6">
                <div class="panel panel-info">
                    <div class="panel-heading">View Attendance</div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                @foreach($subjects as $subject)
                                    <button class="btn btn-default btn-block" onClick="attendanceDetail({{$subject->id}})" >{{ $subject->name }}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade " tabindex="-1" role="dialog" id="attendance">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="border-radius: 0;box-shadow: none;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Student Lab Attendance</h4>
                </div>
                <div class="modal-body" style="overflow-y: auto;">
                    <h5 id="table-name"><strong>Name:</strong> {{ Auth::user()->name }}</h5>
                    <div id="table-subject"></div>
                    <h3 class="text-center" id="table-missing">You have not registered any lab for this subject.</h3>
                    <table class="table table-bordered table-responsive" id="table-table">
                        <thead>
                        <tr id="attendance-header">

                        </tr>
                        </thead>
                        <tbody>
                        <tr id="attendance-body">
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_css')
    <style>
        .page-header {
            margin-top: 0px;
            padding: 0 16px;
            border: none;
        }
        @media(max-width: 390px) {
            .modal-dialog {
                top: 25vh !important;
            }
        }
    </style>
@endsection

@section('custom_js')
    <script>
        $(document).ready(function () {
            getLocation();
        });

        var x = document.getElementById("demo");
        var lat = '{!! $ongoing? $ongoing->lat: 0 !!}';
        var long = '{!! $ongoing? $ongoing->long: 0 !!}';
        var inside = $('#inside');
        var outside = $('#outside');
        inside.hide();
        outside.hide();

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            if (distance(position.coords.latitude, position.coords.longitude, lat, long, "K") > 0.04) {
                inside.show();
            } else {
                outside.show();
            }
        }

        function distance(lat1, lon1, lat2, lon2, unit) {
            var radlat1 = Math.PI * lat1/180
            var radlat2 = Math.PI * lat2/180
            var theta = lon1-lon2
            var radtheta = Math.PI * theta/180
            var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
            if (dist > 1) {
                dist = 1;
            }
            dist = Math.acos(dist)
            dist = dist * 180/Math.PI
            dist = dist * 60 * 1.1515
            if (unit=="K") { dist = dist * 1.609344 }
            if (unit=="N") { dist = dist * 0.8684 }
            return dist
        }

        function attendanceDetail(id) {
            $('#table-missing').hide();
            $('#table-name').hide();
            $('#table-table').hide();
            $('#table-subject').hide();
            $('#table-subject').empty();
            $.get('/get/attendance/' + id, function( data ) {
                if (data[0].lab.length === 0) {
                    $('#table-missing').show();
                } else {
                    $('#table-name').show();
                    $('#table-table').show();
                    $('#table-subject').show();
                    $('#table-subject').append('<h5><strong>Subject:</strong> ' + data[0].subject.name + '</h5>');

                    let newHeader = null;
                    let newBody = null;
                    let lab = data[0].lab[0]? data[0].lab[0]: data[0].lab[1];
                    let attendance = data[0].attendance? data[0].attendance: null;

                    for (let j = 0; j < lab.total_weeks; j ++) {

                        newHeader += '<th style="font-weight: bold;">' + 'Week ' + (j+1) + '</th>';

                        if (j+1 <= lab.week) {
                            let count = 0;
                            if (attendance) {
                                for (let k = 0; k < attendance.length; k++) {
                                    if (attendance[k].lab_id === lab.id && j+1 === attendance[k].week) {
                                        count++;
                                    }
                                }
                            }
                            if (count === 0) {
                                newBody += '<td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>';
                            } else {
                                newBody += '<td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>';
                            }
                        } else {
                            newBody += '<td style="font-weight: bold;">' + 'TBD' + '</td>';
                        }
                    }
                    $('#attendance-header').html(newHeader);

                    $('#attendance-body').html(newBody);
                }
            });
            $('#attendance').modal();
        }
    </script>
@endsection
