<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['week'];

    public function lab()
    {
        return $this->belongsTo(Lab::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
