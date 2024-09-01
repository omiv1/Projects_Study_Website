<?php
// Migracja dla tabeli deals
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->integer('points')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->string('manufacturer');
            $table->string('deal_link');
            $table->string('image_link');
            $table->string('model');
            $table->string('name');
            $table->string('product_code');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->decimal('price', 8, 2);
            $table->timestamp('added_at');
            $table->boolean('shadow')->default(false);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deals');
    }
};
