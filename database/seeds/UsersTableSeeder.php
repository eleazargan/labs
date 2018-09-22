<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => "Super Admin",
            'email' => "superadmin@utp.edu.my",
            'password' => bcrypt("superadmin123"),
        ]);

        $user->assignRole("admin");
    }
}
