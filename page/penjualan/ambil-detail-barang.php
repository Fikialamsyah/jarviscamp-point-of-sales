<?php
header('Content-Type: application/json');
require("../../koneksi.php");

$kode_barcode = $_GET['kode_barcode'];

$sql = $myPDO->prepare("select * from produk where kode_produk='$kode_barcode'");
$sql->execute();

$tampil=$sql->fetch(PDO::FETCH_ASSOC);

echo json_encode($tampil);

?>