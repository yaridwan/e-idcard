<?php
	Class Notifikasi{
			
	}

    
	function notifsurat($jenis){
        $ci = & get_instance();
		$jumsmasuk = $ci->db->get_where("disposisi", array("tujuan" => sesuser("id_user"), "read" => "no", "jenis" => "smasuk"))->num_rows();
		$jumskeluar = $ci->db->get_where("disposisi", array("tujuan" => sesuser("id_user"), "read" => "no", "jenis" => "skeluar"))->num_rows();
        $jumnotif = $jumsmasuk + $jumskeluar;
        if($jenis == "all"){
            // Semua surat
            if($jumnotif > 0){
                return 'bg-danger';
            }else{
                return "";
            }
        }else if($jenis == "smasuk"){
            // Surat Masuk
            if($jumsmasuk > 0){
                return '<span class="badge badge-danger badge-pill float-right">'.$jumsmasuk.'</span>';
            }else{
                return "";
            }
        }else if($jenis == "skeluar"){
            // Surat Keluar
            if($jumskeluar > 0){
                return '<span class="badge badge-danger badge-pill float-right">'.$jumskeluar.'</span>';
            }else{
                return "";
            }
        }
	}


?>
