<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    protected $fillable = ['location', 'day', 'lat', 'long', 'start_time', 'end_time',
        'start_date', 'end_date', 'week', 'total_weeks', 'status', 'total', 'max_student'];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function graduateAssistant()
    {
        return $this->belongsTo(GraduateAssistant::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
