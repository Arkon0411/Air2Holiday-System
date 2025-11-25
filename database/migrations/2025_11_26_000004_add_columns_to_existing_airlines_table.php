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
        Schema::table('airlines', function (Blueprint $table) {
            if (!Schema::hasColumn('airlines', 'logo')) {
                $table->string('logo')->nullable()->after('code');
            }
            if (!Schema::hasColumn('airlines', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null')->after('logo');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('airlines', function (Blueprint $table) {
            if (Schema::hasColumn('airlines', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
            if (Schema::hasColumn('airlines', 'logo')) {
                $table->dropColumn('logo');
            }
        });
    }
};
