<?php

/**
* permutasi
* dari stackoverflow.
*/
class Permutasi
{
	
	/*
	 * $daftarBarang = daftar barang yang melebihi batas support.
	 * 				   didapat dari hasil kueri di kelas kueri.
	 * $komponenPermutasi = bisa dua, bisa tiga. sesuai permintaan.
	 * 
	 * nilai return = array(array($barang1,$barang2)) atau
	 *				  array(array($barang1,$barang2,$barang3))
	 */
	function kembalikan($daftarBarang, $pemecah)
	{
		$jenisBarang = count($daftarBarang);
		if ($jenisBarang > 0) {
			$arrayPermutasi = $this->hasilPermutasi($jenisBarang, $pemecah);
			return $this->gabungHasil($daftarBarang, $arrayPermutasi);
		} else {
			exit;
		}
	}

	/*
	 * $panjangKomponen = jumlah jenis barang. misal (a,b,c,d,e,f,g) panjangnya = 7.
	 * $pemecah = bisa dua atau tiga. sesuai permintaan hari selasa, 2014-11-04 17:10.
	 * nilai return = array(arrayKombinasi[i][j]) atau array(arrayKombinasi[i][j][k])
	 */
	function hasilPermutasi($panjangKomponen, $pemecah)
	{
		// jika jenis barang lebih sedikit dari pemintaan, maka proses berhenti.
		if ($panjangKomponen < $pemecah) {
			exit;
		} else {

			/* 
			 * membuat array sebanyak pemecah.
			 * jika pemecah == 2, maka $arrayKomponen = array(0,1).
			 * jika pemecah == 3, maka $arrayKomponen = array(0,1,2).
			 * karena permutasi(2 jenis dari 2 komponen  atau 3 jenis dari 3 komponen) hanya ada satu.
			 * yaitu array(0,1) dan array(0,1,2).
			 */
			for ($elemen=0; $elemen < $pemecah; $elemen++) { 
				$arrayKomponen[$elemen] = $elemen;
			}
			if ($panjangKomponen == $pemecah){
				// hasil array(array(0,1)) atau array(array(0,1,2))
				return array($arrayKomponen);
			} else {
				$panjangKembalian = 0;
				if ($pemecah == 2) {
					for ($i=0; $i < $panjangKomponen - $pemecah + 1; $i++) { 
						for ($j=$i+1; $j < $panjangKomponen - $pemecah + 2; $j++) { 
							/* isi $arrayKembalian => array(array(0,1), array(0,2), array(0,3), ...
							 *   					  		array(1,2), array(1,3), array(1,4), ...
							 *								..., array(n-1,n));
							 */
							$arrayKembalian[$panjangKembalian] = array($i, $j);
							$panjangKembalian++;
						}
					}
				} else {
					for ($i=0; $i < $panjangKomponen - $pemecah + 1; $i++) { 
						for ($j=$i+1; $j < $panjangKomponen - $pemecah + 2; $j++) { 
							for ($k=$j+1; $k < $panjangKomponen - $pemecah + 3; $k++) { 
							/* isi $arrayKembalian => array(array(0,1,2), array(0,1,3), array(0,1,4), ...
							 *   					  		array(1,2,3), array(1,2,4), array(1,2,5), ...
							 *								..., array(n-2,n-1,n));
							 */
								$arrayKembalian[$panjangKembalian] = array($i, $j, $k);
								$panjangKembalian++;
							}
						}
					}
				}
				return $arrayKembalian;
			}
		}
		
	}

	/*
	 * $daftarBarang = array barang barang.
	 * $arrayPermutasi = array hasil $komponenPermutasi($panjang, $pemecah).
	 * nilai return = 
	 */
	function gabungHasil($daftarBarang, $arrayPermutasi)
	{
		for ($i=0; $i < count($arrayPermutasi); $i++) { 
			$daftar = 0;
			$arraySubPermutasi[0] = "harusnya ini hilang";
			for ($j=0; $j < count($arrayPermutasi[0]); $j++) { 
				$arraySubPermutasi[$j] = $daftarBarang[$arrayPermutasi[$i][$j]];
				$daftar++;
			}
			$arrayKembalian[$i] = $arraySubPermutasi;
		}
		return $arrayKembalian;
	}
}