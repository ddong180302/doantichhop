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
        Schema::create('tbl_xaphuongthitran', function (Blueprint $table) {
            $table->string('xaid');
            $table->string('name_xaphuong');
            $table->string('type');
            $table->integer('maqh');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_xaphuongthitran');
    }
};
