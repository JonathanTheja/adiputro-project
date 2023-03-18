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
        Schema::create('item_component_code_ti', function (Blueprint $table) {
            $table->id('item_component_code_ti_id');
            $table->integer('input_ti_id');
            $table->integer('item_level_id');
            $table->integer('item_component_id');
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
        Schema::dropIfExists('item_component_code_ti');
    }
};
