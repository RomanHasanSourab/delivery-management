<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'),
            'role_id' => '1'
        ]);

        DB::table('roles')->truncate();
        $roles = [
            [
                'title' => 'super_admin',
            ],
            [
                'title' => 'branch',
            ],
            [
                'title' => 'merchant',
            ],
            [
                'title' => 'customer',
            ],
            [
                'title' => 'delivery_boy',
            ]
            ];

        DB::table('roles')->insert($roles);
    }
}
