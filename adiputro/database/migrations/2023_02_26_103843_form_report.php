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
        Schema::create('form_report', function (Blueprint $table) {
            $table->id('form_report_id');
            $table->string('nomor_laporan');
            $table->date('tanggal');
            $table->integer('user_id');
            $table->string('kategori');
            $table->string('temuan');
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
        Schema::dropIfExists('form_report');
    }
};
