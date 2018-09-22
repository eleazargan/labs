<?php

use Illuminate\Database\Seeder;
use App\User;

class RegistrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Registry
        $user1 = User::create([
            'name' => "Registry",
            'email' => "registry1@utp.edu.my",
            'password' => bcrypt("UTP@2013"),
        ]);

        $user1->assignRole("registry");
    }
}
