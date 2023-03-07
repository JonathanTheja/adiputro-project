<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BomItemComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("bom_item_component")->insert([
            [
                'bom_id'=>1,
                'consumed_item_id'=>11,
                'consumed_qty'=>100000
            ],
            [
                'bom_id'=>2,
                'consumed_item_id'=>12,
                'consumed_qty'=>96000000
            ],
        ]);
    }
}
