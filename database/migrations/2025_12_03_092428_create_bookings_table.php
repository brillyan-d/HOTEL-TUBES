<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id'); // tamu/pengguna yang pesan
            $table->unsignedBigInteger('room_id'); // kamar yang dipesan

            $table->date('check_in');
            $table->date('check_out');
            $table->integer('guest_count'); // jumlah tamu
            $table->enum('status', ['booked', 'checked_in', 'checked_out', 'cancelled'])
                  ->default('booked');

            $table->timestamps();

            // Relasi
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
