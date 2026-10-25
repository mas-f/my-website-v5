<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('summary');
            $table->longText('description');
            $table->longText('problem_statement')->nullable();
            $table->longText('solution')->nullable();
            $table->string('category')->index();
            $table->json('features')->nullable();
            $table->json('technologies')->nullable();
            $table->string('thumbnail_path', 2048)->nullable();
            $table->string('live_url', 2048)->nullable();
            $table->string('repository_url', 2048)->nullable();
            $table->string('status')->default('draft')->index();
            $table->boolean('is_featured')->default(false)->index();
            $table->boolean('is_placeholder')->default(false)->index();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
