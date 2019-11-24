<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePTTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_t', function (Blueprint $table) {
            $table->integer('product_id')
                ->unsigned()
                ->index('product_id');
            $table->foreign('product_id')
                ->references('id')
                ->on('product')
                ->onDelete('cascade');
            $table->integer('type_id')
                ->unsigned()
                ->index('type_id');
            $table->foreign('type_id')
                ->references('id')
                ->on('product_type')
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
        Schema::dropIfExists('p_t');
    }
}
