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
        Schema::create('tbl_category_product', function (Blueprint $table) {
            $table->increments('category_id');
            $table->text('meta_keywords');
            $table->string('category_name');
            $table->string('slug_category_product');
            $table->text('category_desc');
            $table->integer('category_parent');
            $table->integer('category_status');
            $table->integer('category_orders');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_category_product');
    }
};
