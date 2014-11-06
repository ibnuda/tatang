<?php

include "connection.php";
include "kombinasi.php";
//tentukan minimum support and confidance;
$minsup = 5;
$mincon = 0.5;
// hitung jumlah transaksi
$query=mysql_fetch_array(mysql_query("
    SELECT COUNT( FAKTUR )
    FROM (
        SELECT DISTINCT (FAKTUR) FROM Sheet1 
    ) AS jum"))or die (mysql_error());
if($query){
echo "jumlah transaksi = ".$query[0];
}
//lihat jumlah item

$query1=mysql_fetch_array(mysql_query("SELECT COUNT(NG) 
FROM (SELECT DISTINCT (Sheet1.NAMA_GOLONGAN) AS NG FROM Sheet1) AS jum "))or die (mysql_error());
if($query1){
echo "<br/> jumlah item = ".$query1[0]." <br/>";
}

//hitung jumlah tiap item

$query2=mysql_query("SELECT DISTINCT(NAMA_GOLONGAN) FROM Sheet1 ")or die (mysql_error());
$query2_1=mysql_query("SELECT DISTINCT(NAMA_GOLONGAN) FROM Sheet1 ")or die (mysql_error());

$delete = mysql_query("TRUNCATE TABLE 1itemset")or die (mysql_error());

while($tampil = mysql_fetch_array($query2)){    
$query3 = mysql_fetch_array(mysql_query('
            SELECT COUNT(NG) FROM (
                SELECT DISTINCT (FAKTUR), 
                Sheet1.NAMA_GOLONGAN AS NG FROM Sheet1 WHERE NAMA_GOLONGAN = "'.$tampil[0].'")as tot'))or die(mysql_error());

$in1 = mysql_query("insert into 1itemset (JUDUL,JUMLAH) value ('".$tampil[0]."','".$query3[0]."')");        
       // echo $tampil[0]." = ".$query3[0]." <br />";    
}                
    

//seleksi
$query_seleksi = mysql_query("SELECT JUDUL FROM 1itemset WHERE JUMLAH >=".$minsup."");
$i = 0;//untuk index array
while ($tampil_seleksi = mysql_fetch_array($query_seleksi)){
    echo $tampil_seleksi[0]."<br/>";
    //masukkan item terpilih ke array
    $myset2[$i] = "$tampil_seleksi[0]";
    $i++;

}
//kombinasi n item (2)
 
//print hasil kombinasi
//print_r($hasil_kombinasi);
//$kom = explode (" ",$hasil_kombinasi[3]);
//Echo $kom[2]." ".$kom[4];
//echo $hasil_kombinasi[0];



//ini hitung jumlah 2 item
//mangga dan anggur
$delete2 = mysql_query("TRUNCATE TABLE 2itemset")or die (mysql_error());
$hasil_kombinasi = array_combination(2, $myset2);
$count_komb = count($hasil_kombinasi);
for($i=0;$i<$count_komb;$i++){
    $kom = explode ("->",$hasil_kombinasi[$i]);
    //echo " KOMBINASI = ".$kom[1]." ";
    $a = mysql_query("SELECT DISTINCT(faktur) from sheet1 where NAMA_GOLONGAN = '".$kom[1]."'");

    $j=0;
    while ($b = mysql_fetch_array($a)){
        $a2 = mysql_num_rows(mysql_query("Select DISTINCT(faktur) from sheet1 where NAMA_GOLONGAN = '".$kom[3]."' and FAKTUR = '".$b[0]."'"));
        $j=$j+$a2;
    }    
echo "<br/>".$kom[1]." >> ".$kom[3]." = ".$j;
$in2 = mysql_query("insert into 2itemset (ITEM1,ITEM2,JUMLAH) value ('".$kom[1]."','".$kom[3]."','".$j."')");
}

//Tampilkan kombinasi dari item terpilih
/*
for($i=0;$i<5;$i++){
    $myset2[$i] = "A";

}*/
$query_seleksi2 = mysql_query("SELECT DISTINCT(ITEM1) FROM 2itemset WHERE JUMLAH >= ".$minsup."");
$query_seleksi22 = mysql_query("SELECT DISTINCT(ITEM2) FROM 2itemset WHERE JUMLAH >= ".$minsup."");
$i=0;
while ($tampil_seleksi2 = mysql_fetch_array($query_seleksi2)){
    $myset3[$i] = $tampil_seleksi2["ITEM1"];
    echo " ".$myset3[$i];
}

while ($tampil_seleksi22 = mysql_fetch_array($query_seleksi22)){
    for ($j=0;$j<count($myset3);$j++){
        if ($tampil_seleksi22['ITEM2']!=$myset3[$j]){
            echo " IKI LHO!!! -> ".$tampil_seleksi22['ITEM2'];
        }
    }
    //$myset3[$i] = $tampil_seleksi2["ITEM1"];
}




?>