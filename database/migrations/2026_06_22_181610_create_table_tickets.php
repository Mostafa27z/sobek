<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_city_id');
            $table->unsignedBigInteger('to_city_id');
            $table->date('departure_date');
            $table->integer('number_of_adults');
            $table->integer('number_of_children')->default(0);
            $table->integer('number_of_babies')->default(0);
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->foreign('from_city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('to_city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};