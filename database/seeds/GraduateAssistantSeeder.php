<?php

use Illuminate\Database\Seeder;
use App\User;
use App\GraduateAssistant;
use App\Subject;

class GraduateAssistantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // GA 1
        $user1 = User::create([
            'name' => "Mohamad Ali",
            'email' => "ali_12345@utp.edu.my",
            'password' => bcrypt("UTP@2013"),
        ]);

        $user1->assignRole("ga");

        $ga1 = new GraduateAssistant([
            'name' => "Mohamad Ali",
            'user_id' => $user1->id
        ]);

        $ga1->save();
        $subject11 = Subject::find(1);
        $subject12 = Subject::find(2);
        $subject13 = Subject::find(3);
        $ga1->subjects()->attach($subject11->id);
        $ga1->subjects()->attach($subject12->id);
        $ga1->subjects()->attach($subject13->id);

        // GA 2
        $user2 = User::create([
            'name' => "Liew Kheng Hong",
            'email' => "liew_10999@utp.edu.my",
            'password' => bcrypt("UTP@2013"),
        ]);

        $user2->assignRole("ga");

        $ga2 = new GraduateAssistant([
            'name' => "Liew Kheng Hong",
            'user_id' => $user2->id
        ]);

        $ga2->save();
        $subject21 = Subject::find(3);
        $subject22 = Subject::find(4);
        $subject23 = Subject::find(5);
        $ga2->subjects()->attach($subject21->id);
        $ga2->subjects()->attach($subject22->id);
        $ga2->subjects()->attach($subject23->id);

    }
}
