<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        Permission::create(['name' => 'manage user']);
        Permission::create(['name' => 'submit attendance']);
        Permission::create(['name' => 'view attendance']);
        Permission::create(['name' => 'update lab']);
        Permission::create(['name' => 'register lab']);
        Permission::create(['name' => 'download attendance']);

        // create roles and assign created permissions

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('manage user');

        $role = Role::create(['name' => 'registry']);
        $role->givePermissionTo(['view attendance', 'download attendance']);

        $role = Role::create(['name' => 'ga']);
        $role->givePermissionTo(['view attendance', 'update lab', 'download attendance']);

        $role = Role::create(['name' => 'student']);
        $role->givePermissionTo(['submit attendance', 'view attendance', 'register lab']);
    }
}
