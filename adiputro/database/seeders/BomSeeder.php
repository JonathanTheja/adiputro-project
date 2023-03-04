<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("bom")->insert([
            [
                'bom_number'=>'112-1-02-6M',
                'bom_description'=>'POT PIPA 20 X 40 (6M) BCM RK8 HDD PER',
                'site_id_input'=>'TRUMPF',
                'site_id_output'=>'TRUMPF',
                'consumed_item'=>'B09PE02040216000',
                'consumed_item_description'=>'PIPA KOTAK EPOXY 20 X 40 X 2,1 X 6000',
                'consumed_uofm'=>'LONJOR',
                'consumed_qty'=>100000
            ],
            [
                'bom_number'=>'112-1-02-6M WASTE',
                'bom_description'=>'POT PIPA WASTE 20 X 40 (6M) BCM RK8 HDD',
                'site_id_input'=>'TRUMPF',
                'site_id_output'=>'TRUMPF',
                'consumed_item'=>'B09PE02040216000W',
                'consumed_item_description'=>'WASTE PIPA KOTAK 20 X 40(METER)',
                'consumed_uofm'=>'MTR',
                'consumed_qty'=>96000000
            ],
        ]);
    }
}
