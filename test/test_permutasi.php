<?php

include_once '../database/permutasi.class.php';

$panjang = 10;
$pemecah = 3;

$perm = new Permutasi();

print_r($perm->hasilPermutasi($panjang, $pemecah));

?>