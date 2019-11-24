<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributeValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attribute_value', function (Blueprint $table) {
            $table->increments('id')->index('product_attribute_id');
            $table->integer('product_id')
                ->unsigned()
                ->index('product_id');
            $table->foreign('product_id')
                ->references('id')
                ->on('product')
                ->onDelete('cascade');
            $table->integer('attribute_id')
                ->unsigned()
                ->index('attribute_id');
            $table->foreign('attribute_id')
                ->references('id')
                ->on('product_attribute')
                ->onDelete('cascade');
            $table->string('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attribute_value');
    }
}
