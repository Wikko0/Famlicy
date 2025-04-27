<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('title');
            $table->string('username')->unique();
            $table->string('phone')->nullable();
            $table->string('photo')->nullable();
            $table->string('birthday');
            $table->string('died')->nullable();
            $table->string('relation')->nullable();
            $table->json('alias')->nullable();
            $table->json('admin_id')->nullable();
            $table->json('transitioned_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
