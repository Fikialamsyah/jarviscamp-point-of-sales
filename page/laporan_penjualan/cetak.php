<?php 
  $kode_penjualan = $_POST["kode_penjualan"];
  include '../../koneksi.php';
?>  
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Laporan Penjualan</title>
  </head>
  <body>
  <div class="container mt-3">
        <div class="card shadow">
            <div class="card-header">
                Invoice
                <strong><?= $kode_penjualan; ?></strong>
                <span class="float-right"> <strong>Status:</strong> Sukses</span>
            </div>
            <div class="card-body">
            	<center><h1>Laporan Penjualan Barang</h1></center>
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Kode Produk</th>
                                <th>Jumlah</th>
                                <th class="right">Diskon</th>
                                <th class="center">Potongan</th>
                                <th class="right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                          $no = 1;
                          $sql = $myPDO->prepare("SELECT kode_produk, jumlah, diskon, potongan, total FROM penjualan WHERE kode_penjualan = '$kode_penjualan' ");
                          $sql->execute();
                          while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <tr>
                                <td class="center"><?= $no++ ?></td>
                                <td class="left strong"><?= $row['kode_produk'] ?></td>
                                <td class="left"><?= $row['jumlah'] ?></td>
                                <td class="right"><?= $row['diskon'] ?></td>
                                <td class="center"><?= "Rp. ".number_format($row['potongan']) ?></td>
                                <td class="right"><?= "Rp. ".number_format($row['total']) ?></td>
                            </tr>
                        <?php 
                          }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">
                    </div>
                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                <?php 
                                  $sql = $myPDO->prepare("SELECT * FROM total_bayar WHERE kode_penjualan = '$kode_penjualan' ");
                                  $sql->execute();
                                  while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                <tr>
                                    <td class="left">
                                        <strong>Subtotal</strong>
                                    </td>
                                    <td class="right"><?= $row['sub_total']; ?></td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Diskon</strong>
                                    </td>
                                    <td class="right"><?= $row['diskon']; ?></td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="right">
                                        <strong><?= $row['total']; ?></strong>
                                    </td>
                                </tr>
                                <?php 
                                    }
                                 ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script>
    window.print();
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>


