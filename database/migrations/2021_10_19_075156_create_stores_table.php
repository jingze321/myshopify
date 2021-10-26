<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    
        
        Schema::create('stores', function (Blueprint $table) {
            $table->ID();
            $table->string('store_name');
            $table->bigInteger('admin_id')->unsigned();
            $table->string('contact_email');
            $table->string('sender_email');
            $table->string('store_industry');  
            $table->string('store_address');
            $table->string('company_name');
            $table->string('phone');
            $table->string('postcode');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('website');
            $table->string('time_zone');
            $table->string('unit_system');
            $table->string('unit_system_type');
            $table->string('currency');
            $table->foreign('admin_id')->references('ID')->on('admins')->onDelete('cascade');
    
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
        Schema::dropIfExists('stores');
    }
}
