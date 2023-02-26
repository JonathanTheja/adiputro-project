<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("item_component")->insert([
            [
                'item_number'=>"000-2F0-001",
                'item_description'=>"001 RANGKA PINTU TOILET KIRI STD F0"
            ],
            [
                'item_number'=>"000-2F0-002",
                'item_description'=>"002 RANGKA PINTU TOILET KIRI STD F0"
            ],
            [
                'item_number'=>"000-2F0-003",
                'item_description'=>"003 RANGKA PINTU TOILET KIRI STD F0"
            ],
            [
                'item_number'=>"000-2F0-004",
                'item_description'=>"004 RANGKA PINTU TOILET KIRI STD F0"
            ],
            [
                'item_number'=>"000-2F0-005",
                'item_description'=>"005 RANGKA PINTU TOILET KIRI STD F0"
            ],
            [
                'item_number'=>"000-2F0-006",
                'item_description'=>"006 RANGKA PINTU TOILET KIRI STD F0"
            ],
        ]);
    }
}
