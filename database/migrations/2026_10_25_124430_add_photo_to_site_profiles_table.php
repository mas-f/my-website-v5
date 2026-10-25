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
        Schema::table('site_profiles', function (Blueprint $table) {
            $table->string('photo_path', 2048)->nullable();
            $table->string('photo_original_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_profiles', function (Blueprint $table) {
            $table->dropColumn(['photo_original_name', 'photo_path']);
        });
    }
};
