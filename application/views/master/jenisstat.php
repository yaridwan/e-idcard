<?php
defined('BASEPATH') or exit('No direct script access allowed');

if(empty(sesuser('id_pengguna'))){
	redirect("/auth/login", refresh);
}

$post = $this->input->post();
if(isset($post['simpan'])){
    $post_data = array(
        "nm_jenis" => $post['nm_jenis']
    );
    $simpan = $this->db->insert("jenis", $post_data);
    if($simpan){
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Berhasil menambah data.</div>');
    }else{
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal menambah data.</div>');
    }
    redirect(base_url("master/jenisstat"));
}else if(isset($post['edit'])){
    $post_data = array(
        "nm_jenis" => $post['nm_jenis']
    );
    $simpan = $this->db->update("jenis", $post_data, array("id_jenis" => $post['id_jenis']));
    if($simpan){
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Berhasil mengedit data.</div>');
    }else{
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal mengedit data.</div>');
    }
    redirect(base_url("master/jenisstat"));
}else if(isset($post['hapus'])){
    $simpan = $this->db->delete("jenis", array("id_jenis" => $post['id_jenis']));
    if($simpan){
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Berhasil menghapus data.</div>');
    }else{
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal menghapus data.</div>');
    }
    redirect(base_url("master/jenisstat"));
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
                <a href="#" data-toggle="modal" data-target="#modalTambah" class="btn btn-primary mb-3">Tambah</a>
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
                                    <th>Jenis Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $nodata = 1;
                                    $sdata = $this->db->get("jenis");
                                    foreach($sdata->result_array() as $ddata){
                                        echo"
                                            <tr>
                                                <td class='text-center'>".$nodata."</td>
                                                <td>".$ddata['nm_jenis']."</td>
                                                <td class='text-center'>
                                                    <div class='btn-group'>
                                                        <a href='#' class='btn btn-primary btedit' data-toggle='modal' data-target='#modalEdit' data-id='".$ddata['id_jenis']."' data-nama='".$ddata['nm_jenis']."'><i class='icon-pencil7'></i></a>
                                                        <a href='#' class='btn btn-danger bthapus' data-toggle='modal' data-target='#modalHapus' data-id='".$ddata['id_jenis']."' data-nama='".$ddata['nm_jenis']."'><i class='icon-trash'></i></a>
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

    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Jenis Status:</label>
                        <input type="text" name="nm_jenis" class="form-control" placeholder="Jenis Status" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" class="modal-content">
                <input type="hidden" name="nm_jenis" id="id_jenis_edit">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Jenis Status :</label>
                        <input type="text" name="nm_jenis" id="nm_jenis_edit" class="form-control" placeholder="Jenis Status" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="edit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <form method="post" class="modal-content">
                <input type="hidden" name="id_jenis" id="id_jenis_hapus">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
				$('#id_jenis_hapus').val(id);
				document.getElementById("nama_hapus").innerHTML = nama;
			});

            $(document).on('click', '.btedit', function() {
				const id 	= $(this).data('id');
				const nama 	= $(this).data('nama');
				$('#id_jenis_edit').val(id);
				$('#nm_jenis_edit').val(nama);
			});
				
		});
	</script>
</body>
</html>
