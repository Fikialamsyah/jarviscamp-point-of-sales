<?php
	$id = $_GET['id'];
	$sql = $myPDO->prepare("delete from produk_kategori where id='$id'");
	try {
		$sql->execute();
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}	
?>

<script type="text/javascript">
					alert("Data Berhasil di Hapus");
					window.location.href="?page=kategori_toko";
</script> 