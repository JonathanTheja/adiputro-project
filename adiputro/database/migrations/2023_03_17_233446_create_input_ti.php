<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('input_ti', function (Blueprint $table) {
            $table->string('kode_ti')->primary();
            $table->integer('revisi')->nullable();
            $table->string('nomor_laporan');
            $table->string('nama_ti');
            // $table->string('level_proses_input_ti'); many to many
            // $table->string('kode_komponen_ti'); many to many item_component_code_ti
            $table->string('model'); // department_id
            $table->integer('pembuat_id'); //user login
            // $table->string('diperiksa_oleh_ti'); many to many checked_by_ti
            // $table->string('approved_by_ti'); many to many
            $table->integer('user_defined_id');
            $table->string('description');
            // $table->string('nama_gambar_ti');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('input_ti');
    }
};
