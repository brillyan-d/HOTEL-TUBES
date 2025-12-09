<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporans', function (Blueprint $table) {

            $table->date('report_date')->nullable();

            $table->integer('total_bookings')->default(0);
            $table->integer('total_success_transactions')->default(0);
            $table->decimal('total_income', 10, 2)->default(0);

            $table->text('notes')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropColumn([
                'report_date',
                'total_bookings',
                'total_success_transactions',
                'total_income',
                'notes',
            ]);
        });
    }
};
