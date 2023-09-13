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
        Schema::create('tbl_infomations', function (Blueprint $table) {
            $table->increments('info_id');
            $table->text('info_contact');
            $table->text('info_map');
            $table->string('info_logo');
            $table->string('slogan_logo');
            $table->text('info_fanpage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_infomations');
    }
};
