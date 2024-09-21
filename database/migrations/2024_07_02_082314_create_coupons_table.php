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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); 
            $table->unsignedBigInteger('discount_amount')->nullable();
            $table->integer('discount_percentage')->nullable();
            $table->unsignedBigInteger('max_discount_amount')->nullable(); 
            $table->unsignedBigInteger('min_order_amount')->nullable(); 
            $table->integer('usage_limit')->nullable();
            $table->integer('used_count')->default(0); 
            $table->date('expires_at')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
