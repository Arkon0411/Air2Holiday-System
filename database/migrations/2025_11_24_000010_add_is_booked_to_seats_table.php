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
        if (Schema::hasTable('seats') && ! Schema::hasColumn('seats', 'is_booked')) {
            Schema::table('seats', function (Blueprint $table) {
                $table->boolean('is_booked')->default(false)->after('is_active');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('seats') && Schema::hasColumn('seats', 'is_booked')) {
            Schema::table('seats', function (Blueprint $table) {
                $table->dropColumn('is_booked');
            });
        }
    }
};
