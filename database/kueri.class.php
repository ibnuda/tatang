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
	 * nilai kembalian = array('barang_1' => jumlah_1,
	 *						   'barang_2' => jumlah_2,
	 *						   ...,
	 * 						   'barang_n' => jumlah_n)
	 */
	function getJumlahJenis($namaTabel, $namaKolom)
	{
		$kueri = 'select '. $namaKolom .', count(*) as jumlah from ' . $namaTabel . ' group ' .
				 'by ' . $namaKolom ;
		//echo $kueri;
		$hasil = $this->mysqli->query($kueri);
		//$baris = $hasil->fetch_array();
		$arrayKembalian = array();
		while ($baris = $hasil->fetch_array()) {
			$data = array($baris[0] => $baris[1]);
			$arrayKembalian = array_merge($arrayKembalian, $data);
		}
		return $arrayKembalian;
	}
}