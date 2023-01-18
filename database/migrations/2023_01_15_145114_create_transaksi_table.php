<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->unsignedBigInteger('pelanggan_id');
            $table->unsignedBigInteger('produk_id');
            $table->unsignedBigInteger('bank_id');
            $table->enum('jenis_payment',['deposit','bonus']);
            $table->double('saldo_deposit')->default(0);
            $table->double('saldo_akhir')->nullable();
            $table->date('waktu');
            $table->timestamps();
        });
        
        Schema::table('transaksi', function($table) {
            $table->foreign('pelanggan_id')->references('id_pelanggan')->on('pelanggan');
            $table->foreign('produk_id')->references('id_produk')->on('produk');
            $table->foreign('bank_id')->references('id_bank')->on('bank');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
