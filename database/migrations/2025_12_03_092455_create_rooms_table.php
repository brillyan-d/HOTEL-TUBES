<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number')->unique(); // nomor kamar
            $table->string('type');                 // tipe kamar (Standard, Deluxe, Suite)
            $table->integer('capacity');            // kapasitas tamu
            $table->decimal('price', 10, 2);        // harga per malam
            $table->boolean('breakfast_included')
                  ->default(false);                // termasuk sarapan atau tidak
            $table->enum('status', ['available', 'maintenance'])
                  ->default('available');          // status kamar
            $table->text('description')->nullable(); // deskripsi kamar
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
