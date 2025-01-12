<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('location')->nullable();
            $table->string('instagram')->nullable();
            $table->string('color')->nullable();
            $table->string('animal')->nullable();
            $table->string('hobby')->nullable();
            $table->string('fruit')->nullable();
            $table->string('cuisine')->nullable();
            $table->string('drink')->nullable();
            $table->string('dessert')->nullable();
            $table->string('book')->nullable();
            $table->string('author')->nullable();
            $table->string('music')->nullable();
            $table->string('artist')->nullable();
            $table->string('film')->nullable();
            $table->string('actor')->nullable();
            $table->string('sport')->nullable();
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
        Schema::dropIfExists('users_information');
    }
};
