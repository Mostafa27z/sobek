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
        Schema::table('tickets', function (Blueprint $table) {
            $table->string('airline')->nullable()->after('to_city_id');
            $table->string('weight')->nullable()->after('airline');
            $table->dateTime('arrival_date')->nullable()->after('departure_date');
            $table->dateTime('return_arrival_date')->nullable()->after('return_date');
            
            // Duration for departure flight
            $table->integer('duration_days')->default(0)->after('arrival_date');
            $table->integer('duration_hours')->default(0)->after('duration_days');
            $table->integer('duration_minutes')->default(0)->after('duration_hours');

            // Duration for return flight
            $table->integer('return_duration_days')->default(0)->after('return_arrival_date');
            $table->integer('return_duration_hours')->default(0)->after('return_duration_days');
            $table->integer('return_duration_minutes')->default(0)->after('return_duration_hours');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn([
                'airline', 'weight', 'arrival_date', 'return_arrival_date',
                'duration_days', 'duration_hours', 'duration_minutes',
                'return_duration_days', 'return_duration_hours', 'return_duration_minutes'
            ]);
        });
    }
};
