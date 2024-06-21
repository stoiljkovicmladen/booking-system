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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('booking_entity_id')->nullable();
            $table->unsignedBigInteger('booking_entity_object_id');
            $table->timestamp('booking_date')->nullable(); // The date of the booking
            $table->timestamp('start_time'); // The start time of the booking
            $table->timestamp('end_time')->nullable(); // The end time of the booking
            $table->string('status')->default('pending'); // Status of the booking (e.g., pending, confirmed, cancelled)
            $table->timestamps();

            $table->foreign('booking_entity_object_id')->references('id')->on('booking_entity_objects')->onDelete('cascade');
            // $table->foreign('booking_entity_id')->references('id')->on('booking_entities')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
