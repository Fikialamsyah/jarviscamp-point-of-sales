<?php
	$id = $_GET['id'];
	$sql = $conn->query("delete from produk_kategori where id='$id'");
?>

<script type="text/javascript">
					alert("Data Berhasil di Hapus");
					window.location.href="?page=kategori_toko";
</script> 