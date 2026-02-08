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
        Schema::create('netto_petani', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_petani');
            $table->float('berat_mobil_sawit_bruto');
            $table->float('berat_mobil_kosong_tara');
            $table->float('berat_total_sawit_netto');
         
             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('netto_petani');
    }
};
