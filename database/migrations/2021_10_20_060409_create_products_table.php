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
            $table->bigIncrements('product_id');
            $table->unsignedBigInteger('store_id');
            $table->string('title');
            $table->string('description');
            $table->string('media')->nullable()->change();
            $table->decimal('price');
            $table->decimal('compare_at_price')->nullable()->change();
            $table->decimal('cost_per_item')->nullable()->change();
            $table->string('sku')->nullable()->change();
            $table->string('barcode')->nullable()->change();
            $table->string('quantity')->nullable()->change();
            $table->decimal('weight')->nullable()->change();
            $table->string('origin')->nullable()->change();
            $table->string('status');
            $table->timestamps();
            $table->foreign('store_id')->references('ID')->on('stores')->onDelete('cascade');

        });

        Schema::create('gallery', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->unsigned();
            $table->string('picture');
            $table->string('documents');
            $table->timestamps();
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');

        });

        Schema::create('product_variants', function (Blueprint $table) {
            $table->bigIncrements('variant_id');
            $table->bigInteger('product_id')->unsigned();
            $table->string('type');
            $table->string('type_value');
            $table->timestamps();
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');

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
        Schema::dropIfExists('gallery');
        Schema::dropIfExists('product_variants');
    }
}
