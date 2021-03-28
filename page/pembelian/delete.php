<?php 
	$kode = $_GET['kodepb'];
	$id = $_GET['id'];
	$sql = $myPDO->prepare("DELETE FROM pembelian WHERE id = '$id' ");
	$sql->execute();

 ?>

 <script type="text/javascript">
	alert("Data Berhasil di Hapus");
	window.location.href="?page=pembelian&kodepb=<?php echo $kode;?>";
</script> 