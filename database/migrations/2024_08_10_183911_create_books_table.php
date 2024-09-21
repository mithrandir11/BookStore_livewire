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
            $table->id();
            $table->string('title', 70)->index();
            $table->string('slug', 70)->unique();
            $table->unsignedBigInteger('price');
            $table->unsignedInteger('quantity'); 
            $table->string('image', 100)->nullable(); 
            $table->text('description')->nullable(); 
            $table->foreignId('author_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('publisher_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('translator_id')->nullable()->constrained()->onDelete('set null'); 
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade'); 
            $table->integer('pages')->unsigned(); 
            $table->year('published_year'); 
            $table->string('isbn', 20); 
            $table->timestamps();
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
