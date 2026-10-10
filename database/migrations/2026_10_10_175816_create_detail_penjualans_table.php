<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_penjualans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('penjualan_Id')
                ->constrained('penjualans')
                ->cascadeOnDelete();

            $table->foreignId('barang_id')
                ->constrained('barangs');

            $table->integer('jumlah');
            $table->decimal('harga', 15, 2);    
            $table->decimal('subtotal', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_penjualans');
    }
};
