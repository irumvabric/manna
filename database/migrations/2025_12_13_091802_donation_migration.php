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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donator_id');
            $table->double('amount');
            $table->enum('currency', ['BIF', 'USD', 'EUR'])->default('BIF');
            $table->enum('payment_method', ['cash', 'card', 'mobile'])->default('cash');
            $table->enum('status', ['pending', 'approved', 'rejected','late'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
