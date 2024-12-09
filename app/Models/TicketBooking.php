<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TicketBooking extends Migration
{
    public function up()
    {
        Schema::create('ticket_bookings', function (Blueprint $table) {
            $table->id('id_booking');
            $table->foreignId('id_user')->constrained('users');
            $table->foreignId('id_category')->constrained('ticket_categories');
            $table->string('booking_code', 20)->unique();
            $table->integer('quantity');
            $table->decimal('total_amount', 10, 2);
            $table->enum('payment_status', ['pending', 'paid', 'cancelled', 'refunded'])->default('pending');
            $table->string('payment_method', 50)->nullable();
            $table->string('payment_proof')->nullable();
            $table->timestamp('payment_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ticket_bookings');
    }
}