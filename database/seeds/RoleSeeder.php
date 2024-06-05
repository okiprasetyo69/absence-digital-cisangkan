<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'superadmin',
            'role_name' => 'Super Admin',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'spv_man_admin',
            'role_name' => 'Supervisor',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'admin',
            'role_name' => 'Admin',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'employee',
            'role_name' => 'Employee',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'head',
            'role_name' => 'Head',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'security',
            'role_name' => 'Security',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'user',
            'role_name' => 'User',
            'guard_name' => 'web'
        ]);
    }
}
