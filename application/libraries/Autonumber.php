<?php
	Class Autonumber{
			
	}


	function autopegawai(){
		$ci = & get_instance();
		
		date_default_timezone_set('Asia/Jakarta');
		$tglauto			= date("ymd");
		
		$sdata 				= $ci->db->query("SELECT MAX(RIGHT(no_pegawai, 4)) as max_id FROM pegawai WHERE LEFT(no_pegawai,6) = '".$tglauto."'");
		$hdata				= $sdata->num_rows();
		if ($hdata > 0) {
			$ddata			= $sdata->result_array();
			$id_max_data	= $ddata[0]['max_id'];
			$sort_data 		= (int) substr($id_max_data, 0, 4);
			$sort_data++;
			$new_data 		= $tglauto. sprintf("%04s", $sort_data);
		} else {
			$new_data		= $tglauto ."0001";
		}
		return $new_data;
	}

	function autosmasuk(){
		$ci = & get_instance();
		
		date_default_timezone_set('Asia/Jakarta');
		$tglauto			= date("ymd");
		
		$sdata 				= $ci->db->query("SELECT MAX(RIGHT(nosmasuk, 4)) as max_id FROM suratmasuk WHERE LEFT(nosmasuk,6) = '".$tglauto."'");
		$hdata				= $sdata->num_rows();
		if ($hdata > 0) {
			$ddata			= $sdata->result_array();
			$id_max_data	= $ddata[0]['max_id'];
			$sort_data 		= (int) substr((string)$id_max_data, 0, 4);
			$sort_data++;
			$new_data 		= $tglauto .".SM.". sprintf("%04s", $sort_data);
		} else {
			$new_data		= $tglauto .".SM.0001";
		}
		return $new_data;
	}


	function autoskeluar(){
		$ci = & get_instance();
		
		date_default_timezone_set('Asia/Jakarta');
		$tglauto			= date("ymd");
		
		$sdata 				= $ci->db->query("SELECT MAX(RIGHT(noskeluar, 4)) as max_id FROM suratkeluar WHERE LEFT(noskeluar,6) = '".$tglauto."'");
		$hdata				= $sdata->num_rows();
		if ($hdata > 0) {
			$ddata			= $sdata->result_array();
			$id_max_data	= $ddata[0]['max_id'];
			$sort_data 		= (int) substr($id_max_data, 0, 4);
			$sort_data++;
			$new_data 		= $tglauto .".SK.". sprintf("%04s", $sort_data);
		} else {
			$new_data		= $tglauto .".SK.0001";
		}
		return $new_data;
	}

?>
