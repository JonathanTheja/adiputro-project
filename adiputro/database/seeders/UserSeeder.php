<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $password = Hash::make('123');
        DB::table("users")->insert([
            [
                'username'=>'kean',
                'password'=>$password,
                'full_name'=>'Keanny G',
                'department_id'=>1,
                'gender'=>1,
                'role_id'=>1,
                'status'=>1
            ],
            [
                'username'=>'bean',
                'password'=>$password,
                'full_name'=>'Bean bean',
                'department_id'=>2,
                'gender'=>0,
                'role_id'=>2,
                'status'=>1
            ],
            [
                'username'=>'belv',
                'password'=>$password,
                'full_name'=>'Belv belv',
                'department_id'=>2,
                'gender'=>0,
                'role_id'=>5,
                'status'=>1
            ],
            [
                'username'=>'Bella',
                'password'=>$password,
                'full_name'=>'Bella G',
                'department_id'=>1,
                'gender'=>0,
                'role_id'=>4,
                'status'=>0
            ],
            [
                'username'=>'Bona',
                'password'=>$password,
                'full_name'=>'Bonna',
                'department_id'=>4,
                'gender'=>1,
                'role_id'=>1,
                'status'=>0
            ],
            [
                'username'=>'john_doe',
                'password'=>$password,
                'full_name'=>'John Doe',
                'department_id'=>3,
                'gender'=>1,
                'role_id'=>3,
                'status'=>1
            ],
            [
                'username'=>'jane_doe',
                'password'=>$password,
                'full_name'=>'Jane Doe',
                'department_id'=>4,
                'gender'=>0,
                'role_id'=>2,
                'status'=>1
            ],
            [
                'username'=>'bob_smith',
                'password'=>$password,
                'full_name'=>'Bob Smith',
                'department_id'=>1,
                'gender'=>1,
                'role_id'=>5,
                'status'=>1
            ],
            [
                'username'=>'alice_smith',
                'password'=>$password,
                'full_name'=>'Alice Smith',
                'department_id'=>2,
                'gender'=>0,
                'role_id'=>4,
                'status'=>0
            ],
            [
                'username'=>'david_lee',
                'password'=>$password,
                'full_name'=>'David Lee',
                'department_id'=>3,
                'gender'=>1,
                'role_id'=>1,
                'status'=>0
            ],
            [
                'username'=>'emily_wong',
                'password'=>$password,
                'full_name'=>'Emily Wong',
                'department_id'=>4,
                'gender'=>0,
                'role_id'=>3,
                'status'=>1
            ],
            [
                'username'=>'william_chen',
                'password'=>$password,
                'full_name'=>'William Chen',
                'department_id'=>2,
                'gender'=>1,
                'role_id'=>2,
                'status'=>1
            ],
            [
                'username'=>'lisa_li',
                'password'=>$password,
                'full_name'=>'Lisa Li',
                'department_id'=>1,
                'gender'=>0,
                'role_id'=>5,
                'status'=>1
            ],
            [
                'username'=>'daniel_kim',
                'password'=>$password,
                'full_name'=>'Daniel Kim',
                'department_id'=>3,
                'gender'=>1,
                'role_id'=>4,
                'status'=>0
            ],
            [
                'username'=>'olivia_lee',
                'password'=>$password,
                'full_name'=>'Olivia Lee',
                'department_id'=>2,
                'gender'=>0,
                'role_id'=>1,
                'status'=>0
            ],
            [
                'username'=>'ryan_choi',
                'password'=>$password,
                'full_name'=>'Ryan Choi',
                'department_id'=>1,
                'gender'=>1,
                'role_id'=>3,
                'status'=>1
            ],
            [
                'username'=>'sophie_kim',
                'password'=>$password,
                'full_name'=>'Sophie Kim',
                'department_id'=>4,
                'gender'=>0,
                'role_id'=>2,
                'status'=>1
            ],
            [
                'username'=>'ethan_han',
                'password'=>$password,
                'full_name'=>'Ethan Han',
                'department_id'=>2,
                'gender'=>1,
                'role_id'=>5,
                'status'=>1
            ],
        ]);
    }
}
