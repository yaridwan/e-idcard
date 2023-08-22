<?php
	defined('BASEPATH') or exit('No direct script access allowed');

		$gambarwonge	= base_url("berkas/smasuk/".$ddata->berkas);
    
    $ttd = $this->db->get_where("ttd", ['id_ttd' => 1])->row();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Kartu Pegawai - <?php echo identitas("judul");?></title>
	<meta name="description" content="Kartu Pegawai - <?php echo identitas("deskripsi");?>">
	<meta name="author" content="<?php echo identitas("author");?>">
	
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link rel="shortcut icon" href="<?php echo identitas("favicon");?>">
	<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<script src="<?php echo base_url();?>global/js/main/jquery.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/html2canvas.js"></script>
	
	<style>
		.sabunbatang{
			width:250px;
			border-radius:15px;
			box-shadow: rgba(0, 0, 0, 0.45) 0px 25px 20px -20px;
			position:absolute;
			left:175px;
			top:420px;
		}
		.nama_kotak{
			position:absolute;
			left:15px;
			top:860px;
			width:570px;
			height:200px;
		}
		.nama{
			font-weight:bold;
			font-size:26px;
			line-height: 1.1;
			vertical-align: bottom;
		}
        .nip{
			font-size:26px;
			line-height: 1.1;
			vertical-align: bottom;
		}
		.prodi{
			text-transform:uppercase;
			font-weight:bold;
			font-size:16px;
			position:absolute;
			left:115px;
			top:269px;
		}
		.nim{
			text-transform:uppercase;
			font-weight:bold;
			font-size:16px;
			position:absolute;
			left:493px;
			top:290px;
		}
		
		.registration_code{
			text-transform:uppercase;
			font-weight:bold;
			font-size:10px;
			position:absolute;
			left:115px;
			top:390px;
		}
		.qrcode{
			position:absolute;
			left:115px;
			top:320px;
			border:1px solid #000;
			height:69px;
		}
		.barcode{
			position:absolute;
			left:165px;
			top:320px;
			height:68px;
			border-radius:5px;
		}
		
		#ktm_depan, #ktm_belakang{
			width:624px;
		}
	</style>
</head>
<body>
	<div id="ktm_depan" class="page-content">
		<!-- <div class="registration_code">REGISTRATION CODE #<?php echo $nosmasuk;?></div>
		<div class="nim">NIM. <?php echo $ddata->nip;?></div> -->
		<div class="nama_kotak text-center">
			<div class="nama"><?php echo $ddata->nm_anggota;?></div>
			<div class="nip">NIP. <?php echo $ddata->nip;?></div>
		</div>
		<!-- <div class="prodi"><?php echo $ddata->alamat." ".$ddata->alamat;?></div> -->
		<img src="<?php echo base_url();?>assets/images/card_template/depan.jpg" style="border-radius:10px;width:100%;"/>
		<img src="<?php echo $gambarwonge;?>" class="sabunbatang">
	</div>
	
	
	
	<a href="#" id="previewKTMDepan"></a>
	<script>
		$(document).ready(function(){

			var element1 = $("#ktm_depan");
			var canvasKTMDepan;
			html2canvas(element1, {
				onrendered: function(canvas) {
					$("#previewKTMDepan").append(canvas);
					canvasKTMDepan = canvas;
					$("#ktm_depan").hide();
					//~ $("#btn-Convert-Html2Image").show();
				}
			});
			
			
			
			$("#previewKTMDepan").on("click", function() {
				var imgageData 	= canvasKTMDepan.toDataURL("image/png",1);
				var newData 	= imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
				$("#previewKTMDepan").attr("download", "Card-<?= $ddata->nosmasuk ?>-FRONT.jpg").attr("href", newData);
			}); 
			
		});
	</script>
</body>
</html>