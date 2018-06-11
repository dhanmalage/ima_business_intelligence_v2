<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Dhananjaya',
            'email' => 'dhananjaya@osmium.lk',
            'password' => bcrypt('secret'),
        ]);

        DB::table('permissions')->insert([
            [
                'name' => 'all',
                'guard_name' => 'web'
            ],
            [
                'name' => 'admin',
                'guard_name' => 'web'
            ],
            [
                'name' => 'accountant',
                'guard_name' => 'web'
            ],
            [
                'name' => 'marketing',
                'guard_name' => 'web'
            ]
        ]);

        DB::table('roles')->insert([
            [
                'name' => 'super_admin',
                'guard_name' => 'web'
            ],
            [
                'name' => 'administrator',
                'guard_name' => 'web'
            ],
            [
                'name' => 'accountant',
                'guard_name' => 'web'
            ],
            [
                'name' => 'marketing',
                'guard_name' => 'web'
            ],
        ]);

        DB::table('role_has_permissions')->insert([
            [
                'permission_id' => '1',
                'role_id' => '1'
            ],
            [
                'permission_id' => '2',
                'role_id' => '2'
            ],
            [
                'permission_id' => '3',
                'role_id' => '3'
            ],
            [
                'permission_id' => '4',
                'role_id' => '4'
            ],
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => '1',
            'model_type' => 'App\User',
            'model_id' => '1',
        ]);

    }
}
