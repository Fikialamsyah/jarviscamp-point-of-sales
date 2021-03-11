<?php
	$id = $_GET['id'];
	// $sql = $conn->query("delete from produk where id='$id'");
	$sql = $myPDO->prepare("DELETE FROM produk WHERE id = '$id' ");
	try {
		$sql->execute();
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}	
?>

<script type="text/javascript">
					alert("Data Berhasil di Hapus");
					window.location.href="?page=barang";
</script> 