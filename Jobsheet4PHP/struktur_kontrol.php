<?php
$nilaiNumerik = 92;

if ($nilaiNumerik >= 90 && $nilaiNumerik <= 100) {
    echo "Nilai huruf: A";
} elseif ($nilaiNumerik >= 80 && $nilaiNumerik < 90) {
    echo "Nilai huruf: B";
} elseif ($nilaiNumerik >= 70 && $nilaiNumerik < 80) {
    echo "Nilai huruf: C";
} elseif ($nilaiNumerik < 70) {
    echo "Nilai huruf: D";
}
echo "<br>";
$jarakSaatIni = 0;
$jarakTarget = 500;
$peningkatanHarian = 30;
$hari = 0;

while ($jarakSaatIni < $jarakTarget) {
    $jarakSaatIni += $peningkatanHarian;
    $hari++;
}

echo "Atlet tersebut memerlukan $hari hari untuk mencapai jarak 500 kilometer.";

echo "<br>";
$jumlahLahan = 10;
$tanamanPerLahan = 5;
$buahPerTanaman = 10;
$jumlahBuah = 0;

for ($i = 1; $i <= $jumlahLahan; $i++) {
    $jumlahBuah += ($tanamanPerLahan * $buahPerTanaman);
}

echo "Jumlah buah yang akan dipanen adalah: $jumlahBuah";

echo "<br>";
$skorUjian = [85, 92, 78, 96, 88];
$totalSkor = 0;

foreach ($skorUjian as $skor) {
    $totalSkor += $skor;
}

echo "Total skor ujian adalah: $totalSkor";

echo "<br>";
$nilaiSiswa = [85, 92, 58, 64, 90, 55, 88, 79, 70, 96];

foreach ($nilaiSiswa as $nilai) {
    if ($nilai < 60) {
        echo "Nilai: $nilai (Tidak lulus) <br>";
        continue;
    }
    echo "Nilai: $nilai (Lulus) <br>";
}
echo "<br>";
// soal no 4.6
$nilai = [85, 92, 78, 64, 90, 75, 88, 79, 70, 96];
$tertinggi = [];
$terendah = [];

// cari 2 nilai tertinggi
foreach ($nilai as $n) {
    if (count($tertinggi) < 2) {
        $tertinggi[] = $n;
    } else {
        $minTinggi = min($tertinggi);
        if ($n > $minTinggi) {
            $key = array_search($minTinggi, $tertinggi);
            $tertinggi[$key] = $n;
        }
    }
}

// cari 2 nilai terendah
foreach ($nilai as $n) {
    if (count($terendah) < 2) {
        $terendah[] = $n;
    } else {
        $maxRendah = max($terendah);
        if ($n < $maxRendah) {
            $key = array_search($maxRendah, $terendah);
            $terendah[$key] = $n;
        }
    }
}

$total = 0;
$abaikan = array_merge($tertinggi, $terendah);
$counter = array_count_values($abaikan);

foreach ($nilai as $n) {
    if (isset($counter[$n]) && $counter[$n] > 0) {
        $counter[$n]--;
        continue;
    }
    $total += $n;
}

echo "Total nilai setelah mengabaikan dua tertinggi dan dua terendah: $total";
echo "<br>";
// soal no 4.7
$hargaAwal = 120000;
$diskonPersen = 20;
$batasDiskon = 100000;

if ($hargaAwal > $batasDiskon) {
    $diskon = ($diskonPersen / 100) * $hargaAwal;
    $hargaAkhir = $hargaAwal - $diskon;
} else {
    $hargaAkhir = $hargaAwal;
}

echo "Harga yang harus dibayar: Rp " . number_format($hargaAkhir, 0, ',', '.');

echo "<br>";
// soal no 4.8
$poin = 620; // Ubah sesuai poin yang dikumpulkan

echo "Total skor pemain adalah: {$poin} <br>";
echo "Apakah pemain mendapatkan hadiah tambahan? " . ($poin > 500 ? "YA" : "TIDAK");
?>