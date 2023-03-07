<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemKitItemComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("item_kit_item_component")->insert([
            [

                'item_kit_id'=>1,
                'item_component_id'=>7,
                'item_component_qty'=>4000000,
                'item_component_uofm'=>'PCS'
            ],
            [
                'item_kit_number'=>1,
                'item_component_number'=>8,
                'item_component_qty'=>4000000,
                'item_component_uofm'=>'PCS'
            ],
            [
                'item_kit_number'=>1,
                'item_component_number'=>9,
                'item_component_qty'=>2000000,
                'item_component_uofm'=>'PCS'
            ],
            [
                'item_kit_number'=>1,
                'item_component_id'=>10,
                'item_component_qty'=>2000000,
                'item_component_uofm'=>'PCS'
            ],
        ]);
    }
}
