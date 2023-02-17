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
        Schema::create('item_kit', function (Blueprint $table) {
            $table->id('item_kit_id');
            $table->text('item_kit_number');
            $table->text('item_kit_description');
            $table->text('component_item_number');
            $table->text('component_item_description');
            $table->text('component_item_qty');
            $table->text('component_item_uofm');
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
        Schema::dropIfExists('item_kit');
    }
};
