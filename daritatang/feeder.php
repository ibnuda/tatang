<?php

// konfigurasi database.
include_once '../conf/konfigurasi.php';

// array barang.
$arrayBarang = array("aku", "burung", "cecak", "duku", "embek", "felem", "gajah", "hutan", "iwak", "jerapah",
					 "kadal", "lemper", "macan", "nenen", "omah", "pepaya", "qeqeqeq", "rambutan", "susi", "telo");

// no faktur di mulai dari nol.
$no_faktur = 1;

$i = 0;
// perulangan 10000 kali.
while ($i < 1000) {

	// instansiasi objek mysqli.
	$mmysqli = new mysqli(host, user, pass, debe);

	// jenis barang yang dibeli.
	$batas = rand(1, 8);

	//perulangan dengan jenis barang yang dibeli.
	for ($j=0; $j < $batas; $j++) { 
		// random aja. biar seru.
		$barang = $arrayBarang[rand(0, 19)];
		// kueri insert.
		$kueri = 'insert into faktur values (' . $no_faktur . ', "'. $barang . '")';
		// eksekusi kueri.
		$mmysqli->query($kueri);
		//penambahan iterasi perulangan "while".
		$i++;
	}
	// penambahan no faktur.
	// nutup mysqli.
	$mmysqli->close();$no_faktur++;
}
