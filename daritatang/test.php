
<?php
/*
$numbers = range(1, 20);
shuffle($numbers);
foreach ($numbers as $number) {
    echo "$number ";
}
echo "<br>";
$panjangKomponen = 10;
$pemecah = 3;
$panjangKembalian = 0;
for ($i=0; $i < $panjangKomponen - $pemecah + 1; $i++) { 
	for ($j=$i+1; $j < $panjangKomponen - $pemecah + 2; $j++) { 
		for ($k=$j+1; $k < $panjangKomponen - $pemecah + 3; $k++) { 
			$arrayKembalian[$panjangKembalian] = array($i, $j, $k);
			$panjangKembalian++;
		}
	}
}
echo "$panjangKembalian<br>";
for ($i=0; $i < $panjangKembalian; $i++) { 
	for ($j=0; $j < count($arrayKembalian[$i]); $j++) { 
		print_r($arrayKembalian[$i][$j]);
		echo " ";
	}
	echo "<br>";
}
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
*/
include_once '../database/kueri.class.php';

$sambungan = new Kueri();
print_r($sambungan->getJumlahKolom("faktur", "nomor"));
?>
