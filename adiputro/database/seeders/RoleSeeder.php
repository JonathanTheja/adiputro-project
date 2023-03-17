<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("roles")->insert([
            [
                // 'role_id' => 1,
                'name'=>'Super Admin'
            ],
            [
                // 'role_id' => 2,
                'name'=>'Manager'
            ],
            [
                // 'role_id' => 3,
                'name'=>'Manager Engineering'
            ],
            [
                // 'role_id' => 4,
                'name'=>'Engineering'
            ],
            [
                // 'role_id' => 5,
                'name'=>'Admin'
            ],
            [
                // 'role_id' => 6,
                'name'=>'Staff'
            ]
        ]);
    }
}
