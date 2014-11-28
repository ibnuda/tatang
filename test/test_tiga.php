<?php

include_once '../database/kueri.class.php';
include_once '../database/permutasi.class.php';

$ku = new Kueri();
$pe = new Permutasi();

$shit = $ku->getJumlahJenis("faktur", "barang");

$sheeit = $pe->kembalikan($shit, 3);

//print_r($sheeit);
//print_r($ku->cari3Barang("burung", "felem", "gajah"));

for ($i=0; $i < count($sheeit); $i++) { 
	$barang1 = $sheeit[$i][0][0];
	$barang2 = $sheeit[$i][1][0];
	$barang3 = $sheeit[$i][2][0];
	$anubanget = $ku->cari3Barang($barang1, $barang2, $barang3);

	// count($barangX) > 10
	// 10 -> minimum support. bisa diganti sesuai.
	if ((count($barang1) > 10) && (count($barang2) > 10) && (count($barang3) > 10)) {
		echo $barang1 . " " . $barang2 . " " . $barang3 . "<br>";
		//print_r($anubanget);
		for ($j=0; $j < count($anubanget); $j++) { 
			echo "no faktur = " . $anubanget[$j][0] . "<br>";
		}
		//echo "jumlah yang sama = " . count($anubanget) . "<br>";
		/*
		 * nilai konfidensi pada (a,b) -> c
		 * adalah jumlah kejadian pembelian (a, b) atau (b, a)
		 * dibandingkan dengan kejadian pembelian (a, b, c)
		 * penyamaan (a, b) dan (b, a) karena dianggap satu paket.
		 */

		$jBarang1 = $ku->getJumlahBaris($barang1);
		$jBarang2 = $ku->getJumlahBaris($barang2);
		$jBarang3 = $ku->getJumlahBaris($barang3);

		if (count($anubanget) > 0) {
			echo "(barang1, barang2) -> barang3. <br>";
			$konf12_3 = (count($anubanget) / $ku->cariYangSama($barang1, $barang2));
			$konf13_2 = (count($anubanget) / $ku->cariYangSama($barang1, $barang3));
			$konf23_1 = (count($anubanget) / $ku->cariYangSama($barang3, $barang2));
			echo "(" . $barang1 . ", ". $barang2 . ") -> " . $barang3 . " = " . $konf12_3 .  "<br>";
			echo "(" . $barang2 . ", ". $barang3 . ") -> " . $barang1 . " = " . $konf12_3 .  "<br>";
			echo "(" . $barang3 . ", ". $barang1 . ") -> " . $barang2 . " = " . $konf12_3 .  "<br>";
			$ku->insertItemSetDua(array($barang1, $jBarang1, $konf12_3),
								  array($barang2, $jBarang2, $konf13_2),
								  array($barang3, $jBarang3, $konf23_1));
			echo "<br>";
		} else {
			echo "kombinasi " . $barang1 . ", " . $barang2 . ", dan " . $barang3 . " adalah 0<br><br>";
		}
	} 	
	
}
	
?>