<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('cart_id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('store_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
        });

        Schema::create('cart_details', function (Blueprint $table) {
            // $table->increments('cartdetails_id');
            $table->bigInteger('cart_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('item_quantity');
            $table->bigInteger('type');
            $table->bigInteger('type_value');
            $table->timestamps();
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('cart_id')->references('cart_id')->on('carts')->onDelete('cascade');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
