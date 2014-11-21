select * from (
    select nomor, barang from faktur where barang = "gajah"
) as shit where nomor = (
    select nomor from faktur where barang = "felem"
);

;select faktur.nomor as no1, faktur.barang as ba1, faktur.nomor as no2, faktur.barang as ba2, faktur.nomor as no3, faktur.barang as ba3 from faktur where ba1 = "gajah" and ba2 = "felem" and ba3 = "burung";