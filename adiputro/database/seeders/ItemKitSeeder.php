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
                'component_item_number'=>'112-3D0-001',
                'component_item_description'=>'001 HINO RK8 PER HDD GITT D0',
                'component_item_qty'=>4000000,
                'component_item_uofm'=>'PCS'
            ],
            [
                'item_kit_number'=>"112-3",
                'item_kit_description'=>'GITTERSTEGRK8 HDD',
                'component_item_number'=>'112-3D0-005',
                'component_item_description'=>'005 HINO RK8 PER HDD GITT D0',
                'component_item_qty'=>4000000,
                'component_item_uofm'=>'PCS'
            ],
            [
                'item_kit_number'=>"112-3",
                'item_kit_description'=>'GITTERSTEGRK8 HDD',
                'component_item_number'=>'112-3D0-004',
                'component_item_description'=>'004 HINO RK8 PER HDD GITT D0',
                'component_item_qty'=>2000000,
                'component_item_uofm'=>'PCS'
            ],
            [
                'item_kit_number'=>"112-3",
                'item_kit_description'=>'GITTERSTEGRK8 HDD',
                'component_item_number'=>'112-3D0-003',
                'component_item_description'=>'003 HINO RK8 PER HDD GITT D0',
                'component_item_qty'=>2000000,
                'component_item_uofm'=>'PCS'
            ],
        ]);
    }
}
