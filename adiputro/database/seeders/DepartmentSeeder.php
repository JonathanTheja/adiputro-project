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
                'name'=>'Body Welding',
                'access_database' => 'SPK Mini Bus',
            ],
            [
                'name'=>'Trimming Bus',
                'access_database' => 'SPK Bus',
            ],
            [
                'name'=>'Sub Assy Minibus',
                'access_database' => 'SPK Mini Bus',
            ],
            [
                'name'=>'Rangka Bus',
                'access_database' => 'SPK Bus',
            ],
            [
                'name'=>'Paneling',
                'access_database' => 'SPK Mini Bus',
            ],
            [
                'name'=>'Putty Bus',
                'access_database' => 'SPK Bus',
            ]
        ]);
    }
}
