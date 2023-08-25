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
        Schema::create('item_level', function (Blueprint $table) {
            $table->id('item_level_id');
            $table->string('name',100);
            $table->string('item_number',100)->nullable();
            $table->text('item_description',100)->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('level')->nullable();
            $table->integer('input_ti_id')->nullable();
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
        Schema::dropIfExists('item_level');
    }
};
