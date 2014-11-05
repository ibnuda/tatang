<?php
/*
 * INSERT KE DATABASE DENGAN PERMUTASI SUDAH BISA. :D
 *
 */
include_once '../database/kueri.class.php';
include_once '../database/permutasi.class.php';

$kueri = new Kueri();
$permu = new Permutasi();

$pemecah = 2;
$arrayBarangDanJumlah = $kueri->getJumlahJenis("faktur", "barang");

// print_r($arrayBarangDanJumlah);

$panjangArrayBarang = count($arrayBarangDanJumlah);

$hasilPermutasi = $permu->hasilPermutasi($panjangArrayBarang, $pemecah);

// print_r($hasilPermutasi);

for ($i=0; $i < count($hasilPermutasi); $i++) { 
	$kueri->insertItemSetSatu($arrayBarangDanJumlah[$hasilPermutasi[$i][0]], 
							  $arrayBarangDanJumlah[$hasilPermutasi[$i][1]]);
	echo "<br><br>";
}
?>