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
	$anubanget = $ku->cari3Barang($sheeit[$i][0][0], $sheeit[$i][1][0], $sheeit[$i][2][0]);
	echo $sheeit[$i][0][0] . " " . $sheeit[$i][1][0] . " " .  $sheeit[$i][2][0] . "<br>";
	//print_r($anubanget);
	for ($j=0; $j < count($anubanget); $j++) { 
		echo "no faktur = " . $anubanget[$j][0] . "<br>";
	}
	echo "jumlah yang sama = " . count($anubanget) . "<br>";
	echo "<br>";
}

?>