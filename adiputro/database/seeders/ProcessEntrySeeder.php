<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProcessEntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("process_entry")->insert([
            [
               'spk_type'=>'SPK BUS',
               'process_name'=>'Bongkar',
               'process_number'=>2,
               'stall_number'=>1.0,
               'work_description'=>'Persiapan pembongkaran Unit sesuai dengan jadwal',
               'pic'=>'Fauzi',
               'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
               'status'=>'otomatis'
            ],
            [
                'spk_type'=>'SPK BUS',
                'process_name'=>'Bongkar',
                'process_number'=>2,
                'stall_number'=>2.0,
                'work_description'=>'Pemberian No Produksi pada bagian-bagian Unit yang lepas',
                'pic'=>'Fauzi',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'status'=>'otomatis'
             ],
             [
                'spk_type'=>'SPK BUS',
                'process_name'=>'Bongkar',
                'process_number'=>2,
                'stall_number'=>3.1,
                'work_description'=>'Pembongkaran bagian depan',
                'pic'=>'Fauzi',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'status'=>'otomatis'
             ],
        ]);
    }
}
