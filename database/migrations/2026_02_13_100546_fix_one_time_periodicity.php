<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Convert any remaining 'one_time' string values or '0' (from invalid casts) to 3
        DB::table('donators')->where('periodicity', 'one_time')->update(['periodicity' => 3]);
        DB::table('donators')->where('periodicity', 0)->update(['periodicity' => 3]);
        DB::table('donators')->where('periodicity', 'One-time')->update(['periodicity' => 3]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert numeric value 3 back to 'one_time' string if needed
        DB::table('donators')->where('periodicity', 3)->update(['periodicity' => 'one_time']);
    }
};
