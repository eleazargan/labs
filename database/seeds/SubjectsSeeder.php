<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Subject;
use App\GraduateAssistant;
use App\Lab;
use Carbon\Carbon;

class SubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subject1 = new Subject([
            'name' => "Artificial Intelligence",
            'code' => "TDB3410"
        ]);
        $subject1->save();

        $subject2 = new Subject([
            'name' => "Software Requirement Engineering",
            'code' => "TDB4313"
        ]);
        $subject2->save();

        $subject3 = new Subject([
            'name' => "Software Testing and Quality Assurance",
            'code' => "TDB4333Z"
        ]);
        $subject3->save();

        $subject4 = new Subject([
            'name' => "Software Design and Architecture",
            'code' => "TDB4323Z"
        ]);
        $subject4->save();

        $subject5 = new Subject([
            'name' => "Object-oriented Programming",
            'code' => "TDB2153"
        ]);
        $subject5->save();
    }
}
