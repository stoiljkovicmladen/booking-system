<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingEntityObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_entity_objects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_entity_id');
            $table->string('name'); // e.g., Table 1, Seat A1
            $table->string('type'); // e.g., seat, table
            $table->timestamps();

            $table->foreign('booking_entity_id')->references('id')->on('booking_entities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_entity_objects');
    }
}
