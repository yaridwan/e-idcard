<?php
defined('BASEPATH') or exit('No direct script access allowed');

if(empty(sesuser('id_pengguna'))){
	redirect("/auth/login", refresh);
}

$post = $this->input->post();
if(isset($post['hapusin'])){
	$simpan = $this->db->delete("suratmasuk", array("nosmasuk" => $post['nosmasuk']));
	if($simpan){
        $this->db->delete("disposisi", array("nosmasuk" => $post['nosmasuk']));
		$this->session->set_flashdata('pesan', '<div class="alert alert-success">Berhasil menghapus data</div>');
	}else{
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal menghapus data</div>');
	}
	redirect(base_url("suratmasuk"));
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
					<span class="breadcrumb-item active"><?= $title ?></span>
				</div>
			</div>
		</div>
	</div>

	<div class="page-content container pt-0">
		<div class="content-wrapper">

			<div class="content">
                <a href="<?= base_url("anggota/tambah") ?>" class="btn btn-primary mb-3">Tambah</a>
                <?= $this->session->flashdata('pesan') ?>
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0"><?= $title ?></h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>No. Faktur</th>
                                    <th>Nama</th>
                                                    <th>NIP</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>Jabatan</th>
                                                    <th>Gol. Darah</th>
                                                    <th>Tanggal Dikeluarkan</th>
                                                    
                                                    <th>Alamat</th>
                                                    <th>Jenis Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $nodata = 1;
                                    $sdata = $this->db->query("SELECT a.*, b.`nm_jenis`, c.`nm_jk`, d.`nm_user` FROM anggota a LEFT JOIN jenis b ON a.`id_jenis` = b.`id_jenis` LEFT JOIN jk c ON a.`id_jk` = c.`id_jk` LEFT JOIN users d ON a.`useradd` = d.`id_user` ORDER BY a.nosmasuk DESC");
													foreach($sdata->result_array() as $ddata){
                                        echo"
                                            <tr>
                                                <td class='text-center'>".$nodata."</td>
                                                <td>".$ddata['nosmasuk']."</td>
												<td>".$ddata['nm_anggota']."</td>
                                                                <td>".$ddata['nip']."</td>
                                                                <td>".$ddata['nm_jk']."</td>
                                                                <td>".$ddata['jabatan']."</td>
                                                                <td>".$ddata['gol_darah']."</td>
																<td>".tgl_indo($ddata['tanggal'])."</td>
																
																<td>".$ddata['alamat']."</td>
																<td>".$ddata['nm_jenis']."</td>
                                                <td class='text-center'>
                                                    <div class='btn-group'>
                                                        <a href='".base_url("suratmasuk/edit/".$ddata['nosmasuk'])."' class='btn btn-primary'><i class='icon-pencil7'></i></a>
                                                        <a href='#' class='btn btn-danger bthapus' data-toggle='modal' data-target='#modalHapus' data-id='".$ddata['nosmasuk']."' data-nama='".$ddata['nosmasuk']."'><i class='icon-trash'></i></a>
                                                        <a href='".base_url("suratmasuk/detail/".$ddata['nosmasuk'])."' class='btn btn-dark'><i class='icon-eye'></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        ";
                                        $nodata++;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
			</div>
		</div>
	</div>

    <div id="modalHapus" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalTambah" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <form method="post" class="modal-content">
						<input type="hidden" name="nosmasuk" id="nosmasuk_hapus">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalTambah">Konfirmasi Hapus</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger">Anda yakin akan menghapus data <b id="nama_hapus"></b>? data yang sudah dihapus tidak bisa dikembalikan lagi.</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                            <button type="submit" name="hapusin" class="btn btn-danger">Ya! Hapus permanen data</button>
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
					$('#nosmasuk_hapus').val(id);
					document.getElementById("nama_hapus").innerHTML = nama;
				});
				
		});
	</script>
</body>
</html>
