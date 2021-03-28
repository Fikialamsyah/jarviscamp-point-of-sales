<?php 
	
	function kode_penjualan($length) {
		$data = "12345";
		$string = 'JARVIS-';

		for ($i = 0; $i < $length; $i++){
			$pos = rand(0, strlen($data)-1);
			$string .= $data{$pos};
		}

		return $string;
	}

	$kode = kode_penjualan(5);
 ?>