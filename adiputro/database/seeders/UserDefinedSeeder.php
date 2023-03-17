<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserDefinedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("user_defined")->insert([
            [
                "name" => "AC",
                "desc" => "DENSO LD8I (AP)",
            ],
            [
                "name" => "AC",
                "desc" => "DENSO LD9 (AP)",
            ],
            [
                "name" => "AC",
                "desc" => "DENSO LD9 (BS)",
            ],
            [
                "name" => "AC",
                "desc" => "THERMOKING TK-500 (BS)",
            ],
            [
                "name" => "AIR SUSPENSION",
                "desc" => "STD AP",
            ],
            [
                "name" => "BAGASI",
                "desc" => "BARANG MHD FULL BORDES ALUMINIUM (AP)",
            ],
            [
                "name" => "BANGKU",
                "desc" => "RIMBA KENCANA (BS) - 36 SEATS-SOFA POSISI DI DALAM SEKAT BELAKANG",
            ],
            [
                "name" => "BANGKU",
                "desc" => "ALLDILA (AP) - 29 SEATS",
            ],
        ],);
    }
}
