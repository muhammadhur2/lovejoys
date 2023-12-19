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
        // In the created migration file

Schema::table('users', function (Blueprint $table) {
    $table->string('otp', 6)->nullable();
    $table->dateTime('otp_expires_at')->nullable();
});

    }

   
};
