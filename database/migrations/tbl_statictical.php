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
        Schema::create('tbl_statictical', function (Blueprint $table) {
            $table->increments('id_statictical');
            $table->string('order_date');
            $table->string('sales');
            $table->string('profit');
            $table->integer('quantity');
            $table->integer('total_order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_statictical');
    }
};
