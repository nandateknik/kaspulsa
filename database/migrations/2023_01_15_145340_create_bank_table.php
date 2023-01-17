<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank', function (Blueprint $table) {
            $table->id('id_bank');
            $table->unsignedBigInteger('pelanggan_id');
            $table->string('nama_bank',50);
            $table->string('no_rekening',50);
            $table->string('nama_rekening',50);
            $table->double('saldo_akhir');
            $table->timestamps();
        });
        
        Schema::table('bank', function($table) {
            $table->foreign('pelanggan_id')->references('id_pelanggan')->on('pelanggan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank');
    }
}
