<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 5; $i++) {
            DB::table("form_report")->insert([
                [
                    'nomor_laporan'=>'LAP/000'.($i+1).'/BW/AP/III/2023',
                    'tanggal'=>now(),
                    'user_id'=>$i+1,
                    'kategori'=>"lorem",
                    'temuan'=>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque, excepturi magni? Distinctio nesciunt quia, iure corporis id dolores voluptate, aspernatur cum optio quibusdam quaerat sequi adipisci perspiciatis impedit ratione dolorem.",
                ],
            ]);
        }
    }
}
