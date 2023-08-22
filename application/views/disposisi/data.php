<?php
defined('BASEPATH') or exit('No direct script access allowed');

if(empty(sesuser('id_pengguna'))){
	redirect("/auth/login", refresh);
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
                <!-- <a href="<?= base_url("suratkeluar/tambah") ?>" class="btn btn-primary mb-3">Tambah</a> -->
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
                                    <th>Faktur</th>
                                    <th>Tanggal</th>
                                    <th>Sumber</th>
                                    <th>Tujuan</th>
                                    <th>Sifat</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $nodispo = 1;
                                    $sdispo = $this->db->query("SELECT a.*, b.`nm_sifat`, c.nm_pegawai AS nm_sumber, d.nm_pegawai AS nm_tujuan FROM disposisi a LEFT JOIN sifat b ON a.`id_sifat` = b.`id_sifat` LEFT JOIN pegawai c ON a.sumber = c.no_pegawai LEFT JOIN pegawai d ON a.tujuan = d.no_pegawai ORDER BY a.id_disposisi DESC");
                                    foreach($sdispo->result_array() as $ddispo){

                                        if($ddispo['jenis'] == "smasuk"){
                                            $jeniso = "Surat Masuk";
                                            $faktur = $ddispo['nosmasuk'];
                                            $urldata = base_url("suratmasuk/detail/".$ddispo['nosmasuk']);
                                        }else{
                                            $faktur = $ddispo['noskeluar'];
                                            $jeniso = "Surat Keluar";
                                            $urldata = base_url("suratkeluar/detail/".$ddispo['noskeluar']);
                                        }
                                        echo"
                                            <tr>
                                                <td class='text-center'>".$nodispo.".</td>
                                                <td>".$faktur."<br><i>".$jeniso."</i></td>
                                                <td>".$ddispo['addedon']."</td>
                                                <td>".$ddispo['nm_sumber']."</td>
                                                <td>".$ddispo['nm_tujuan']."</td>
                                                <td>".$ddispo['nm_sifat']."</td>
                                                <td class='text-center'>
                                                    <div class='btn-group'>
                                                        <a href='".$urldata."' target='_blank' class='btn btn-dark btn-xs'><i class='icon-eye'></i></a>
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

    <div id="modalHapus" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalTambah" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <form method="post" class="modal-content">
						<input type="hidden" name="noskeluar" id="noskeluar_hapus">
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
					$('#noskeluar_hapus').val(id);
					document.getElementById("nama_hapus").innerHTML = nama;
				});

			});
		</script>
</body>
</html>
