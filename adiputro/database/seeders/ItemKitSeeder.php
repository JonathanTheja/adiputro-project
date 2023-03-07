<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemKitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("item_kit")->insert([
            [
                'item_kit_number'=>"112-3",
                'item_kit_description'=>'GITTERSTEGRK8 HDD',
            ],
        ]);
    }
}
