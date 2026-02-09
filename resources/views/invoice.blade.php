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
  font-size: 12px;
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

  <!-- NOTA -->
  <div id="printArea" class="thermal mx-auto bg-white shadow-lg p-3 font-mono">

    <!-- LOGO + PROFILE -->
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
    </table>

    <div class="border-t border-dashed my-2"></div>

    <!-- HARGA -->
    <table class="w-full text-xs">
      <tr>
        <td>Harga Sawit</td>
        <td class="text-right">Rp @{{ rupiah(harga) }}</td>
      </tr>

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
    timbang: {
      bruto: {{ $transaction['berat_mobil_sawit_bruto'] }},
      tara: {{ $transaction['berat_mobil_kosong_tara'] }}
    },

    harga: {{ $transaction['price_daily'] }},
    persen: {{ $setting['potongan_persen'] }},
    potonganMuat: {{ $setting['potongan_muat'] }}
  },

  computed: {
    netto() {
      return this.timbang.bruto - this.timbang.tara;
    },

    subtotal() {
      return this.netto * this.harga;
    },

    potonganPersen() {
      return this.subtotal * (this.persen / 100);
    },

    totalBayar() {
      return this.subtotal - this.potonganPersen - this.potonganMuat;
    }
  },

  methods: {
    rupiah(v) {
      return Number(v).toLocaleString("id-ID");
    },

    printNota() {
      window.print();
    }
  }
});

window.print()
</script>

</body>
</html>
