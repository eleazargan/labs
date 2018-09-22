<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(SubjectsSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(GraduateAssistantSeeder::class);
        $this->call(RegistrySeeder::class);
    }
}
