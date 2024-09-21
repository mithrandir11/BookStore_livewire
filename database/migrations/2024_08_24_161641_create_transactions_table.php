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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('uu_id')->unique()->nullable();
            $table->string('trans_id')->unique()->nullable(); 
            $table->unsignedBigInteger('amount'); 
            $table->enum('status', ['pending', 'successful', 'failed'])->default('pending'); 
            $table->string('gateway')->nullable(); 
            $table->text('gateway_response')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
