<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailpenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailpenjualans', function (Blueprint $table) {
            $table->bigIncrements('DetailID');
            $table->unsignedBigInteger('PenjualanID'); // Menggunakan unsignedBigInteger untuk relasi
            $table->unsignedBigInteger('ProdukID'); // Menggunakan unsignedBigInteger untuk relasi
            $table->unsignedInteger('JumlahProduk');
            $table->decimal('Harga', 10, 2); // Menambahkan kolom harga satuan
            $table->decimal('Subtotal', 10, 2);
            $table->timestamps();

            // Menambahkan foreign key jika ada relasi ke tabel penjualans dan produk
            $table->foreign('PenjualanID')->references('PenjualanID')->on('penjualans')->onDelete('cascade');
            $table->foreign('ProdukID')->references('ProdukID')->on('produks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detailpenjualans');
    }
}
