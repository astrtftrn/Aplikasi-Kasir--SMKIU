<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->bigIncrements('ProdukID'); 
            $table->string('NamaProduk', 255); 
            $table->decimal('Harga', 10, 2); 
            $table->unsignedInteger('Stok'); 
            $table->text('Deskripsi')->nullable(); 
            $table->unsignedBigInteger('KategoriID'); 
            $table->string('GambarProduk')->nullable(); // Menambahkan field gambar produk
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produks');
    }
}
