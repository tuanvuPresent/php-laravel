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
            $table->id('id')->autoIncrement();
            $table->string('name');
            $table->string('price');
            $table->string('quantity');
            $table->string('image');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unsignedTinyInteger('type_products_id');
            $table->foreign('type_products_id')->references('type_products_id')->on('type_products');
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
