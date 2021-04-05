<?php 

  try {
  $myPDO = new PDO("pgsql:host=localhost;dbname=jarvis", "postgres", "12345");
    $myPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  }
  catch(PDOException $error) {
    echo 'Connection error: ' .$error->getMessage();
  }

  if (isset($_POST["kode"])) {
    $kode = $_POST['kode'];
    $sub_total = $_POST['satu'];
    $diskon_akhir = $_POST['dua'];
    $total_akhir = $_POST['tiga'];

    $tambah = $myPDO->prepare("INSERT INTO total_bayar (id, kode_penjualan, sub_total, diskon, total) VALUES (default, '$kode', '$sub_total', '$diskon_akhir', '$total_akhir')");
                        
    try {

    $tambah->execute();
      echo "succeess";
    }
    catch(PDOException $e) {
      echo $e->getMessage();
    }
  }
?>