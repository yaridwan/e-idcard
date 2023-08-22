<?php
defined('BASEPATH') or exit('No direct script access allowed');

if(empty(sesuser('id_pengguna'))){
	redirect("/auth/login", refresh);
}
   

$nosmasuk = $this->uri->segment(3);
$sdata = $this->db->query("SELECT a.*, b.`nm_jenissurat` ,  c.`nm_jk` FROM suratmasuk a LEFT JOIN jenissurat b ON a.`id_jenissurat` = b.`id_jenissurat` LEFT JOIN jk c ON a.`id_jk` = c.`id_jk` WHERE a.nosmasuk = '".$nosmasuk."'");
$hdata = $sdata->num_rows();
if($hdata == 0){
	redirect(base_url("suratmasuk"));
}
$ddata = $sdata->result_array();


$post = $this->input->post();
if(isset($post['disposisikan'])){
    $post_data = array(
        "nosmasuk" => $nosmasuk,
        "sumber" => $post['sumber'],
        "tujuan" => $post['tujuan'],
        "id_sifat" => $post['id_sifat'],
        "jenis" => "smasuk",
        "useradd" => sesuser("id_pengguna")
    );
        $simpan = $this->db->insert("disposisi", $post_data);
        if($simpan){
            $this->session->set_flashdata('pesan', '<div class="alert alert-success">Berhasil menambah data</div>');
        }else{
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal menambah data</div>');
        }
    
	
	redirect(base_url("suratmasuk/detail/".$nosmasuk));
}else if(isset($post['hapusindispo'])){
	$simpan = $this->db->delete("disposisi", array("id_disposisi" => $post['id_disposisi']));
	if($simpan){
		$this->session->set_flashdata('pesan', '<div class="alert alert-success">Berhasil menghapus data</div>');
	}else{
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal menghapus data</div>');
	}
	redirect(base_url("suratmasuk/detail/".$nosmasuk));
}

