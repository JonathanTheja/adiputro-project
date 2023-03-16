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
        $jenis = ["TI", "Gambar Teknik", "Process Entry"];
        for ($i=0; $i < 4; $i++) {
            DB::table("form_report")->insert([
                [
                    'item_level_id'=>$i+1,
                    'nomor_laporan'=>'LAP/000'.($i+1).'/BW/AP/III/2023',
                    'tanggal'=>now(),
                    'pelapor_id'=>$i+1,
                    'kategori_report_id'=> 1,
                    'temuan'=>"temuan".($i+1),
                    'jenis'=>$jenis[rand(0,1)],
                    'reply'=>"Proses Done".($i+1),
                    'tanggal_diselesaikan'=> now(),
                    'penyelesai_id'=> $i+2,
                ],
            ]);
        }
    }
}
