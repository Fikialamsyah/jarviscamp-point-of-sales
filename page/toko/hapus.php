<?php
	$id = $_GET['id'];
	$sql = $conn->query("delete from toko where id='$id'");
?>

<script type="text/javascript">
					alert("Data Berhasil di Hapus");
					window.location.href="?page=toko";
</script> 