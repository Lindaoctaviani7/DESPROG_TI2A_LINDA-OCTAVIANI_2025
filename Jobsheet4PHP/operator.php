<?php
$a = 10;
$b = 5;

$hasilTambah = $a + $b;
$hasilKurang = $a - $b;
$hasilKali = $a * $b;
$hasilBagi = $a / $b;
$sisaBagi = $a % $b;
$pangkat = $a ** $b;

echo "a = {$a} <br>";
echo "b = {$b} <br><br>";

echo "Hasil Penjumlahan (a + b) = {$hasilTambah} <br>";
echo "Hasil Pengurangan (a - b) = {$hasilKurang} <br>";
echo "Hasil Perkalian (a * b) = {$hasilKali} <br>";
echo "Hasil Pembagian (a / b) = {$hasilBagi} <br>";
echo "Hasil Sisa Bagi (a % b) = {$sisaBagi} <br>";
echo "Hasil Pangkat (a ** b) = {$pangkat} <br>";

$hasilSama = $a == $b;
$hasilTidakSama = $a != $b;
$hasilLebihKecil = $a < $b;
$hasilLebihBesar = $a > $b;
$hasilLebihKecilSama = $a <= $b;
$hasilLebihBesarSama = $a >= $b;

$boolToString = function($val) {
    return $val ? 'TRUE (1)' : 'FALSE (Kosong)';
};
echo "Apakah a sama dengan b? (a == b) : " . $boolToString($hasilSama) . " <br>";
echo "Apakah a tidak sama dengan b? (a != b) : " . $boolToString($hasilTidakSama) . " <br>";
echo "Apakah a lebih kecil dari b? (a < b) : " . $boolToString($hasilLebihKecil) . " <br>";
echo "Apakah a lebih besar dari b? (a > b) : " . $boolToString($hasilLebihBesar) . " <br>";
echo "Apakah a lebih kecil atau sama dengan b? (a <= b) : " . $boolToString($hasilLebihKecilSama) . " <br>";
echo "Apakah a lebih besar atau sama dengan b? (a >= b) : " . $boolToString($hasilLebihBesarSama) . " <br>";
echo "<br>";

$a = true;
$b = false;

$hasilAnd = $a && $b; 
$hasilOr = $a || $b;   
$hasilNotA = !$a;      
$hasilNotB = !$b;      

echo "Apakah a AND b? : " . ($hasilAnd ? "true" : "false") . "<br>";
echo "Apakah a OR b? : " . ($hasilOr ? "true" : "false") . "<br>";
echo "NOT a : " . ($hasilNotA ? "true" : "false") . "<br>";
echo "NOT b : " . ($hasilNotB ? "true" : "false") . "<br>";

$hasilIndentik = $a === $b;
$hasilTidakIndentik = $a !== $b;
echo "Apakah a identik dengan b? (a === b) : " . ($hasilIndentik ? "true" : "false") . "<br>";
echo "Apakah a tidak identik dengan b? (a !== b) : " . ($hasilTidakIndentik ? "true" : "false") . "<br>";

$totKursi = 45;
$terisi = 28;
$kursiKosong = (45-28)/45 * 100;

echo "Total Kursi Resto = $totKursi<br>";
echo "Kursi yang terisi pada suatu malam = $terisi<br>";
echo "Persen Kursi yang masih kosong $kursiKosong%";

echo "<br>";
$a = 10;
$b = 5;

$a += $b;
$a -= $b;
$a *= $b;
$a /= $b;
$a %= $b;

$a += $b; // sama dengan $a = $a + $b
echo "Setelah a += b, nilai a = {$a} <br>";

// Reset nilai $a ke 10 sebelum operasi berikutnya agar hasil perhitungan benar dan berurutan
$a = 10; 

$a -= $b; // sama dengan $a = $a - $b
echo "Setelah a -= b, nilai a = {$a} <br>";

// Reset nilai $a ke 10 sebelum operasi berikutnya
$a = 10; 

$a *= $b; // sama dengan $a = $a * $b
echo "Setelah a *= b, nilai a = {$a} <br>";

// Reset nilai $a ke 10 sebelum operasi berikutnya
$a = 10; 

$a /= $b; // sama dengan $a = $a / $b
echo "Setelah a /= b, nilai a = {$a} <br>";

// Reset nilai $a ke 10 sebelum operasi berikutnya
$a = 10; 

$a %= $b; // sama dengan $a = $a % $b
echo "Setelah a %= b, nilai a = {$a} <br><br>";

?>