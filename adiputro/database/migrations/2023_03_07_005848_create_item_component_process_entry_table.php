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
        //NOT PROCESS_ENTRY_ID BUT ITEM_LEVEL_PROCESS_ENTRY_ID
        Schema::create('item_component_process_entry', function (Blueprint $table) {
            $table->id('item_component_process_entry_id');
            $table->bigInteger('item_component_id');
            $table->bigInteger('item_level_process_entry_id');
            $table->bigInteger('department_id')->nullable();
            $table->integer('item_component_qty');
            $table->softDeletes();
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
        Schema::dropIfExists('item_component_process_entry');
    }
};
