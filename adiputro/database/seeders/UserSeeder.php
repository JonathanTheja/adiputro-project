<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("users")->insert([
            [
                // 'role_id' => 1,
                'username'=>'kean',
                'password'=>'123',
                'full_name'=>'Keanny G',
                'department_id'=>1,
                'gender'=>1,
                'role_id'=>1,
                'status'=>1
            ],
            [
                // 'role_id' => 1,
                'username'=>'bean',
                'password'=>'123',
                'full_name'=>'Bean bean',
                'department_id'=>2,
                'gender'=>0,
                'role_id'=>2,
                'status'=>1
            ],
            [
                // 'role_id' => 1,
                'username'=>'belv',
                'password'=>'123',
                'full_name'=>'Belv belv',
                'department_id'=>2,
                'gender'=>0,
                'role_id'=>5,
                'status'=>1
            ],
            [
                // 'role_id' => 1,
                'username'=>'Bella',
                'password'=>'123',
                'full_name'=>'Bella G',
                'department_id'=>1,
                'gender'=>0,
                'role_id'=>4,
                'status'=>0
            ],
            [
                // 'role_id' => 1,
                'username'=>'Bona',
                'password'=>'123',
                'full_name'=>'Bonna',
                'department_id'=>4,
                'gender'=>1,
                'role_id'=>1,
                'status'=>0
            ],
        ]);
    }
}