?>
<style>
    .custom-card {
        width: 5.5cm;
        height: 8.5cm;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?= $title ?> - <?= identitas("judul") ?></title>
    <link rel="shortcut icon" href="<?= identitas("favicon") ?>">
    <link rel="icon" href="<?= identitas("favicon") ?>" type="image/x-icon">

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?= base_url() ?>global/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url() ?>assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url() ?>assets/css/layout.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url() ?>assets/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url() ?>assets/css/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="<?= base_url() ?>global/js/main/jquery.min.js"></script>
	<script src="<?= base_url() ?>global/js/main/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url() ?>global/js/plugins/loaders/blockui.min.js"></script>
	<script src="<?= base_url() ?>global/js/plugins/ui/slinky.min.js"></script>
	<script src="<?= base_url() ?>global/js/plugins/ui/ripple.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="<?= base_url() ?>global/js/plugins/visualization/d3/d3.min.js"></script>
	<script src="<?= base_url() ?>global/js/plugins/visualization/d3/d3_tooltip.js"></script>
	<script src="<?= base_url() ?>global/js/plugins/forms/styling/switchery.min.js"></script>
	<script src="<?= base_url() ?>global/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script src="<?= base_url() ?>global/js/plugins/ui/moment/moment.min.js"></script>
	<script src="<?= base_url() ?>global/js/plugins/pickers/daterangepicker.js"></script>

	<script src="<?= base_url() ?>assets/js/app.js"></script>
	<script src="<?= base_url() ?>global/js/demo_pages/dashboard_boxed.js"></script>
	<!-- /theme JS files -->

</head>

<body>

	<?php
        $this->load->view("inc/header");
    ?>

	<div class="page-header">
		<div class="page-header-content container header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><span class="font-weight-semibold"><?= $title ?></span></h4>
				<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
			</div>

			<div class="header-elements d-none bg-transparent border-0 py-0 mb-3 mb-md-0">
				<div class="breadcrumb">
					<a href="<?= base_url("dashboard") ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
					<a href="<?= base_url("anggota") ?>" class="breadcrumb-item">Data Anggota</a>
					<span class="breadcrumb-item active"><?= $title ?></span>
				</div>
			</div>
		</div>
	</div>

	<div class="page-content container pt-0">
		<div class="content-wrapper">
		
			<div class="content">
                <!-- <a href="#" data-toggle="modal" data-target="#modalTambah" class="btn btn-primary mb-3">Tambah</a> -->
				
				 <!-- <a href="<?= base_url("anggota/tambah") ?>" class="btn btn-info mb-3"><i class='icon-print'></i> Cetak</a> -->
				<a href='".base_url("cetak/pdf/kui-penjualan/".$ddata['no_penjualan'])."' target='_blank' class='btn btn-dark'><i class='icon-printer'></i> Cetak</a>
				<hr>
			
                <div class="row">
                    <div class="col-md-6">
                        <?= $this->session->flashdata('pesan') ?>
                        
                        <div class="card card-border mb-0 h-100">
							<div class="card-header card-header-action">
								<h6 class="m-0"><?= $title ?></h6>
							</div>
                            
							<table class="table table-hover mb-0">
                                <tbody>
                                    <tr>
                                        <td>No.  Anggota</td>
                                        <th><?= $nosmasuk ?></th>
                                    </tr>
                                    <tr>
                                        <td>Nama </td>
                                        <th><?= $ddata[0]['nm_anggota'] ?></th>
                                    </tr>
                                    
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <th><?= $ddata[0]['nm_jk'] ?></th>
                                    </tr>
                                    <tr>
                                        <td>NIP</td>
                                        <th><?= $ddata[0]['nip'] ?></th>
                                    </tr>
                                    <tr>
                                        <td>Jabatan</td>
                                        <th><?= $ddata[0]['jabatan'] ?></th>
                                    </tr>
                                    <tr>
                                        <td>Jenis Status</td>
                                        <th><?= $ddata[0]['nm_jenissurat'] ?></th>
                                    </tr>
                                    <tr>
                                        <td>Gol.Darah</td>
                                        <th><?= $ddata[0]['gol_darah'] ?></th>
                                    </tr>
                                    <tr>
                                        <td>Alamat Kantor</td>
                                        <th><?= $ddata[0]['alamat'] ?></th>
                                    </tr>
                                    <tr>
                                        <td>Berkas Surat</td>
                                        <th>
                                            <a href="<?= base_url("berkas/smasuk/".$ddata[0]['berkas']) ?>" class="form-control font-weight-bold text-primary" target="_blank">
                                                <?= $ddata[0]['berkas'] ?>
                                            </a>
                                        </th>

                                    </tr>
                                    <tr>
                                        <td>Tanggal Dikeluarkan</td>
                                        <th><?= tgl_indo($ddata[0]['tanggal']) ?></th>
                                        
                                    </tr>
                                </tbody>
                            </table>
						</div>
                    
                    </div>
					<div class="col-md-6">
                        
                        
					<div class="card card-border mb-0 h-100 custom-card">
						<div class="card-header card-header-action">
							
						</div>
						
							<table class="table table-hover mb-0">
								<tbody>
									<table>	
										<tr>
											<td>Nama </td>
											<td>:</td>
											<th><?= $ddata[0]['nm_anggota'] ?></th>
										</tr>
										<tr>
											<td>NIP</td>
											<td>:</td>
											<th><?= $ddata[0]['nip'] ?></th>
										</tr>
										<tr>
											<td>Jabatan</td>
											<td>:</td>
											<th><?= $ddata[0]['jabatan'] ?></th>
										</tr>
										<tr>
											<td>Gol.Darah</td>
											<td>:</td>
											<th><?= $ddata[0]['gol_darah'] ?></th>
										</tr>
										<tr>
											<td>Alamat Kantor</td>
											<td>:</td>
											<th><?= $ddata[0]['alamat'] ?></th>
										</tr>
									</table>
								</tbody>
							</table>
					</div>
                    
                    </div>
                </div>
                
			</div>
		</div>
	</div>



    


	<?php
        $this->load->view("inc/footer");
    ?>

		<script>
			$(document).ready(function() {
				
				function selectElement(id, valueToSelect) {    
					let element = document.getElementById(id);
					element.value = valueToSelect;
				}

				$(document).on('click', '.bthapus', function() {
					const id 	= $(this).data('id');
					const nama 	= $(this).data('nama');
					$('#id_user_hapus').val(id);
					document.getElementById("nama_hapus").innerHTML = nama;
				});

				$(document).on('click', '.bthapusdispo', function() {
					const id 	= $(this).data('id');
					$('#id_disposisi_hapusdispo').val(id);
				});
			});
		</script>
</body>
</html>
