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
        Schema::create('tbl_specifications', function (Blueprint $table) {
            $table->increments('specifications_id');
            $table->integer('product_id'); //id sản phẩm -> khóa ngoại
            $table->string('cpu')->nullable(); //bộ vi xử lý
            $table->string('ram')->nullable(); //bộ nhớ trong
            $table->string('storage')->nullable(); //ổ cứng
            $table->string('graphics_card')->nullable(); //card đồ họa
            $table->string('screen')->nullable(); // màn hìnhh
            $table->string('operating_system')->nullable(); //hệ điều hành
            $table->string('weight')->nullable(); //trọng lượng
            $table->string('battery')->nullable(); //pin
            $table->string('connectivity_ports')->nullable(); //cổng kết nối
            $table->string('color')->nullable(); //màu sắc
            $table->string('keyboard')->nullable(); //bàn phím
            $table->string('webcam')->nullable(); //webcam
            $table->string('audio')->nullable(); //âm thanh
            $table->string('size')->nullable(); //kích thước
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_specifications');
    }
};
