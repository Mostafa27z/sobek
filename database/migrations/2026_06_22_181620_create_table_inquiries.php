<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('phone_number');
            $table->string('email')->nullable();
            $table->string('from_city')->nullable();
            $table->string('to_city')->nullable();
            $table->date('desired_date')->nullable();
            $table->integer('number_of_adults')->nullable();
            $table->integer('number_of_children')->nullable();
            $table->integer('number_of_babies')->nullable();
            $table->text('message');
            $table->enum('status', ['pending', 'read', 'responded'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};