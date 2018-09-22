@extends('layouts.app')
@section('page_name', 'Register Lab')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h1>Register Lab Slot</h1>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <form class="form-horizontal" method="POST" action="{{action('StudentController@doRegister')}}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="subject" class="col-sm-2 control-label">Subject</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="subject" id="subject">
                                                @if(sizeof($subjects) == 0)
                                                    <option value="" hidden>You have registered all subjects.</option>
                                                @else
                                                    <option value="" hidden>Select Subject of Lab</option>
                                                    @foreach($subjects as $subject)
                                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="lab" class="col-sm-2 control-label">Lab</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="lab" id="lab">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-default" id="submitForm" disabled>Register</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_css')
    <style>
        .page-header {
            margin-top: 0px;
            border: none;
        }
    </style>
@endsection

@section('custom_js')
    <script>
        $(document).ready(function () {
            let subject = $('#subject');
            let lab = $('#lab');

            subject.on('change', function () {
                $.get('/labs/get/' + $(this).find(":selected").val(), function( data ) {
                    console.log(data);
                    let labs = JSON.parse(data);
                    let listItems= "";

                    for (let i = 0; i < labs.length; i++){
                        let start_time = labs[i]['start_time'].toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [labs[i]['start_time']];

                        if (start_time.length > 1) { // If time format correct
                            start_time = start_time.slice (1);  // Remove full string match value
                            start_time[5] = +start_time[0] < 12 ? 'AM' : 'PM'; // Set AM/PM
                            start_time[0] = +start_time[0] % 12 || 12; // Adjust hours
                        }
                        let end_time = labs[i]['end_time'].toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [labs[i]['end_time']];

                        if (end_time.length > 1) { // If time format correct
                            end_time = end_time.slice (1);  // Remove full string match value
                            end_time[5] = +end_time[0] < 12 ? 'AM' : 'PM'; // Set AM/PM
                            end_time[0] = +end_time[0] % 12 || 12; // Adjust hours
                        }
                        listItems+= "<option value='" + labs[i]['id'] + "'>Lab " + (i+1) + " - " + labs[i]['day'] +
                            " (" + start_time.join ('') +
                            " - " + end_time.join ('') + ")</option>";
                        $('#submitForm').prop('disabled', false);
                    }

                    if (labs.length === 0) {
                        listItems += '<option hidden >There is no lab registered for this subject yet.</option>';
                    }

                    lab.html(listItems);
                });
            });
        });
    </script>
@endsection
