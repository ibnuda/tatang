<?php
include_once '../database/kueri.class.php';

$arraySatu = array('barangsatu', 10);
$arrayDua = array('barangdua', 10);

$sambungan = new Kueri();

$sambungan->insertItemSetSatu($arraySatu, $arrayDua);
?>