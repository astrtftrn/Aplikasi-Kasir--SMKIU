<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->bigIncrements('PembayaranID'); // Primary Key
            $table->unsignedBigInteger('PenjualanID'); // Foreign Key ke tabel Penjualans
            $table->date('TanggalPembayaran');
            $table->decimal('TotalHarga', 10, 2); // Tambahan field TotalHarga
            $table->decimal('JumlahPembayaran', 10, 2);
            $table->decimal('Kembalian', 10, 2)->default(0.00); // Tambahan field Kembalian
            $table->string('MetodePembayaran', 50);
            $table->enum('StatusPembayaran', ['Lunas', 'Belum Lunas']);
            $table->timestamps();

            // Perbaiki foreign key agar mengacu ke 'PenjualanID' di tabel 'penjualans'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayarans');
    }
}
