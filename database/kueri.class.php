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
		// kueri.
		$kueri = 'select '. $namaKolom .', count(*) as jumlah ' . 
				 'from ' . $namaTabel . ' group by ' . $namaKolom ;
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
	 * $namaBarang = nama barang yang akan di anu kan.
	 * nilai return = integer.
	 */
	function getJumlahDiFaktur($namaBarang)
	{
		// kueri.
		$kueri = 'select count(*) from (' . 
				 '	select distinct(nomor) from (' .
				 '		select * from faktur where barang="' . $namaBarang . '"' .
				 '	) as tab' .
				 ') as fak';
		$hasil = $this->mysqli->query($kueri);
		$baris = $hasil->fetch_array();
		$hasil->free();
		return $baris[0];
	}

	/*
	 * $barang1 = nama barang jenis pertama.
	 * $barang2 = nama barang jenis kedua.
	 * $jumlah1 = jumlah barang dari jenis pertama.
	 * $jumlah2 = jumlah barang dari jenis kedua.
	 */
	function insertItemSetSatu($arrayBarang1, $arrayBarang2)
	{
		$fakturDariBarangA = $this->getJumlahDiFaktur($arrayBarang1[0]);
		$kueri = 'insert into itemset_satu(barang1, barang2, jumlah1, jumlah2)
				  values(
				  	"' . $arrayBarang1[0] . '", "' . $arrayBarang2[0] . '",
				  	"' . $arrayBarang1[1] . '", "' . $arrayBarang2[1] . '"
				  )';
		$this->mysqli->query($kueri);
	}

	/*
	 * $arrayPermutasi = array
	 */
	function insertPermItemSetSatu($arrayPermutasi, $arrayBarang)
	{
		# code...
	}

	/*
	 * $barang1 = barang pertama.
	 * $barang2 = barang kedua.
	 * nilai return = jumlah kejadian dimana pembelian barang satu disertai pembelian barang dua.
	 */
	function cariYangSama($barang1, $barang2)
	{
		// kueri untuk mencari kejadian pembelian barang1 dan barang2.
		$kueri = 'select distinct * from faktur where barang="' . $barang1 . 
				 '" or barang="' . $barang2 . '"';
		$hasil = $this->mysqli->query($kueri);
		$baris = $hasil->fetch_array();
		// $itungan = panjang arraySementara.
		$itungan = 0;

		$arraySementara = array();

		// memasukkan hasil ke dalam array. biar keren aja.
		while ($baris = $hasil->fetch_array()) {
			$data = array($baris[0], $baris[1]);
			$arraySementara[$itungan] = $data;
			$itungan++;
		}

		// ketemunya nilai yang sama.
		$yangSama = 0;
		for ($i=1; $i < $itungan - 1; $i++) { 

			// jika bagian "nomor" pada array tidak sama dengan 
			// array yang bagian sebelum dan sesudahnya,
			// bagian array tadi dihapus.
			if (($arraySementara[$i][0] != $arraySementara[$i+1][0]) &&
				($arraySementara[$i][0] != $arraySementara[$i-1][0])) {
				$arraySementara[$i] = null;
			} else {
				$yangSama++;
			} 			
		}
		// disini, $arraySementara hanya berisi nomor yang faktur yang sama.

		// bisa dihapus, sepertinya. ndak ngerti juga.
		if ($arraySementara[count($arraySementara) - 1][0] != 
			$arraySementara[count($arraySementara) - 2][0]) {

			$arraySementara[count($arraySementara) - 2] = null;
			$arraySementara[count($arraySementara) - 1] = null;
		}

		if ($arraySementara[0][0] != $arraySementara[1][0]) {
			$arraySementara[0] = null;
		}
		$hasil->free();
		// $yangSama = berupa genap.
		// yaitu nilai faktur berisi barang1 dan barang2 dikali 2.
		return $yangSama / 2;
		//return $arraySementara;
	}

	/*
	 * $barang1 = nama barang 1.
	 * $barang2 = nama barang 2.
	 * $konf1 = nilai konfidensi barang 2 terhadap barang 1. (a->b)
	 * $konf2 = nilai konfidensi barang 1 terhadap barang 2. (b->a)
	 */
	function updateKonfidensi($barang1, $barang2, $konf1, $konf2)
	{
		$kueri = 'update itemset_satu set ' .
				 'konf_b1_b2="' . $konf1 . '", ' .
				 'konf_b2_b1="' . $konf2 . '" ' .
				 'where barang1="' . $barang1 . '" '. 
				 'and '.
				 'barang2="' . $barang2 . '"';
		//echo $kueri;
		$this->mysqli->query($kueri);
	}
	/*
	function faaak($barang1, $barang2)
	{
		$kueri = 'select distinct * from faktur where barang="' . $barang1 . '" or barang="' . $barang2 . '"';
		$hasil = $this->mysqli->query($kueri);
		$baris = $hasil->fetch_array();
		$itungan = 0;
		$arraySementara = array();
		while ($baris = $hasil->fetch_array()) {
			$data = array($baris[0], $baris[1]);
			$arraySementara[$itungan] = $data;
			$itungan++;
		}
		$yangSama = 0;
		for ($i=1; $i < $itungan - 1; $i++) { 
			if (($arraySementara[$i][0] != $arraySementara[$i+1][0]) &&
				($arraySementara[$i][0] != $arraySementara[$i-1][0])) {
				$arraySementara[$i] = null;
			} else {
				$yangSama++;
			} 			
		}
		if ($arraySementara[count($arraySementara) - 1][0] != $arraySementara[count($arraySementara) - 2][0]) {
			$arraySementara[count($arraySementara) - 2] = null;
			$arraySementara[count($arraySementara) - 1] = null;
		}
		if ($arraySementara[0][0] != $arraySementara[1][0]) {
			$arraySementara[0] = null;
		}
		$hasil->free();
		//return $baris;
		//return $yangSama / 2;
		echo $yangSama . "<br>";
		return $arraySementara;
	}
	*/
}