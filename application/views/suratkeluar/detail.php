<?php
defined('BASEPATH') or exit('No direct script access allowed');

if(empty(sesuser('id_pengguna'))){
	redirect("/auth/login", refresh);
}
$noskeluar = $this->uri->segment(3);
$sdata = $this->db->query("SELECT a.*, b.`nm_jenissurat` FROM suratkeluar a LEFT JOIN jenissurat b ON a.`id_jenissurat` = b.`id_jenissurat` WHERE a.noskeluar = '".$noskeluar."'");
$hdata = $sdata->num_rows();
if($hdata == 0){
	redirect(base_url("suratkeluar"));
}
$ddata = $sdata->result_array();




$post = $this->input->post();
if(isset($post['disposisikan'])){
    $post_data = array(
        "noskeluar" => $noskeluar,
        "sumber" => $post['sumber'],
        "tujuan" => $post['tujuan'],
        "id_sifat" => $post['id_sifat'],
        "jenis" => "skeluar",
        "useradd" => sesuser("id_pengguna")
    );
    $cekdulu = $this->db->get_where("disposisi", array("noskeluar" => $noskeluar, "tujuan" => $post['tujuan']))->num_rows();
    if($cekdulu > 0){
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Data sudah didisposisikan ke user yang Anda pilih.</div>');
    }else{
        $simpan = $this->db->insert("disposisi", $post_data);
        if($simpan){
            $this->session->set_flashdata('pesan', '<div class="alert alert-success">Berhasil menambah data</div>');
        }else{
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal menambah data</div>');
        }
    }
	
	redirect(base_url("suratkeluar/detail/".$noskeluar));
}else if(isset($post['hapusindispo'])){
	$simpan = $this->db->delete("disposisi", array("id_disposisi" => $post['id_disposisi']));
	if($simpan){
		$this->session->set_flashdata('pesan', '<div class="alert alert-success">Berhasil menghapus data</div>');
	}else{
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal menghapus data</div>');
	}
	redirect(base_url("suratkeluar/detail/".$noskeluar));
}
?><!DOCTYPE html>
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
					<a href="<?= base_url("suratkeluar") ?>" class="breadcrumb-item">Surat Keluar</a>
					<span class="breadcrumb-item active"><?= $title ?></span>
				</div>
			</div>
		</div>
	</div>

	<div class="page-content container pt-0">
		<div class="content-wrapper">

			<div class="content">
                <!-- <a href="#" data-toggle="modal" data-target="#modalTambah" class="btn btn-primary mb-3">Tambah</a> -->
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
                                        <td>No.  Faktur</td>
                                        <th><?= $noskeluar ?></th>
                                    </tr>
                                    <tr>
                                        <td>No.  Surat</td>
                                        <th><?= $ddata[0]['no_surat'] ?></th>
                                    </tr>
                                    <tr>
                                        <td>Tanggal</td>
                                        <th><?= $ddata[0]['tanggal'] ?></th>
                                    </tr>
                                    <tr>
                                        <td>Kepada</td>
                                        <th><?= $ddata[0]['kepada'] ?></th>
                                    </tr>
                                    <tr>
                                        <td>Hal</td>
                                        <th><?= $ddata[0]['hal'] ?></th>
                                    </tr>
                                    <tr>
                                        <td>Jenis Surat</td>
                                        <th><?= $ddata[0]['nm_jenissurat'] ?></th>
                                    </tr>
                                    <tr>
                                        <td>Berkas Surat</td>
                                        <th><a href="<?= base_url("berkas/skeluar/".$ddata[0]['berkas']) ?>" class="form-control font-weight-bold" target="_blank"><?= $ddata[0]['berkas'] ?></a></th>
                                    </tr>
                                </tbody>
                            </table>
						</div>
                    
                    </div>
                    <div class="col-md-12">
                        <div class="card table-responsive table-bordered pb-0 mt-3">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th colspan="4" class="bg-dark text-light">RIWAYAT DISPOSISI</th>
                                        <th class="bg-dark text-center">
                                            <a href="#" data-toggle="modal" data-target="#modalDisposisi" class="btn btn-primary">Disposisikan Surat</a>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Sumber</th>
                                        <th>Tujuan</th>
                                        <th>Sifat</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $nodispo = 1;
                                        $sdispo = $this->db->query("SELECT a.*, b.`nm_sifat`, c.nm_pegawai AS nm_sumber, d.nm_pegawai AS nm_tujuan FROM disposisi a LEFT JOIN sifat b ON a.`id_sifat` = b.`id_sifat` LEFT JOIN pegawai c ON a.sumber = c.no_pegawai LEFT JOIN pegawai d ON a.tujuan = d.no_pegawai WHERE a.noskeluar = '".$noskeluar."'");
                                        foreach($sdispo->result_array() as $ddispo){
                                            echo"
                                                <tr>
                                                    <td class='text-center'>".$nodispo.".</td>
                                                    <td>".$ddispo['nm_sumber']."</td>
                                                    <td>".$ddispo['nm_tujuan']."</td>
                                                    <td>".$ddispo['nm_sifat']."</td>
                                                    <td class='text-center'>
                                                        <div class='btn-group'>
                                                            <a href='#' data-toggle='modal' data-target='#modalHapusDispo' data-id='".$ddispo['id_disposisi']."' class='btn btn-danger btn-xs bthapusdispo'><i class='icon-trash'></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            ";
                                            $nodispo++;
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
					</div>
                </div>
                
			</div>
		</div>
	</div>


    <div id="modalDisposisi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalTambah" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <form method="post" class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalTambah">Disposisikan Surat</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                        <div class="form-group">
                                <label>Sumber :</label>
                                <!-- <input type="text" class="form-control" name="sumber" placeholder="Sumber" required> -->
                                <select class="form-control" name="sumber" required>
                                    <option value="">- Pilih Sumber Disposisi -</option>
                                    <?php
                                        $speg = $this->db->get("pegawai");
                                        foreach($speg->result_array() as $dpeg){
                                            echo"<option value='".$dpeg['no_pegawai']."'>".$dpeg['nm_pegawai']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tujuan :</label>
                                <!-- <input type="text" class="form-control" name="tujuan" placeholder="Tujuan" required> -->
                                <select class="form-control" name="tujuan" required>
                                    <option value="">- Pilih Tujuan Disposisi -</option>
                                    <?php
                                        $speg = $this->db->get("pegawai");
                                        foreach($speg->result_array() as $dpeg){
                                            echo"<option value='".$dpeg['no_pegawai']."'>".$dpeg['nm_pegawai']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Sifat Surat :</label>
                                <select class="form-control" name="id_sifat" required>
                                    <option value="">[ Pilih Sifat Surat ]</option>
                                    <?php
                                        $sjen = $this->db->get("sifat");
                                        foreach($sjen->result_array() as $djen){
                                            echo"<option value='".$djen['id_sifat']."'>".$djen['nm_sifat']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                            <button type="submit" name="disposisikan" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="modalHapusDispo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalTambah" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <form method="post" class="modal-content">
						<input type="hidden" name="id_disposisi" id="id_disposisi_hapusdispo">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalTambah">Konfirmasi Hapus</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger">Anda yakin akan menghapus data ini? data yang sudah dihapus tidak bisa dikembalikan lagi.</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                            <button type="submit" name="hapusindispo" class="btn btn-danger">Ya! Hapus permanen data</button>
                        </div>
                    </form>
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
