<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('evaluation_requests', function (Blueprint $table) {
            $table->mediumText('image')->nullable()->change(); // Change image column to mediumText
        });
    }

    public function down()
    {
        Schema::table('evaluation_requests', function (Blueprint $table) {
            $table->string('image')->nullable()->change(); // Revert back to string if migration is rolled back
        });
    }
};
