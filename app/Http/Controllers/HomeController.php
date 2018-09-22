<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\GraduateAssistant;
use App\Lab;
use App\Student;
use App\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('ga')) {
            $ga = GraduateAssistant::where('user_id', $user->id)->first();
            $labs = $ga->labs;

            return view('ga.home', ['labs' => $labs, 'page' => 'home']);
        } elseif ($user->hasRole('student')) {
            $student = Student::where('user_id', $user->id)->first();
            $subjects = $student->subjects;
            $ongoing = null;
            $attendances = $student->attendances;

            $labs = $student->labs;
            if ($labs) {
                foreach ($labs as $lab) {
                    if ($lab->start_date <= Carbon::now() && $lab->end_date >= Carbon::today()) {
                        if ($lab->status == "OPEN") {
                            $attendance = $attendances->filter(function ($attendance) use ($lab) {
                                return $attendance->week === $lab->week && $attendance->lab->id === $lab->id;
                            });
                            $count = 0;
                            foreach ($attendance as $item) {
                                if ($item->student->id == $student->id) {
                                    $count++;
                                }
                            }

                            if($count == 0) {
                                $ongoing = $lab;
                                break;
                            }
                        }
                    }
                }
            }

            return view('student.home', ['subjects' => $subjects, 'ongoing' => $ongoing, 'page' => 'home']);
        } else {
            $labs = Lab::all();

            return view('registry.home', ['labs' => $labs, 'page' => 'home']);
        }
    }
}
