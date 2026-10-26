<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('category_id')
                ->nullable()
                ->after('solution')
                ->index()
                ->constrained('categories')
                ->restrictOnDelete();
        });

        $names = DB::table('projects')
            ->select('category')
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        $sortOrder = 1;

        foreach ($names as $name) {
            $categoryId = DB::table('categories')->insertGetId([
                'name' => $name,
                'slug' => $this->uniqueSlug((string) $name),
                'sort_order' => $sortOrder++,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('projects')
                ->where('category', $name)
                ->update(['category_id' => $categoryId]);
        }

        if (DB::table('projects')->whereNull('category_id')->exists()) {
            $fallback = DB::table('categories')->where('name', 'Tanpa kategori')->first();

            $fallbackId = $fallback?->id ?? DB::table('categories')->insertGetId([
                'name' => 'Tanpa kategori',
                'slug' => $this->uniqueSlug('Tanpa kategori'),
                'sort_order' => 9999,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('projects')
                ->whereNull('category_id')
                ->update(['category_id' => $fallbackId]);
        }

        Schema::table('projects', function (Blueprint $table) {
            $table->dropIndex(['category']);
            $table->dropColumn('category');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('category', 100)->nullable()->after('solution')->index();
        });

        DB::table('projects')
            ->join('categories', 'projects.category_id', '=', 'categories.id')
            ->update(['projects.category' => DB::raw('categories.name')]);

        Schema::table('projects', function (Blueprint $table) {
            $table->dropConstrainedForeignId('category_id');
        });

        Schema::dropIfExists('categories');
    }

    private function uniqueSlug(string $name): string
    {
        $base = Str::slug($name) ?: 'kategori';
        $slug = $base;
        $suffix = 2;

        while (DB::table('categories')->where('slug', $slug)->exists()) {
            $slug = $base.'-'.$suffix;
            $suffix++;
        }

        return $slug;
    }
};
