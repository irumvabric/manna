<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Insert sensible defaults
        DB::table('settings')->insert([
            ['key' => 'email_notifications', 'value' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'late_payment_alerts', 'value' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'reminder_days', 'value' => '7', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'auto_approval', 'value' => '0', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'admin_email', 'value' => 'admin@donation.com', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
