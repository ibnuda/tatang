<?php

include_once '../database/kueri.class.php';

$sambungan = new Kueri();

//$sambungan->getJumlahBaris("faktur", "barang");
print_r($sambungan->getJumlahJenis("faktur", "barang"));
/*
$kimbing = $sambungan->getJumlahJenis("faktur", "barang");
for ($i=0; $i < count($kimbing); $i++) { 
	for ($j=0; $j < count($kimbing[$i]); $j++) { 
		echo $kimbing[$i][$j] . " ";
	}
	echo "<br>";
}

?>