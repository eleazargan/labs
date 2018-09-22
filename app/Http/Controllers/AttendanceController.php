<?php

namespace App\Http\Controllers;

use App\Lab;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function downloadCSV($id)
    {
        $lab = Lab::find($id);
        $students = $lab->students;
        $attendances = $lab->attendances;

        $filename = str_replace(' ', '_', $lab->subject->code . " " . $lab->day . " " . date('h', strtotime($lab->start_time)) . " to " . date('h', strtotime($lab->end_time)) . ".csv");
        $handle = fopen($filename, 'w+');
        $counter = 0;

        $th = array(' ');
        for($i = 0; $i < $lab->total_weeks; $i ++) {
            array_push($th, 'Week ' . ($counter + 1));
            $counter ++;
        }
        fputcsv($handle, $th);

        foreach($students as $student) {
            $studentRow = array($student->name);

            for($i = 0; $i < $lab->total_weeks; $i ++) {
                if ($i < $lab->week) {
                    $found = 0;
                    foreach($attendances as $attendance) {
                        if($attendance->student_id == $student->id && $attendance->week == ($i+1)) {
                            array_push($studentRow, '1');
                            $found++;
                        }
                    }

                    if ($found == 0) {
                        array_push($studentRow, '0');
                    }
                } else {
                    array_push($studentRow, 'TBD');
                }
                $counter ++;
            }
            fputcsv($handle, $studentRow);
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return response()->download($filename, $filename, $headers)->deleteFileAfterSend(true);
    }
}
