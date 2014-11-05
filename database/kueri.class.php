<?php

/**
* Kueri
*/

include_once '../conf/konfigurasi.php';
include_once '../conf/error_handler.php';
class Kueri
{
	
	private $mysqli;

	/*
	 * tiap instansiasi kelas ini, akan membuat sambungan ke mysql
	 * melalui ekstensi mysqli.
	 */
	function __construct()
	{
		$this->mysqli = new mysqli(host, user, pass, debe);
	}
	function __destruct()
	{
		$this->mysqli->close();
	}

	/*
	 * $namaTabel = tabel yang akan diperiksa..
	 * $namaKolom = kolom dari tabel diatas. 
	 * nilai kembalian = jumlah kolom (distinct).
	 */
	function getJumlahBaris($namaTabel, $namaKolom)
	{
		// kueri.
		$kueri = 'select count(' . $namaKolom . ') ' .
				 'from (' .
				 	'select distinct (' . $namaKolom . ') from ' . $namaTabel . 
				 ') as jumlah';
		// eksekusi kueri.
		$hasil = $this->mysqli->query($kueri);
		// mengambil nilai.
		$baris = $hasil->fetch_array(MYSQLI_NUM);
		// membebaskan memori.
		$hasil->free();
		// kembalian.
		return $baris[0];
	}

	/*
	 * $namaTabel = idem.
	 * $namaKolom = idem.
	 * nilai kembalian = array(array(barang1, jumlah1),
	 * 						   array(barang2, jumlah2),
	 * 						   ...,
	 * 						   array(barangn, jumlahn))
	 */
	function getJumlahJenis($namaTabel, $namaKolom)
	{
		$kueri = 'select '. $namaKolom .', count(*) as jumlah from ' . $namaTabel . ' group ' .
				 'by ' . $namaKolom ;
		//echo $kueri;
		$hasil = $this->mysqli->query($kueri);
		//$baris = $hasil->fetch_array();
		$arrayKembalian = array();
		// fuck, ga ngerti kok harus gini.
		// kalau nggak gini, nggak bisa. -_-
		$itungan = 0;
		while ($baris = $hasil->fetch_array()) {
			$data = array($baris[0], $baris[1]);
			$arrayKembalian[$itungan] = $data;
			$itungan++;
		}
		return $arrayKembalian;
	}

	/*
	 * $barang1 = nama barang jenis pertama.
	 * $barang2 = nama barang jenis kedua.
	 * $jumlah1 = jumlah barang dari jenis pertama.
	 * $jumlah2 = jumlah barang dari jenis kedua.
	 */
	function insertItemSetSatu($arrayBarang1, $arrayBarang2)
	{
		$kueri = 'insert into itemset_satu values ("' . $arrayBarang1[0] . '", "' . 
				  $arrayBarang2[0] . '", ' . $arrayBarang1[1] . ', ' . $arrayBarang2[1] . ')';
		$this->mysqli->query($kueri);
	}

	/*
	 * $arrayPermutasi = array
	 */
	function insertPermItemSetSatu($arrayPermutasi, $arrayBarang)
	{
		# code...
	}
}