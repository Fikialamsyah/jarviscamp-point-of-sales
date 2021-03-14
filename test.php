<?php 
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); 
require("koneksi.php");

$a = "JARVIS-7380710704"
$b = "2021-03-14";
$c = "BIS123";
$d = "1";
$e = "10";
$f = "1000";
$g = "9000";
$nama = "colay";

$sql = $myPDO->prepare("insert into penjualans (id, kode_penjualan, tgl_penjualan, kode_produk, jumlah, diskon, potongan, total) VALUES (default, '$a', '$b', '$c', '$d', '$e', '$f', '$g')");

$sql = $myPDO->prepare("insert into produk_kategori (id, nama) values ('', '$nama')");

$sql->execute();

// $sql = $myPDO->prepare("insert into produk (id, nama, harga_jual, deskripsi, stok, produk_kategori_id, kode_produk, harga_beli) values (default, '$nama', '$hargaJual', '$deskripsi', '$stok', '$kategori', '$kode', '$hargaBeli')");

?>
