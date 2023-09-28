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
        Schema::create('seat_ticket', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seat_id');
            $table->unsignedBigInteger('ticket_id');
            $table->timestamps();

            $table->foreign('seat_id')->references('id')->on('seats')->cascadeOnDelete();
            $table->foreign('ticket_id')->references('id')->on('tickets')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seat_ticket');
    }
};
