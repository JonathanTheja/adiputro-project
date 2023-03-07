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
            $table->integer('item_level_id');
            $table->string('nomor_laporan');
            $table->dateTime('tanggal');
            $table->integer('pelapor_id');
            $table->integer('kategori_report_id');
            $table->string('temuan');
            $table->string('reply')->nullable();
            $table->dateTime('tanggal_diselesaikan')->nullable();
            $table->integer('penyelesai_id')->nullable();
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
