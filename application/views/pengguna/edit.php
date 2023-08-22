<?php
defined('BASEPATH') or exit('No direct script access allowed');

if(empty(sesuser('id_pengguna'))){
	redirect("/auth/login", refresh);
}

$id_pengguna = $this->uri->segment(3);
$sdata = $this->db->get_where("pengguna", array("id_pengguna" => $id_pengguna));
$hdata = $sdata->num_rows();
if($hdata == 0){
    redirect(base_url("pengguna"));
}
$ddata = $sdata->result_array();

$post = $this->input->post();
if(isset($post['edit'])){
    $post_data = array(
        "nm_pengguna" => $post['nm_pengguna'],
        "kelamin" => $post['kelamin'],
        "alamat" => $post['alamat'],
        "hp" => $post['hp'],
        "username" => $post['username']
    );
    $simpan = $this->db->update("pengguna", $post_data, array("id_pengguna" => $id_pengguna));
    if($simpan){
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Berhasil menambah data.</div>');
    }else{
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal menambah data.</div>');
    }
    redirect(base_url("pengguna"));
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
					<a href="<?= base_url("pengguna") ?>" class="breadcrumb-item">Data Pengguna</a>
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
                        
                        <form method="post" class="card card-border mb-0 h-100">
								<div class="card-header card-header-action">
									<h6><?= $title ?></h6>
								</div>
                                
								<div class="card-body">
                                    <div class="form-group">
                                        <label>Nama Pengguna :</label>
                                        <input type="text" value="<?= $ddata[0]['nm_pengguna'] ?>" name="nm_pengguna" class="form-control" placeholder="Nama Pengguna" required>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Jns. Kelmain :</label>
                                        <select name="kelamin" class="form-control" required>
                                            <option value="">- Pilih Jenis Kelamin -</option>
                                            <?php
                                                if($ddata[0]['kelamin'] == "L"){
                                                    echo'
                                                    <option value="L" selected>Laki-laki</option>
                                                    <option value="P">Perempuan</option>
                                                    ';
                                                }else{
                                                    echo'
                                                    <option value="L">Laki-laki</option>
                                                    <option value="P" selected>Perempuan</option>
                                                    ';
                                                }
                                            ?>
                                            
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat :</label>
                                        <input type="text" name="alamat" value="<?= $ddata[0]['alamat'] ?>" class="form-control" placeholder="Alamat" required>
                                    </div>
                                    <div class="form-group">
                                        <label>HP :</label>
                                        <input type="text" name="hp" class="form-control" value="<?= $ddata[0]['hp'] ?>" placeholder="HP" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Username :</label>
                                        <input type="text" name="username" value="<?= $ddata[0]['username'] ?>" class="form-control" placeholder="Username" required>
                                    </div>
								</div>
                                <div class="card-footer">
                                    <a href="<?= base_url("pengguna") ?>" class="btn btn-secondary">Batal</a>
                                    <button type="submit" name="edit" class="btn btn-primary ms-3">Simpan Data</button>
                                </div>
							</form>
                    </div>
                </div>
                
			</div>
		</div>
	</div>


	<?php
        $this->load->view("inc/footer");
    ?>

</body>
</html>
