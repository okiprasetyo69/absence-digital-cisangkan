<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = User::create([
            'name' => 'Super Admin Role',
            'email' => 'superadmin@role.test',
            'password' => bcrypt('12345678'),
            'role_id' => 1
        ]);
        $superAdmin->assignRole('superadmin');

        $spvManAdmin = User::create([
            'name' => 'SPV-Man Role',
            'email' => 'spv-man@role.test',
            'password' => bcrypt('12345678'),
            'role_id' => 2
        ]);
        $spvManAdmin->assignRole('spv_man_admin');

        $admin = User::create([
            'name' => 'Admin Role',
            'email' => 'admin@role.test',
            'password' => bcrypt('12345678'),
            'role_id' => 3
        ]);
        $admin->assignRole('admin');

        $employee = User::create([
            'name' => 'Employee Role',
            'email' => 'employee@role.test',
            'password' => bcrypt('12345678'),
            'role_id' => 4
        ]);
        $employee->assignRole('employee');

        $head = User::create([
            'name' => 'Head Role',
            'email' => 'head@role.test',
            'password' => bcrypt('12345678'),
            'role_id' => 5
        ]);
        $head->assignRole('head');

        $security = User::create([
            'name' => 'Security Role',
            'email' => 'security@role.test',
            'password' => bcrypt('12345678'),
            'role_id' => 6
        ]);
        $security->assignRole('security');

        $user = User::create([
            'name' => 'User Role',
            'email' => 'user@role.test',
            'password' => bcrypt('12345678'),
            'role_id' => 7
        ]);
        $user->assignRole('user');
    }
}
