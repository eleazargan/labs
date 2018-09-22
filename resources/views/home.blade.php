@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@role('ga') Hello GA! @else Hello Student @endrole</div>

                <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ action("GraduateAssistantController@createLab") }}">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="subject" class="col-sm-2 control-label">Subject</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="subject" name="subject">
                                        @foreach($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="start_time" class="col-sm-2 control-label">Start Time</label>
                                <div class="col-sm-10">
                                    <div class="input-group date" id="start_time">
                                        <input type="text" class="form-control" name="start_time" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="end_time" class="col-sm-2 control-label">End Time</label>
                                <div class="col-sm-10">
                                    <div class="input-group date" id="end_time">
                                        <input type="text" class="form-control" name="end_time"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="start_date" class="col-sm-2 control-label">Start Date</label>
                                <div class="col-sm-10">
                                    <div class="input-group date" id="start_date">
                                        <input type="text" class="form-control" name="start_date" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="end_date" class="col-sm-2 control-label">End Date</label>
                                <div class="col-sm-10">
                                    <div class="input-group date" id="end_date">
                                        <input type="text" class="form-control" name="end_date" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="location" class="col-sm-2 control-label">Location</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="location" name="location">
                                        <option value="[01-00-10,4.381393,100.968284]">01-00-10</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">Create Lab Slot</button>
                                </div>
                            </div>
                        </form>

                    {{--<table id="table_id" class="display">--}}
                        {{--<thead>--}}
                        {{--<tr>--}}
                            {{--<th>Column 1</th>--}}
                            {{--<th>Column 2</th>--}}
                        {{--</tr>--}}
                        {{--</thead>--}}
                        {{--<tbody>--}}
                        {{--<tr>--}}
                            {{--<td>Row 1 Data 1</td>--}}
                            {{--<td>Row 1 Data 2</td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td>Row 2 Data 1</td>--}}
                            {{--<td>Row 2 Data 2</td>--}}
                        {{--</tr>--}}
                        {{--</tbody>--}}
                    {{--</table>--}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
            $('#start_time').datetimepicker({
                format: 'LT'
            });
            $('#end_time').datetimepicker({
                format: 'LT'
            });
            $('#start_date').datetimepicker({
                format: 'DD/MM/YYYY'
            });
            $('#end_date').datetimepicker({
                format: 'DD/MM/YYYY'
            });
        } );
    </script>
@endsection
