@extends('layouts.app')
@section('page_name', 'Lab')

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
                                <form class="form-horizontal" action="{{ action('GraduateAssistantController@createLab') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="subject" class="col-sm-3 control-label">Subject</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="subject" id="subject">
                                                <option value="" hidden>Select Subject of Lab</option>
                                                @foreach($subjects as $subject)
                                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="day" class="col-sm-3 control-label">Day</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="day" id="day">
                                                <option value="" hidden>Select Day of Lab</option>
                                                <option value="Monday">Monday</option>
                                                <option value="Tuesday">Tuesday</option>
                                                <option value="Wednesday">Wednesday</option>
                                                <option value="Thursday">Thursday</option>
                                                <option value="Friday">Friday</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="start_time" class="col-sm-3 control-label">Start Time</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="start_time" id="start_time">
                                                <option value="" hidden>Select the start time of the lab session</option>
                                                <option value="08:00:00">8:00AM</option>
                                                <option value="08:30:00">8:30AM</option>
                                                <option value="09:00:00">9:00AM</option>
                                                <option value="09:30:00">9:30AM</option>
                                                <option value="10:00:00">10:00AM</option>
                                                <option value="10:30:00">10:30AM</option>
                                                <option value="11:00:00">11:00AM</option>
                                                <option value="11:30:00">11:30AM</option>
                                                <option value="12:00:00">12:00PM</option>
                                                <option value="12:30:00">12:30PM</option>
                                                <option value="13:00:00">1:00PM</option>
                                                <option value="13:30:00">1:30PM</option>
                                                <option value="14:00:00">2:00PM</option>
                                                <option value="14:30:00">2:30PM</option>
                                                <option value="15:00:00">3:00PM</option>
                                                <option value="15:30:00">3:30PM</option>
                                                <option value="16:00:00">4:00PM</option>
                                                <option value="16:30:00">4:30PM</option>
                                                <option value="17:00:00">5:00PM</option>
                                                <option value="17:30:00">5:30PM</option>
                                                <option value="18:00:00">6:00PM</option>
                                                <option value="18:30:00">6:30PM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="end_time" class="col-sm-3 control-label">End Time</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="end_time" id="end_time">
                                                <option value="" hidden>Select the end time of the lab session</option>
                                                <option value="08:00:00">8:00AM</option>
                                                <option value="08:30:00">8:30AM</option>
                                                <option value="09:00:00">9:00AM</option>
                                                <option value="09:30:00">9:30AM</option>
                                                <option value="10:00:00">10:00AM</option>
                                                <option value="10:30:00">10:30AM</option>
                                                <option value="11:00:00">11:00AM</option>
                                                <option value="11:30:00">11:30AM</option>
                                                <option value="12:00:00">12:00PM</option>
                                                <option value="12:30:00">12:30PM</option>
                                                <option value="13:00:00">1:00PM</option>
                                                <option value="13:30:00">1:30PM</option>
                                                <option value="14:00:00">2:00PM</option>
                                                <option value="14:30:00">2:30PM</option>
                                                <option value="15:00:00">3:00PM</option>
                                                <option value="15:30:00">3:30PM</option>
                                                <option value="16:00:00">4:00PM</option>
                                                <option value="16:30:00">4:30PM</option>
                                                <option value="17:00:00">5:00PM</option>
                                                <option value="17:30:00">5:30PM</option>
                                                <option value="18:00:00">6:00PM</option>
                                                <option value="18:30:00">6:30PM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="location" class="col-sm-3 control-label">Venue</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="location" id="location">
                                                <option value="" hidden>Select the venue for the lab session</option>
                                                <option value="[01-00-10,4.381393,100.968284]">01-00-10</option>
                                                <option value="[01-00-03,4.381393,100.968284]">01-00-03</option>
                                                <option value="[01-00-04,4.381393,100.968284]">01-00-04</option>
                                                <option value="[01-01-03,4.381393,100.968284]">01-01-03</option>
                                                <option value="[01-01-05,4.381393,100.968284]">01-01-05</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="weeks" class="col-sm-3 control-label">Total Weeks</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="number" name="total_weeks" id="weeks" placeholder="Number of Weeks">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="max_student" class="col-sm-3 control-label">Maximum Student</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="number" name="max_student" id="max_student" placeholder="Maximum Number of Student">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-default">Register</button>
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