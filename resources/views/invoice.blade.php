<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Nota Sawit</title>

<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<script src="https://cdn.tailwindcss.com"></script>

<style>
.thermal {
  width: 300px;
  font-size: 15px;
  line-height: 1.4;
  font-weight: 600;
}

@media print {
  body * { visibility: hidden; }
  #printArea, #printArea * { visibility: visible; }
  #printArea {
    position: absolute;
    left: 0;
    top: 0;
    width: 300px;
  }
}
</style>
</head>

<body class="bg-gray-100 p-4">

<div id="app">

  <div id="printArea" class="thermal mx-auto bg-white shadow-lg p-3 font-mono">

    <!-- LOGO -->
    <div class="flex flex-col items-center mb-2">
      <img src="{{ $url.'/'.($profile['logo']) }}" class="w-16 h-16 object-contain mb-1">
      <div class="text-center">
        <div class="font-bold text-sm">{{ $profile['name'] }}</div>
        <div>{{ $profile['address'] }}</div>
        <div>Telp: {{ $profile['hp'] }}</div>
      </div>
    </div>

    <div class="border-t border-dashed my-2"></div>

    <!-- HEADER -->
    <div class="text-xs">
      <div class="flex justify-between">
        <span>No Nota</span>
        <span>{{ $transaction['inv'] }}</span>
      </div>

      <div class="flex justify-between">
        <span>Tanggal</span>
        <span>{{ $transaction['created_at'] }}</span>
      </div>

      <div class="flex justify-between">
        <span>Petani</span>
        <span>{{ $transaction['name'] }}</span>
      </div>

      <div class="flex justify-between">
        <span>Jenis</span>
        <span v-if="type == 1">TBS</span>
        <span v-else>Brondolan</span>
      </div>
    </div>

    <div class="border-t border-dashed my-2"></div>

    <!-- BERAT -->
    <table class="w-full text-xs">
      <tr>
        <td>Bruto</td>
        <td class="text-right">@{{ timbang.bruto }} kg</td>
      </tr>

      <tr>
        <td>Tara</td>
        <td class="text-right">@{{ timbang.tara }} kg</td>
      </tr>

      <tr class="font-bold">
        <td>Netto</td>
        <td class="text-right">@{{ netto }} kg</td>
      </tr>

      <!-- Hanya untuk TBS -->
      <tr v-if="type == 1">
        <td>@{{ persen }} % dari Netto</td>
        <td class="text-right">
          @{{ (netto - ((netto * persen) / 100)) }} kg
        </td>
      </tr>
    </table>

    <div class="border-t border-dashed my-2"></div>

    <!-- HARGA -->
    <table class="w-full text-xs">

      <tr>
        <td>Harga Sawit</td>
        <td class="text-right">Rp @{{ rupiah(harga) }}</td>
      </tr>

      <!-- TBS -->
      <template v-if="type == 1">

        <tr>
          <td>Subtotal</td>
          <td class="text-right">Rp @{{ rupiah(subtotal) }}</td>
        </tr>

        <tr>
          <td>Potongan @{{ persen }} %</td>
          <td class="text-right">Rp @{{ rupiah(potonganPersen) }}</td>
        </tr>

        <tr>
          <td>Potongan Muat</td>
          <td class="text-right">Rp @{{ rupiah(potonganMuat) }}</td>
        </tr>

      </template>

      <!-- TOTAL -->
      <tr class="font-bold text-sm">
        <td>Total Bayar</td>
        <td class="text-right">Rp @{{ rupiah(totalBayar) }}</td>
      </tr>

    </table>

    <div class="border-t border-dashed my-2"></div>

    <div class="text-center text-xs">
      Terima kasih<br>
      Simpan nota ini sebagai bukti transaksi
    </div>

  </div>

</div>

<script>
new Vue({
  el: "#app",

  data: {
    type: {{ $type }},

    netto : {{ $transaction['berat_total_sawit_netto'] }},

    timbang: {
      bruto: {{ $transaction['berat_mobil_sawit_bruto'] }},
      tara: {{ $transaction['berat_mobil_kosong_tara'] }}
    },

    harga: {{ $transaction['price_sawit'] }},
    persen: {{ $transaction['potongan_persentase'] }},
    potonganMuat: {{ $transaction['potongan_muat'] }}
  },

  computed: {
    netto() {
       // Jika Brondolan → ambil dari DB
    if (this.type == 2) {
      return Number(this.nettoDb) || 0;
    }

    // Jika TBS → hitung otomatis
    const bruto = Number(this.timbang.bruto) || 0;
    const tara  = Number(this.timbang.tara) || 0;

    return bruto - tara;
    },

    subtotal() {
      return this.netto * (this.harga || 0);
    },

    potonganPersen() {
      return this.subtotal * ((this.persen || 0) / 100);
    },

    totalBayar() {
      if (this.type == 2) {
        return this.netto * (this.harga || 0);
      }

      return this.subtotal - this.potonganPersen - (this.potonganMuat || 0);
    }
  },

  methods: {
    rupiah(v) {
      return Number(v || 0).toLocaleString("id-ID");
    }
  }
});

window.print();
</script>

</body>
</html>
