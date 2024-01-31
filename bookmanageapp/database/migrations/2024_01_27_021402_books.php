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
        Schema::create('books', function (Blueprint $table) {
            $table->id()->comment('書籍ID');
            $table->string('isbn')->comment('ISBN:国際標準図書番号');
            $table->string('name')->comment('書籍名');
            $table->date('published_at')->comment('出版日');
            $table->unsignedBigInteger('publisher_id')->comment('出版社ID');
            $table->unsignedBigInteger('author_id')->comment('著者ID');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
