<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTATable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_a', function (Blueprint $table) {
            $table->integer('type_id')
                ->unsigned()
                ->index('type_id');
            $table->foreign('type_id')
                ->references('id')
                ->on('product_type')
                ->onDelete('cascade');
            $table->integer('attribute_id')
                ->unsigned()
                ->index('attribute_id');
            $table->foreign('attribute_id')
                ->references('id')
                ->on('product_attribute')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_a');
    }
}
