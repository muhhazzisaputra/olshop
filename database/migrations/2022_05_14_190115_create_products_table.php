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
            $table->increments('id');
            $table->string('image', 100)->nullable();
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('category_id');
            $table->integer('weight');
            $table->integer('stock');
            $table->enum('status', array('0', '1'));
            $table->integer('purchase_price');
            $table->integer('selling_price');
            $table->text('description');
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
