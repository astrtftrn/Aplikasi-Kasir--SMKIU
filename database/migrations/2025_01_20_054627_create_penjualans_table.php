<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->bigIncrements('PenjualanID'); // Auto increment primary key
            $table->date('TanggalPenjualan'); // Kolom untuk tanggal
            $table->decimal('TotalHarga', 10, 2); // Kolom untuk harga dengan presisi
            $table->unsignedBigInteger('PelangganID'); // Kolom foreign key
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualans');
    }
}
