<?php 
	
	function kode_penjualan($length) {
		$data = "1234567890";
		$string = 'JARVIS-';

		for ($i = 0; $i < $length; $i++){
			$pos = rand(0, strlen($data)-1);
			$string .= $data{$pos};
		}

		return $string;
	}

	$kode = kode_penjualan(10);
 ?>