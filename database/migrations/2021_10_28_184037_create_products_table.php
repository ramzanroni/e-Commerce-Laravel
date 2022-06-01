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
            $table->string('category_id');
            $table->string('brand_id');
            $table->string('product_name');
            $table->string('product_slag');
            $table->string('product_code');
            $table->string('product_quantity');
            $table->text('sort_description');
            $table->text('long_description');
            $table->integer('price');
            $table->string('product_img_1');
            $table->string('product_img_2');
            $table->string('product_img_3');
            $table->integer('status')->default(1);
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
