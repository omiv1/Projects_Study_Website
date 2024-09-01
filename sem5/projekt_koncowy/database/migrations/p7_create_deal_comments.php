<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('deal_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('deal_id');
            $table->text('content');
            $table->boolean('reported')->default(false);
            $table->boolean('edited')->default(false);
            $table->boolean('shadow')->default(false);
            $table->timestamp('added_at');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('deal_id')->references('id')->on('deals')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('deal_comments');
    }
};
