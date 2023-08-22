<?php
	$nama_dokumen = 'PDF' . date("YmdHis");	
	require_once __DIR__ . '/vendor/autoload.php';

	$mpdf = new \Mpdf\Mpdf();
	ob_start();
	
	//$mpdf->useGraphs = true;
	$footer = '<table cellpadding=0 cellspacing=0 style="border:none;font-size:10px;" width="100%">
           <tr><td style="margin-right:-5px;border:none;" align="left"></td>
           <td style="margin-right:-5px;border:none;" align="right">
           Page: {PAGENO} / {nb}</td></tr></table>';
	$menu	= $this->uri->segment(3);
	
	if($menu == "lapsuratmasuk"){
		include "data_laporan/lap_suratmasuk.php";
		$posisi = "A4-P";
	}else if($menu == "lapsuratkeluar"){
		include "data_laporan/lap_suratkeluar.php";
		$posisi = "A4-P";
	}else if($menu == "lapdisposisi"){
		include "data_laporan/lap_disposisi.php";
		$posisi = "A4-P";
	}
	
	else{
		echo "Tidak ada data untuk dicetak.";
		$posisi = "A4-P";
	}

	$html = ob_get_contents();
	ob_end_clean();
	//$mpdf = new mPDF('utf-8', $posisi, 9, 'arial');
	//$mpdf = new \Mpdf\Mpdf('utf-8', $posisi, 9, 'arial');
	$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => $posisi]);
	$mpdf->setHTMLHeader($header);
	$mpdf->setHTMLFooter($footer);
	$mpdf->WriteHTML($html);
	//$mpdf->debug = true;
	$mpdf->Output($nama_dokumen . ".pdf", 'I');
	exit;

?>
