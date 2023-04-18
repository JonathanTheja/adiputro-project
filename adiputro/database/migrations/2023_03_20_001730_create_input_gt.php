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
        Schema::create('input_gt', function (Blueprint $table) {
            $table->id("input_gt_id");
            $table->string('kode_ti')->nullable();
            $table->integer('process_entry_id');
            $table->string('kode_gt');
            $table->integer('revisi')->nullable();
            $table->string('nomor_laporan');
            $table->string('nama_gt');
            $table->integer('item_component_id');
            $table->integer('user_defined_id');
            //diperiksa oleh / checkedbygt sendiri many to many
            //approvedbygt table sendiri many to many
            // $table->string('description');
            $table->integer('status');
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
        Schema::dropIfExists('input_gt');
    }
};
