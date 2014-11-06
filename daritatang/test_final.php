<?php

include_once '../database/kueri.class.php';
include_once '../database/permutasi.class.php';

$kueri = new Kueri();
$permu = new Permutasi();

// $arrayBarangDanJumlah = array berisi array(namaBarang, jumlahBeli);
$arrayBarangDanJumlah = $kueri->getJumlahJenis("faktur", "barang");

// $arrayHasilPermutasi = array(array(namaBarang))
$arrayHasilPermutasi = $permu->kembalikan($arrayBarangDanJumlah, 2);

$panjangPermutasi = count($arrayHasilPermutasi);
if ($panjangPermutasi > 0) {
	$array1 = array();
	$array2 = array();
	$panjangKomponenArray = count($arrayHasilPermutasi[0]);
	for ($i=0; $i < $panjangPermutasi; $i++) { 
		$namaBarang1 = $arrayHasilPermutasi[$i][0][0];
		$namaBarang2 = $arrayHasilPermutasi[$i][1][0];

		$diFakturBareng = $kueri->cariYangSama($namaBarang1,
											   $namaBarang2);

		$pembelianBarang1 = $kueri->getJumlahDiFaktur($namaBarang1);
		$pembelianBarang2 = $kueri->getJumlahDiFaktur($namaBarang2);

		$kueri->insertItemSetSatu($arrayHasilPermutasi[$i][0],
								  $arrayHasilPermutasi[$i][1]);

		$konfidensi1 = $diFakturBareng / $pembelianBarang1;
		$konfidensi2 = $diFakturBareng / $pembelianBarang2;
		echo $konfidensi1 . " " . $konfidensi2 . "<br>";

		$kueri->updateKonfidensi($namaBarang1, $namaBarang2,
								 $konfidensi1, $konfidensi2);
		echo "insert ke " . $i . "<br>";
	}
	echo "selesai.";
} else {
	echo "belum ada judul.";
}

?>