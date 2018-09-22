<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Student;
use App\Subject;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Student 1
        $user1 = User::create([
            'name' => "Mohamad Syaqiq",
            'email' => "syaqiq_21798@utp.edu.my",
            'password' => bcrypt("UTP@2013"),
        ]);

        $user1->assignRole("student");

        $student1 = new Student([
            'name' => "Mohamad Syaqiq",
            'student_number' => "21798",
            'user_id' => $user1->id
        ]);
        $student1->save();

        $subject11 = Subject::find(1);
        $subject12 = Subject::find(2);
        $subject13 = Subject::find(3);
        $student1->subjects()->attach($subject11->id);
        $student1->subjects()->attach($subject12->id);
        $student1->subjects()->attach($subject13->id);


        // Student 2
        $user2 = User::create([
            'name' => "Choh Kah Seng",
            'email' => "seng_21703@utp.edu.my",
            'password' => bcrypt("UTP@2013"),
        ]);

        $user2->assignRole("student");

        $student2 = new Student([
            'name' => "Choh Kah Seng",
            'student_number' => "21703",
            'user_id' => $user2->id
        ]);
        $student2->save();

        $subject21 = Subject::find(3);
        $subject22 = Subject::find(4);
        $student2->subjects()->attach($subject21->id);
        $student2->subjects()->attach($subject22->id);


        // Student 3
        $user3 = User::create([
            'name' => "Darren Lim",
            'email' => "darren_21812@utp.edu.my",
            'password' => bcrypt("UTP@2013"),
        ]);

        $user3->assignRole("student");

        $student3 = new Student([
            'name' => "Darren Lim",
            'student_number' => "21812",
            'user_id' => $user3->id
        ]);
        $student3->save();

        $subject31 = Subject::find(5);
        $student3->subjects()->attach($subject31->id);
    }
}
