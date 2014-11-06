<?php

include_once '../database/kueri.class.php';

$kambing = new Kueri();
$diFakturBareng = $kambing->cariYangSama("aku", "hutan");
echo "yang sama : " . $diFakturBareng . "<br>";
$pembelianAku = $kambing->getJumlahDiFaktur("aku");
$pembelianHutan = $kambing->getJumlahDiFaktur("hutan");
echo "jumlah pembelian barang 'aku' : " . $pembelianAku . "<br>";
echo "jumlah pembelian barang 'hutan' : " . $pembelianHutan . "<br>";
echo "konfidensi 'aku' -> 'hutan' :" . ($diFakturBareng * 100 / $pembelianAku) . "%<br>";
echo "konfidensi 'hutan' -> 'aku' :" . ($diFakturBareng * 100 / $pembelianHutan) . "%<br>";
//print_r($kambing->getJumlahJenis("faktur", "barang"));