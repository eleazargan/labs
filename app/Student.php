<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Student
 *
 * @property Collection attendances
 * @package App
 */
class Student extends Model
{
    protected $fillable = ['name', 'student_number'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function labs()
    {
        return $this->belongsToMany(Lab::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function submitAttendance(Attendance $attendance)
    {
        $attendance->save();
        $this->attendances()->save($attendance);
        $this->attendances->push($attendance);

        return $attendance;
    }

    public function registerLab()
    {

    }
}
