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
        Schema::create('tbl_posts', function (Blueprint $table) {
            $table->increments('post_id');
            $table->text('post_title');
            $table->string('post_views');
            $table->string('post_slug');
            $table->text('post_desc');
            $table->text('post_content');
            $table->text('post_meta_desc');
            $table->string('post_meta_keywords');
            $table->integer('post_status');
            $table->string('post_image');
            $table->integer('cate_post_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_posts');
    }
};
