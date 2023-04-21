<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        $kode = ["AP/TI/", "AP/GT/"];
        for ($i=0; $i < 4; $i++) {
            $acak = rand(0,1);
            DB::table("form_report")->insert([
                [
                    'item_level_id'=>$i+1,
                    'nomor_laporan'=>'LAP/000'.($i+1).'/BW/AP/III/2023',
                    'kode'=>$kode[$acak].str_pad(strval($i+1),3,'0',STR_PAD_LEFT),
                    'tanggal'=>now(),
                    'pelapor_id'=>$i+1,
                    'kategori_report_id'=> 1,
                    'temuan'=>"temuan".($i+1),
                    'jenis'=>$jenis[$acak],
                    'reply'=>"Proses Done".($i+1),
                    'tanggal_diselesaikan'=> now(),
                    'penyelesai_id'=> $i+2,
                ],
            ]);
        }
    }
}
