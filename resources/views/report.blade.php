<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Report Sales</title>

<style>
body {
    font-family: Arial, sans-serif;
    margin: 20px;
}

.container {
    width: 100%;
}

.header {
    text-align: center;
    margin-bottom: 20px;
}

.header h2 {
    margin: 0;
}

.info {
    margin-bottom: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

table th, table td {
    border: 1px solid #000;
    padding: 6px;
}

table th {
    background: #f0f0f0;
}

.text-right {
    text-align: right;
}

.text-center {
    text-align: center;
}

.footer {
    margin-top: 20px;
    text-align: right;
}

/* PRINT */
@media print {
    .no-print {
        display: none;
    }

    body {
        margin: 0;
    }
}
</style>

</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <h2>REPORT SALES</h2>
        <div>{{ $profile['name'] }}</div>
        <div>{{ $date }}</div>
        <div>{{ $description }}</div>
    </div>

    <div class="info">
        <strong>Print Date:</strong> {{ $now }}
    </div>

    <!-- TABLE -->
    <table>
        <thead>
        <tr>
            <th style="width:40px;">No</th>
            <th style="width:90px;">Date</th>
            <th>Invoice</th>
            <th>Petani</th>
            <th>Harga/Kg</th>
            <th>Bruto</th>
            <th>Tara</th>
            <th>Netto</th>
            <th>Nilai Kotor</th>
            <th>Potongan % ({{ $transaction[0]->potongan_persentase }}%)</th>
            <th>Potongan Muat</th>
            <th class="text-right" style="width:140px;">Sub Total</th>
        </tr>
        </thead>

        <tbody>

@php
$grand_total = 0;
@endphp

@forelse($transaction as $index => $row)

@php
    // =========================
    // HITUNGAN LENGKAP
    // =========================

    $bruto = (float) $row->berat_mobil_sawit_bruto;
    $tara  = (float) $row->berat_mobil_kosong_tara;

    // NETTO
    $netto = $bruto - $tara;

    // HARGA PER KG
    $harga = (float) $row->price_sawit;

    // NILAI KOTOR
    $nilai_kotor = $netto * $harga;

    // POTONGAN PERSEN
    $pot_persen_nominal = ($nilai_kotor * $row->potongan_persentase) / 100;

    // =========================
    // POTONGAN MUAT
    // =========================
    // MODE A: FLAT
    $pot_muat_nominal = (float)  $row->potongan_muat;

    // MODE B: PER KG  → aktifkan jika modelnya per kg
    // $pot_muat_nominal = $netto * $potongan_muat;

    // SUBTOTAL
    $subtotal = $nilai_kotor - $pot_persen_nominal - $pot_muat_nominal;

    $grand_total += $subtotal;
@endphp

<tr>
    <td class="text-center">{{ $index + 1 }}</td>

    <td class="text-center">
        {{ date('d/m/Y', strtotime($row->created_at)) }}
    </td>

    <td>{{ $row->inv }}</td>
    <td>{{ $row->name }}</td>

    <td class="text-right">
        Rp {{ number_format($harga,0,',','.') }}
    </td>

    <td class="text-right">
        {{ number_format($bruto,0,',','.') }}
    </td>

    <td class="text-right">
        {{ number_format($tara,0,',','.') }}
    </td>

    <td class="text-right">
        {{ number_format($netto,0,',','.') }}
    </td>

    <td class="text-right">
        Rp {{ number_format($nilai_kotor,0,',','.') }}
    </td>

    <td class="text-right">
        Rp {{ number_format($pot_persen_nominal,0,',','.') }}
    </td>

    <td class="text-right">
        Rp {{ number_format($pot_muat_nominal,0,',','.') }}
    </td>

    <td class="text-right">
        Rp {{ number_format($subtotal,0,',','.') }}
    </td>
</tr>

@empty
<tr>
    <td colspan="12" class="text-center">
        <em>Data tidak tersedia</em>
    </td>
</tr>
@endforelse

        </tbody>

        <!-- FOOTER TOTAL -->
        <tfoot>
        <tr>
            <th colspan="11" class="text-center">TOTAL</th>
            <th class="text-right">
                Rp {{ number_format($grand_total, 0, ',', '.') }}
            </th>
        </tr>
        </tfoot>

    </table>

    <!-- SIGN -->
    <div class="footer">
        <br>
        <div>Mengetahui,</div>
        <br><br><br>
        <div>(Admin)</div>
    </div>

</div>

<script>
    // Auto print jika perlu
    window.print();
</script>

</body>
</html>
