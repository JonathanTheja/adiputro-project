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
        Schema::create('bom', function (Blueprint $table) {
            $table->id('bom_id');
            $table->string('bom_number',100);
            $table->text('bom_description');
            $table->text('site_id_input');
            $table->text('site_id_output');
            $table->text('consumed_item');
            $table->text('consumed_item_description');
            $table->text('consumed_uofm');
            $table->bigInteger('consumed_qty');
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
        Schema::dropIfExists('bom');
    }
};
