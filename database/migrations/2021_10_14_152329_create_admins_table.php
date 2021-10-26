<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->ID();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            // $table->timestamp('email_verified_at')->nullable();
            // $table->rememberToken();
            // $table->string('remember_token', 100);
            $table->string('address');
            $table->string('apartment')->nullable();
            $table->string('city');
            $table->integer('postcode');
            $table->string('state');
            $table->string('country');
            $table->string('phone');
            $table->string('website')->nullable();
            $table->string('profile_image')->nullable();
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
        Schema::dropIfExists('admins');
    }
}
