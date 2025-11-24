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
        // If bookings table doesn't exist, create fresh with expected columns
        if (! Schema::hasTable('bookings')) {
            Schema::create('bookings', function (Blueprint $table) {
                $table->id();
                $table->timestamp('booking_date')->useCurrent();
                $table->string('status')->nullable();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('payment_id')->nullable()->constrained('payments')->nullOnDelete();
                $table->foreignId('flight_id')->constrained('flights')->onDelete('cascade');
                $table->string('seat_number')->nullable();
                $table->timestamps();
                $table->unique(['flight_id','seat_number']);
            });
            return;
        }

        // If the table exists, ensure expected columns exist and add any that are missing.
        Schema::table('bookings', function (Blueprint $table) {
            if (! Schema::hasColumn('bookings', 'booking_date')) {
                $table->timestamp('booking_date')->useCurrent()->after('id');
            }
            if (! Schema::hasColumn('bookings', 'status')) {
                $table->string('status')->nullable()->after('booking_date');
            }
            if (! Schema::hasColumn('bookings', 'user_id')) {
                $table->foreignId('user_id')->constrained()->after('status')->onDelete('cascade');
            }
            if (! Schema::hasColumn('bookings', 'payment_id')) {
                $table->foreignId('payment_id')->nullable()->constrained('payments')->after('user_id')->nullOnDelete();
            }
            if (! Schema::hasColumn('bookings', 'flight_id')) {
                $table->foreignId('flight_id')->constrained('flights')->after('payment_id')->onDelete('cascade');
            }
            if (! Schema::hasColumn('bookings', 'seat_number')) {
                $table->string('seat_number')->nullable()->after('flight_id');
            }
            if (! Schema::hasColumn('bookings', 'created_at') || ! Schema::hasColumn('bookings', 'updated_at')) {
                $table->timestamps();
            }
        });

        // Try to add unique index if missing
        try {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $indexes = array_map(function($i){ return $i->getColumns(); }, $sm->listTableIndexes('bookings'));
            $hasUnique = false;
            foreach ($indexes as $cols) {
                if (in_array('flight_id', $cols) && in_array('seat_number', $cols)) { $hasUnique = true; break; }
            }
            if (! $hasUnique) {
                Schema::table('bookings', function (Blueprint $table) {
                    $table->unique(['flight_id','seat_number']);
                });
            }
        } catch (\Throwable $e) {
            // Doctrine may not be available or index already exists; ignore safely
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // We won't drop the table automatically in down — leave data intact.
        // Optionally reverse columns added, but keep down() empty to be safe.
    }
};
