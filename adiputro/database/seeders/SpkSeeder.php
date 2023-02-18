<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("spk")->insert([
            [
                // 'role_id' => 1,
                'name'=>'Bus',
                'item_number'=>null,
                'item_description'=>null,
                'parent_id'=>null
            ],
            [
                // 'role_id' => 1,
                'name'=>'Minibus',
                'item_number'=>null,
                'item_description'=>null,
                'parent_id'=>null
            ],
            [
                // 'role_id' => 1,
                'name'=>'SDD',
                'item_number'=>null,
                'item_description'=>null,
                'parent_id'=>1
            ],
            [
                // 'role_id' => 1,
                'name'=>'SUB ASSEMBLY',
                'item_number'=>null,
                'item_description'=>null,
                'parent_id'=>3
            ],
            [
                // 'role_id' => 1,
                'name'=>'Elf',
                'item_number'=>null,
                'item_description'=>null,
                'parent_id'=>2
            ],
            [
                // 'role_id' => 1,
                'name'=>'Fuso',
                'item_number'=>null,
                'item_description'=>null,
                'parent_id'=>2
            ],

        ]);
    }
}
