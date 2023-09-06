<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductattrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productattrs', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->string('sku');
            $table->string('image');
            $table->string('mrp');
            $table->string('price');
            $table->string('qty');
            $table->integer('size_id');
            $table->integer('color_id');
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
        Schema::dropIfExists('productattrs');
    }
}
