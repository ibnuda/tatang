<?php

include_once '../database/kueri.class.php';

$barang1 = "wawan";
$barang2 = "zebra";
$kambing = new Kueri();
print_r($kambing->cariYangSama($barang1, $barang2));
print_r($kambing->faaak($barang1, $barang2));
