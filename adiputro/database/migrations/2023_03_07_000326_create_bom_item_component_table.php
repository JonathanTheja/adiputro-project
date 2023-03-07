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
        Schema::create('bom_item_component', function (Blueprint $table) {
            $table->id('bom_item_component_id');
            $table->bigInteger('bom_id');
            $table->bigInteger('consumed_item_id');
            $table->bigInteger('consumed_qty');
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
        Schema::dropIfExists('bom_item_component');
    }
};
