<?php

	Class CekGroupModul
	{
		
		function getData($aksi){
			$CI 			= & get_instance();
			if(!empty($CI->session->userdata('id_group'))){
				$query  	= $CI->db->query("SELECT `id_group` FROM modul WHERE nm_seo = '".$aksi."'");
				$sambel		= $query->result_array();
				return explode(".",$sambel[0]['id_group']);
			}
		}

		
		function SesongUser($aksi){
			$CI 			= & get_instance();
			if($aksi == "id_pengguna"){
				return $CI->session->userdata('id_pengguna');
			}else if($aksi == "id_group"){
				return $CI->session->userdata('id_group');
			}
		}
	}
	
	function cekakses($data){
		$firex 		= new CekGroupModul();
		$gendeng 	= $firex->getData($data);
		return $gendeng;
	}
	
	function sesuser($data){
		$firex 		= new CekGroupModul();
		$gendeng 	= $firex->SesongUser($data);
		return $gendeng;
	}

	
	
?>
