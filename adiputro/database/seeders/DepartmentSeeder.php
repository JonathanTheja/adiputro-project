<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("department")->insert([
            [
                'name'=>'Body Welding'
            ],
            [
                'name'=>'Trimming Bus'
            ],
            [
                'name'=>'Sub Assy Minibus'
            ],
            [
                'name'=>'Rangka Bus'
            ],
            [
                'name'=>'Paneling'
            ],
            [
                'name'=>'Putty Bus'
            ]
        ]);
    }
}
