<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       DB::statement(<<<SQL
             CREATE VIEW view_transaction AS
            select transaction.*,petani.name,daily_prices.price_daily,netto_petani.berat_mobil_sawit_bruto,netto_petani.berat_total_sawit_netto,netto_petani.berat_mobil_kosong_tara
            from transaction
            join petani
            join daily_prices
            join netto_petani
            where transaction.id_petani = petani.id and daily_prices.id = transaction.id_daily_price and netto_petani.id = transaction.id_netto_petani
        SQL);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
          DB::statement('DROP VIEW view_transaction;');
    }
};
