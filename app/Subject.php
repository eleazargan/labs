<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Subject
 *
 * @property Collection labs
 * @package App
 */
class Subject extends Model
{

    protected $fillable = ['name', 'code'];

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function graduateAssistant()
    {
        return $this->belongsToMany(GraduateAssistant::class);
    }

    public function labs()
    {
        return $this->hasMany(Lab::class);
    }

    public function addLab(Lab $lab)
    {
        $lab->save();
        $this->labs()->save($lab);
        $this->labs->push($lab);

        return $lab;
    }
}
