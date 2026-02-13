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
        // Convert string periodicity values to numeric values
        DB::table('donators')->where('periodicity', 'monthly')->update(['periodicity' => 1]);
        DB::table('donators')->where('periodicity', 'quarterly')->update(['periodicity' => 3]);
        DB::table('donators')->where('periodicity', 'semiannually')->update(['periodicity' => 6]);
        DB::table('donators')->where('periodicity', 'yearly')->update(['periodicity' => 12]);
        
        // Also handle any variations in case
        DB::table('donators')->where('periodicity', 'Monthly')->update(['periodicity' => 1]);
        DB::table('donators')->where('periodicity', 'Quarterly')->update(['periodicity' => 3]);
        DB::table('donators')->where('periodicity', 'Semiannually')->update(['periodicity' => 6]);
        DB::table('donators')->where('periodicity', 'Yearly')->update(['periodicity' => 12]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert numeric values back to string values
        DB::table('donators')->where('periodicity', 1)->update(['periodicity' => 'monthly']);
        DB::table('donators')->where('periodicity', 3)->update(['periodicity' => 'quarterly']);
        DB::table('donators')->where('periodicity', 6)->update(['periodicity' => 'semiannually']);
        DB::table('donators')->where('periodicity', 12)->update(['periodicity' => 'yearly']);
    }
};
