<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class GraduateAssistant
 *
 * @property Collection labs
 * @package App
 */
class GraduateAssistant extends Model
{
    protected $fillable = ['name'];

    public function labs()
    {
        return $this->hasMany(Lab::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function addLab(Lab $lab)
    {
        $lab->save();
        $this->labs()->save($lab);
        $this->labs->push($lab);

        return $lab;
    }
}
