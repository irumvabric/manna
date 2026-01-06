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
        Schema::create('blogs', function (Blueprint $col) {
            $col->id();
            $col->string('title');
            $col->string('slug')->unique();
            $col->longText('description');
            $col->string('image')->nullable();
            $col->boolean('status')->default(false); // false = Draft, true = Published
            $col->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
