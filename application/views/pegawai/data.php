<?php
defined('BASEPATH') or exit('No direct script access allowed');

if(empty(sesuser('id_pengguna'))){
	redirect("/auth/login", refresh);
}

$post = $this->input->post();
if(isset($post['hapus'])){
    $simpan = $this->db->delete("pegawai", array("no_pegawai" => $post['no_pegawai']));
    if($simpan){
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Berhasil menghapus data.</div>');
    }else{
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal menghapus data.</div>');
    }
    redirect(base_url("pegawai"));
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
                <a href="<?= base_url("pegawai/tambah") ?>" class="btn btn-primary mb-3">Tambah</a>
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
                                    <th>Nama</th>
													<th>Jns. Kelamin</th>
													<th>Alamat</th>
													<th>HP</th>
													<th>Jabatan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $nodata = 1;
                                    $sdata = $this->db->query("SELECT a.*, b.nm_jabatan FROM pegawai a LEFT JOIN jabatan b ON a.id_jabatan = b.id_jabatan");
                                                    foreach($sdata->result_array() as $ddata){
                                                        if($ddata['kelamin'] == "L"){
                                                            $kelamin = "Laki-laki";
                                                        }else{
                                                            $kelamin = "Perempuan";
                                                        }
                                        echo"
                                            <tr>
                                                <td class='text-center'>".$nodata."</td>
                                                <td>".$ddata['nm_pegawai']."</td>
                                                                <td>".$kelamin."</td>
                                                                <td>".$ddata['alamat']."</td>
                                                                <td>".$ddata['hp']."</td>
                                                                <td>".$ddata['nm_jabatan']."</td>
                                                <td class='text-center'>
                                                    <div class='btn-group'>
                                                        <a href='".base_url("pegawai/edit/".$ddata['no_pegawai'])."' class='btn btn-primary'><i class='icon-pencil7'></i></a>
                                                        <a href='#' class='btn btn-danger bthapus' data-toggle='modal' data-target='#modalHapus' data-id='".$ddata['no_pegawai']."' data-nama='".$ddata['nm_pegawai']."'><i class='icon-trash'></i></a>
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

    <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <form method="post" class="modal-content">
                <input type="hidden" name="no_pegawai" id="no_pegawai_hapus">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger text-center">
                        Anda yakin akan menghapus data <b id="nama_hapus"></b>? Data yang sudah dihapus tidak bisa dikembalikan lagi.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="hapus" class="btn btn-danger">Hapus Data</button>
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
				$('#no_pegawai_hapus').val(id);
				document.getElementById("nama_hapus").innerHTML = nama;
			});
				
		});
	</script>
</body>
</html>
