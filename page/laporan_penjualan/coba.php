<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); 
require_once __DIR__ . '/../../vendor/autoload.php';
require '../../koneksi.php';

$kode_penjualan = $_POST["kode_penjualan"];

$produk = $myPDO->prepare("SELECT kode_penjualan, nama, jumlah, diskon, potongan, total FROM penjualan JOIN produk ON penjualan.kode_produk = produk.kode_produk WHERE kode_penjualan = '$kode_penjualan' ");
$produk->execute();

$total = $myPDO->prepare("SELECT * FROM total_bayar WHERE kode_penjualan = '$kode_penjualan' ");
$total->execute();


$stylesheet = file_get_contents('style.css');
$mpdf = new \Mpdf\Mpdf();
$html = '
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" media="all" />
</head>

<body>
    <main>
        <h1 class="clearfix"> INVOICE </h1>
        <table>
            <thead>
                <tr>
                    <th class="service">NAMA</th>
                    <th class="desc">JUMLAH</th>
                    <th>DISKON</th>
                    <th>POTONGAN</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>';

            	while ($row = $produk->fetch(PDO::FETCH_ASSOC)) {

            $html .= '		
                <tr>
                    <td class="service">'. $row["nama"] .'</td>
                    <td class="desc">'. $row["jumlah"] .'</td>
                    <td class="unit">'. $row["diskon"] .'</td>
                    <td class="qty">'. $row["potongan"] .'</td>
                    <td class="total">'. $row["total"] .'</td>
                </tr>';

            	}

            	while ($tampil = $total->fetch(PDO::FETCH_ASSOC)) {

            	$html .='
                <tr>
                    <td colspan="4" class="sub">SUBTOTAL</td>
                    <td class="sub total">'. $tampil["sub_total"] .'</td>
                </tr>
                <tr>
                    <td colspan="4">DISKON TOTAL</td>
                    <td class="total">'. $tampil["diskon"] .'</td>
                </tr>
                <tr>
                    <td colspan="4" class="grand total">GRAND TOTAL</td>
                    <td class="grand total">'. $tampil["total"] .'</td>
                </tr>';

            	}

            	$html .= '
            </tbody>
        </table>
    </main>
</body>

</html>
';

$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($html, 2);
$mpdf->Output('invoice.pdf', \Mpdf\Output\Destination::INLINE);

?>