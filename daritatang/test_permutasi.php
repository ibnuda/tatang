<?php
include_once '../database/permutasi.class.php';
$permutasi = new Permutasi();
$daftarBarang = array("ayam", "babi", "cacing", "duku", "elang", "fuakh", "gajah", "ikan", "jaran");
//$daftarBarang = array();
$hasilnya = $permutasi->kembalikan($daftarBarang, 3);
for ($i=0; $i < count($hasilnya); $i++) { 
	for ($j=0; $j < count($hasilnya[$i]); $j++) { 
		print_r($hasilnya[$i][$j]);
		echo "\t\t";
	}
	echo "<br>";
}
?>