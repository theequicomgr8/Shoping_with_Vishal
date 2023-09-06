<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('slug')->nullable();
            $table->string('brand')->nullable();
            $table->string('modal')->nullable();
            $table->string('short_desc')->nullable();
            $table->string('desc')->nullable();
            $table->string('keywords')->nullable();
            $table->string('technical_specification')->nullable();
            $table->string('users')->nullable();
            $table->string('warranty')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('products');
    }
}
