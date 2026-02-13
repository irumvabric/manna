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
        // 1. Change to string first to allow numeric updates
        Schema::table('donators', function (Blueprint $table) {
            $table->string('periodicity')->change();
        });

        // 2. Convert string values to numeric
        DB::table('donators')->where('periodicity', 'monthly')->update(['periodicity' => 1]);
        DB::table('donators')->where('periodicity', 'one_time')->update(['periodicity' => 3]);
        DB::table('donators')->where('periodicity', 'One-time')->update(['periodicity' => 3]);
        DB::table('donators')->where('periodicity', 'semester')->update(['periodicity' => 6]);
        DB::table('donators')->where('periodicity', 'semiannually')->update(['periodicity' => 6]);
        DB::table('donators')->where('periodicity', 'yearly')->update(['periodicity' => 12]);
        
        // Handle any 0s or invalid strings from previous attempts
        DB::table('donators')->where('periodicity', '0')->update(['periodicity' => 3]);
        DB::table('donators')->where(DB::raw('CAST(periodicity AS UNSIGNED)'), 0)
            ->whereNotIn('periodicity', ['monthly', 'one_time', 'semester', 'yearly', 'semiannually'])
            ->update(['periodicity' => 3]);

        // 3. Finalize as integer
        Schema::table('donators', function (Blueprint $table) {
            $table->integer('periodicity')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donators', function (Blueprint $table) {
            $table->string('periodicity')->change();
        });

        DB::table('donators')->where('periodicity', 1)->update(['periodicity' => 'monthly']);
        DB::table('donators')->where('periodicity', 3)->update(['periodicity' => 'one_time']);
        DB::table('donators')->where('periodicity', 6)->update(['periodicity' => 'semester']);
        DB::table('donators')->where('periodicity', 12)->update(['periodicity' => 'yearly']);
    }
};
