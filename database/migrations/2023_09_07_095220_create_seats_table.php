<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->integer('row');
            $table->integer('number');
            $table->unsignedBigInteger('hall_id');
            $table->unsignedBigInteger('ticket_id')->nullable();
            $table->unsignedBigInteger('session_id');
            $table->unsignedBigInteger('seat_type_id')->default(1);
            $table->unsignedBigInteger('seat_status_id')->default(1);
            $table->timestamps();

            $table->foreign('hall_id')->references('id')->on('halls')->cascadeOnDelete();
            $table->foreign('seat_type_id')->references('id')->on('seat_types')->cascadeOnDelete();
            $table->foreign('seat_status_id')->references('id')->on('seat_statuses')->cascadeOnDelete();
            $table->foreign('ticket_id')->references('id')->on('tickets')->nullOnDelete();
            $table->foreign('session_id')->references('id')->on('sessions')->cascadeOnDelete();
            $table->unique(['hall_id', 'session_id', 'row', 'number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};
