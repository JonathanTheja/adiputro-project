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
        Schema::create('process_entry', function (Blueprint $table) {
            $table->id('proccess_entry_id');
            $table->string('spk_type',100);
            $table->text('process_name');
            $table->integer('process_number');
            $table->float('stall_number');
            $table->text('work_description');
            $table->text('pic');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('process_entry');
    }
};
