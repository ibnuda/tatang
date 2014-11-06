<?php

include_once '../database/kueri.class.php';
include_once '../database/permutasi.class.php';

$kueri = new Kueri();
$permu = new Permutasi();

// $arrayBarangDanJumlah = array berisi array(namaBarang, jumlahBeli);
$arrayBarangDanJumlah = $kueri->getJumlahJenis("faktur", "barang");

// $arrayHasilPermutasi = array(array(namaBarang, jumlah))
$arrayHasilPermutasi = $permu->kembalikan($arrayBarangDanJumlah, 2);

// $panjangPermutasi = panjang $arrayHasilPermutasi.
$panjangPermutasi = count($arrayHasilPermutasi);
if ($panjangPermutasi > 0) {
	// inisiasi objek array.
	$array1 = array();
	$array2 = array();

	//$panjangKomponenArray = panjang isi array $arrayHasilPermutasi[0].
	$panjangKomponenArray = count($arrayHasilPermutasi[0]);
	for ($i=0; $i < $panjangPermutasi; $i++) { 

		// $namaBarang1 = nama barang dari arrayHasilPermutasi.
		$namaBarang1 = $arrayHasilPermutasi[$i][0][0];
		$namaBarang2 = $arrayHasilPermutasi[$i][1][0];

		// menemukan jumlah kejadian dimana barang1 dan barang2 dibeli 
		// dalam satu faktur.
		$diFakturBareng = $kueri->cariYangSama($namaBarang1,
											   $namaBarang2);

		// menemukan jumlah pembelian barang pada faktur.
		$pembelianBarang1 = $kueri->getJumlahDiFaktur($namaBarang1);
		$pembelianBarang2 = $kueri->getJumlahDiFaktur($namaBarang2);

		// insert ke dalam tabel itemset_satu.
		// yang dimasukkan = namabarang1, namabarang2, jumlahbarang1,
		// jumlahbarang2.
		$kueri->insertItemSetSatu($arrayHasilPermutasi[$i][0],
								  $arrayHasilPermutasi[$i][1]);

		// konfidensi = jumlah kejadian pembelian dua barang di sebuah faktur
		// 				dibandingkan dengan jumlah total pembelian barang.
		// bener gitu?

		$konfidensi1 = $diFakturBareng / $pembelianBarang1;
		$konfidensi2 = $diFakturBareng / $pembelianBarang2;
		echo $konfidensi1 . " " . $konfidensi2 . "<br>";

		// update nilai konfidensi tabel itemset_satu.
		$kueri->updateKonfidensi($namaBarang1, $namaBarang2,
								 $konfidensi1, $konfidensi2);
		echo "insert ke " . $i . "<br>";
	}
	echo "selesai.";
} else {
	echo "belum ada judul.";
}

?>