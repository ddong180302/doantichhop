<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('user_name');
            $table->string('user_email');
            $table->string('user_password');
            $table->integer('xaid');
            $table->integer('maqh');
            $table->integer('matp');
            $table->string('user_phone')->nullable();
            $table->string('user_avatar')->nullable();
            $table->integer('user_status')->nullable();
            $table->string('user_role');
            $table->string('user_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_users');
    }
};
