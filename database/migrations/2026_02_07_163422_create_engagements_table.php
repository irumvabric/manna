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
        Schema::create('engagements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donator_id')->nullable()->constrained('donators')->nullOnDelete();
            $table->double('amount');
            $table->enum('currency', ['BIF', 'USD', 'EUR'])->default('BIF');
            $table->enum('periodicity', ['one_time', 'semester', 'monthly', 'yearly']);
            $table->enum('status', ['active', 'paused', 'completed'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('engagements');
    }
};
