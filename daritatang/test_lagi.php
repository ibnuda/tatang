<?php

include_once '../database/kueri.class.php';

$barang1 = "";
$barang2 = "zebra";
$kambing = new Kueri();
$diFakturBareng = $kambing->cariYangSama($barang1, $barang2);
echo "yang sama : " . $diFakturBareng . "<br>";
$pembelianBarang1 = $kambing->getJumlahDiFaktur($barang1);
$pembelianBarang2 = $kambing->getJumlahDiFaktur($barang2);
echo "jumlah pembelian barang " . $barang1 . " : " . $pembelianBarang1 . "<br>";
echo "jumlah pembelian barang " . $barang2 . " : " . $pembelianBarang2 . "<br>";
echo "konfidensi " . $barang1 ." -> " . $barang2 ." : " . ($diFakturBareng * 100 / $pembelianBarang1) . "%<br>";
echo "konfidensi " . $barang2 ." -> " . $barang1 ." : " . ($diFakturBareng * 100 / $pembelianBarang2) . "%<br>";
//print_r($kambing->getJumlahJenis("faktur", "barang"));