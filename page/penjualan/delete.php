<?php 
	$kode = $_GET['kodepj'];
	$id = $_GET['id'];
	$sql = $myPDO->prepare("DELETE FROM penjualan WHERE id = '$id' ");
	$sql->execute();

 ?>

 <script type="text/javascript">
	alert("Data Berhasil di Hapus");
	window.location.href="?page=penjualan&kodepj=<?php echo $kode;?>";
</script> 