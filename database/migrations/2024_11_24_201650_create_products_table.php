<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('name');
            $table->decimal('price', 8, 2); // Fiyat
            $table->text('description');
            $table->text('content'); // Ürün içeriği
            $table->string('image_path');
            $table->boolean('status')->default(1); // 1 = aktif, 0 = pasif
            $table->softDeletes();
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
