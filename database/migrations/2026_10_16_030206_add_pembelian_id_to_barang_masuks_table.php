<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barang_masuks', function (Blueprint $table) {
            $table->foreignId('pembelian_id')
            ->nullable()
            ->after('id')
            ->constrained('pembelians')
            ->nullOnDelete();
        });
    }
    public function down(): void
    {
        Schema::table('barang_masuks', function (Blueprint $table) {
            $table->dropConstrainedForeignId('pembelian_id');
        });
    }
};
