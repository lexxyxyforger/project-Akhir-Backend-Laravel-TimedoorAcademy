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
        Schema::table('products', function (Blueprint $table) {
            $table->string('image_url')->nullable()->after('image');
        });

        // Populate image_url from existing image column if any
        $appUrl = env('APP_URL', 'http://localhost');
        DB::statement("UPDATE products SET image_url = CONCAT('" . $appUrl . "/storage/', image) WHERE image IS NOT NULL AND image != ''");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('image_url');
        });
    }
};
