<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->string("inv");
            $table->bigInteger('id_petani');
            $table->bigInteger('id_netto_petani');
            $table->float('price_sawit');
            $table->float('total_money');
            $table->text('type_payment');
            $table->float('potongan_muat');
            $table->float('potongan_persentase');
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};
