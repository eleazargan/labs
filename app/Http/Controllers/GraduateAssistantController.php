<?php

namespace App\Http\Controllers;

use App\GraduateAssistant;
use App\Lab;
use App\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GraduateAssistantController extends Controller
{
    public function lab()
    {
        $user = Auth::user();
        $ga = GraduateAssistant::where('user_id', $user->id)->first();
        $subjects = $ga->subjects;

        return view('ga.lab', ['page' => 'lab', 'subjects' => $subjects]);
    }

    public function createLab(Request $request)
    {
        $user = Auth::user();
        $ga = GraduateAssistant::where('user_id', $user->id)->first();
        $subject = Subject::find($request->get('subject'));
        $locations = explode(",", substr($request->get('location'), 1, -1));

        $days = $request->get('total_weeks') * 7;

        $lab = new Lab([
            'location' => $locations[0],
            'day' => $request->get('day'),
            'lat' => doubleval($locations[1]),
            'long' => doubleval($locations[2]),
            'start_time' => $request->get('start_time'),
            'end_time' => $request->get('end_time'),
            'start_date' => Carbon::today(),
            'end_date' => Carbon::today()->addDay($days),
            'week' => 1,
            'total_weeks' => $request->get('total_weeks'),
            'status' => "CLOSE",
            'max_student' => $request->get('max_student')
        ]);

        $lab->subject()->associate($subject);
        $lab->graduateAssistant()->associate($ga);
        $lab->save();

        return redirect('/');
    }

    public function changeStatus($id)
    {
        $lab = Lab::find($id);

        if ($lab->status === "CLOSE") {
            $lab->status = "OPEN";
            $lab->save();
        } elseif ($lab->status === "OPEN") {
            $lab->status = "CLOSE";
            $lab->save();
        }
        return "success";
    }

    public function changeWeek($id, $week)
    {
        $lab = Lab::find($id);
        $lab->week = $week;
        $lab->save();

        return "success";
    }

    public function attendance($id)
    {
        $lab = Lab::find($id);
        $attendances = $lab->attendances;
        $students = $lab->students;

        return view('ga.attendance', ['page' => 'attendance', 'attendances' => $attendances, 'lab' => $lab, 'students' => $students]);
    }
}
