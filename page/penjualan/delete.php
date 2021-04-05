<?php 
	$kode = $_GET['kodepj'];
	$id = $_GET['id'];

	$ambil = $myPDO->prepare("SELECT kode_produk, jumlah FROM penjualan WHERE id = '$id' ");
	$ambil->execute();
	while($row = $ambil->fetch(PDO::FETCH_ASSOC)) {
		$kode_produk = $row["kode_produk"];
		$jumlah = $row["jumlah"];
	}

	$tambah = $myPDO->prepare("UPDATE produk SET stok = $jumlah + stok WHERE kode_produk = '$kode_produk' ");
	$tambah->execute();

	$sql = $myPDO->prepare("DELETE FROM penjualan WHERE id = '$id' ");
	$sql->execute();
 ?>

 <script type="text/javascript">
	alert("Data Berhasil di Hapus");
	window.location.href="?page=penjualan&kodepj=<?php echo $kode;?>";
</script> 