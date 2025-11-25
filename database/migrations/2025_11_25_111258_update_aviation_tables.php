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
        // Add images to airports table
        Schema::table('airports', function (Blueprint $table) {
            $table->string('image')->default('img/loginsplash.jpeg');
        });

        // Add logo column to airlines table
        Schema::table('airlines', function (Blueprint $table) {
            $table->string('logo')->default('img/loginsplash.jpeg');
        });

        // Remove image column from flights table
        Schema::table('flights', function (Blueprint $table) {
            $table->dropColumn('image');
        });

        // Add business_class_price to flights table
        Schema::table('flights', function (Blueprint $table) {
            $table->decimal('business_class_price', 10, 2)->nullable();
        });

        // Add class column to bookings table
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('class', 50)->default('economy');
        });

        // Update existing flights with business class prices (typically 1.5x base price)
        DB::table('flights')->update([
            'business_class_price' => DB::raw('base_price * 1.5')
        ]);

        // Update existing bookings with class information
        DB::table('bookings')->whereNull('class')->update([
            'class' => 'economy'
        ]);

        // Add airline user if it doesn't exist
        DB::table('users')->insertOrIgnore([
            'name' => 'Philippine Airlines',
            'email' => 'airline@philippineairlines.com',
            'usertype' => 'airline',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'role' => 'airline',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Update the airline table to connect with the user
        DB::table('airlines')->where('id', 1)->update([
            'name' => 'Philippine Airlines',
            'code' => 'PR'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove image from airports
        Schema::table('airports', function (Blueprint $table) {
            $table->dropColumn('image');
        });

        // Remove logo from airlines
        Schema::table('airlines', function (Blueprint $table) {
            $table->dropColumn('logo');
        });

        // Add image back to flights
        Schema::table('flights', function (Blueprint $table) {
            $table->string('image')->nullable();
        });

        // Remove business_class_price from flights
        Schema::table('flights', function (Blueprint $table) {
            $table->dropColumn('business_class_price');
        });

        // Remove class from bookings
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('class');
        });

        // Remove the airline user
        DB::table('users')->where('email', 'airline@philippineairlines.com')->delete();

        // Revert airline update (you might want to adjust this based on your original values)
        DB::table('airlines')->where('id', 1)->update([
            'name' => 'Original Name', // Replace with original value
            'code' => 'OR' // Replace with original value
        ]);
    }

};