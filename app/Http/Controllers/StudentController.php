<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Lab;
use App\Student;
use App\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function registerLab()
    {
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();
        $subjects = $student->subjects;
        $labs = $student->labs;

        foreach($labs as $lab) {
            $subjects = $subjects->reject(function ($subject) use ($lab) {
               return $subject->id == $lab->subject->id;
            });
        }

        return view('student.register', ['page' => 'register', 'subjects' => $subjects]);
    }

    public function doRegister(Request $request)
    {
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();

        $student->labs()->attach($request->get('lab'));

        return redirect('/');
    }

    public function getLabs($id)
    {
        $labs = Lab::where('subject_id', $id)->get();

        $labs = $labs->reject(function ($lab) {
            return count($lab->students) == $lab->max_student;
        });

        return $labs->toJSON();
    }

    public function checkIn(Request $request)
    {
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();

        $lab = Lab::find($request->get('lab'));

        $attendance = new Attendance([
            'week' => $lab->week
        ]);
        $attendance->lab()->associate($lab);

        $student->attendances()->save($attendance);

        return redirect('/')->with('successMessage', 'You have checked in to lab ' . $lab->subject->name . ' successfully!');
    }

    public function getAttendance($id)
    {
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();

        $tempAttendance = $student->attendances->filter(function ($attendance) use ($id) {
           return $attendance->lab->subject->id == $id;
        });

        $attendance = collect();
        foreach($tempAttendance as $item) {
            $attendance->push($item);
        }

        $tempLab = $student->labs->filter(function ($lab) use ($id) {
            return $lab->subject->id == $id;
        });

        $lab = collect();
        foreach($tempLab as $item) {
            $lab->push($item);
        }

        $response = collect([
            ['lab' => $lab, 'attendance' => $attendance, 'subject' => Subject::find($id)]
        ]);

        return $response;
    }
}
