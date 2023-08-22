<?php
defined('BASEPATH') or exit('No direct script access allowed');

if(empty(sesuser('id_pengguna'))){
	redirect("/auth/login", refresh);
}
$nosmasuk = $this->uri->segment(3);
$sdata = $this->db->get_where("suratkeluar", array("noskeluar" => $nosmasuk));
$hdata = $sdata->num_rows();
if($hdata == 0){
	redirect(base_url("suratkeluar"));
}
$ddata = $sdata->result_array();
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
                    <div class="col-md-8">
                        <?= $this->session->flashdata('pesan') ?>
                        
                        <form method="post" class="card card-border mb-0 h-100" enctype="multipart/form-data" action="<?= base_url("suratkeluar/addproses") ?>">
								<div class="card-header card-header-action">
									<h6><?= $title ?></h6>
								</div>
                                
								<div class="card-body">
                                <div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="font-weight-bold text-primary">NO. FAKTUR: <span class="text-danger">*auto</span></label>
													<input type="text" name="nosmasuk" class="form-control font-weight-bold" value="<?= $nosmasuk ?>" readonly>
												</div>
												<div class="form-group">
													<label>No. Surat:</label>
													<input type="text" value="<?= $ddata[0]['no_surat'] ?>" name="no_surat" class="form-control" placeholder="Nomor Surat" required>
												</div>
												<div class="form-group">
													<label>Tanggal:</label>
													<input type="date" value="<?= $ddata[0]['tanggal'] ?>" name="tanggal" class="form-control" placeholder="Tanggal Surat" required>
												</div>
												<div class="form-group">
													<label>Kepada:</label>
													<input type="text" value="<?= $ddata[0]['kepada'] ?>" name="kepada" class="form-control" placeholder="Kepada" required>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Hal:</label>
													<input type="text" name="hal" value="<?= $ddata[0]['hal'] ?>" class="form-control" placeholder="Hal" required>
												</div>
												<div class="form-group">
													<label>Jenis Surat:</label>
													<select class="form-control" name="id_jenissurat" required>
														<option value="">[ Pilih Jenis Surat ]</option>
														<?php
															$sjen = $this->db->get("jenissurat");
															foreach($sjen->result_array() as $djen){
																if($ddata[0]['id_jenissurat'] == $djen['id_jenissurat']){
																	echo"<option value='".$djen['id_jenissurat']."' selected>".$djen['nm_jenissurat']."</option>";
																}else{
																	echo"<option value='".$djen['id_jenissurat']."'>".$djen['nm_jenissurat']."</option>";
																}
																
															}
														?>
													</select>
												</div>
												<div class="form-group">
													<label>Berkas Surat (PDF): <small class="text-warning">* Biarkan kosong jika tidak merubah berbas.</small></label>
													<div class="form-group">
														<input type="file" name="berkas" class="form-control" id="inputGroupFile04" accept="application/pdf">
														
													</div>
												</div>
												<div class="form-group">
													<label>Berkas diupload:</label>
													<div class="form-group">
														<a href="<?= base_url("berkas/skeluar/".$ddata[0]['berkas']) ?>" class="form-control font-weight-bold" target="_blank"><?= $ddata[0]['berkas'] ?></a>
													</div>
												</div>
											</div>
										</div>
										
										
								</div>
                                <div class="card-footer">
                                    <a href="<?= base_url("suratkeluar") ?>" class="btn btn-secondary">Batal</a>
                                    <button type="submit" name="editin" class="btn btn-primary ms-3">Simpan Data</button>
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
