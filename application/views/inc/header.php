<?php
$post = $this->input->post();
if(isset($post['editmypass'])){
	$simpan = $this->db->update("pengguna", array("password" => md5($post['password'])), array("id_pengguna" => sesuser("id_pengguna")));
	if($simpan){
		$this->session->set_flashdata('pesan', '<div class="alert alert-success">Berhasil mengedit password.</div>');
	}else{
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal mengedit password.</div>');
	}
	redirect(base_url("dashboard"));
}
?>

<!-- Main navbar -->
<div class="navbar navbar-expand-md navbar-dark bg-indigo px-0">
		<div class="container">
			<div class=" wmin-0 mr-5">
				<a href="<?= base_url("dashboard") ?>" class="d-inline-block">
					<!-- <img src="<?= identitas("logo") ?>" alt="" style="width:50px;"> -->
                    <span style="font-weight:bold;font-size:18px;color:#fff;"><?= identitas("judul") ?></span>
				</a>
			</div>

			<div class="d-md-none">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
					<i class="icon-tree5"></i>
				</button>
			</div>

			<div class="collapse navbar-collapse" id="navbar-mobile">
				<ul class="navbar-nav">
					
				</ul>

				<span class="navbar-text ml-md-3 mr-md-auto">
					
				</span>

				<ul class="navbar-nav">

					<li class="nav-item dropdown dropdown-user">
						<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
							<!-- <img src="<?= base_url() ?>global/images/placeholders/placeholder.jpg" class="rounded-circle" alt=""> -->
							<span><?= cekuser(sesuser("id_pengguna"), "nm_pengguna") ?></span>
						</a>

						<div class="dropdown-menu dropdown-menu-right">
							<!-- <a href="<?= base_url("profil") ?>" class="dropdown-item"><i class="icon-user-plus"></i> Profil</a>
							<div class="dropdown-divider"></div> -->
							<a href="#" class="dropdown-item" data-toggle="modal" data-target="#modalEditMyPass"><i class="icon-lock"></i> Ganti Password</a>
							<a href="<?= base_url("auth/logout") ?>" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Secondary navbar -->
	<div class="navbar navbar-expand-md navbar-light px-0">
		<div class="container position-relative">
			<div class="text-center d-md-none w-100">
				<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-navigation">
					<i class="icon-unfold mr-2"></i>
					Menu
				</button>
			</div>

			<div class="navbar-collapse collapse" id="navbar-navigation">
				<ul class="navbar-nav navbar-nav-highlight">
					<li class="nav-item">
						<a href="<?= base_url("dashboard") ?>" class="navbar-nav-link">
							<i class="icon-home4 mr-2"></i>
							Dashboard
						</a>
					</li>
                    <li class="nav-item">
						<a href="<?= base_url("pengguna") ?>" class="navbar-nav-link">
							<i class="icon-users mr-2"></i>
							Pengguna
						</a>
					</li>
                    <li class="nav-item">
						<a href="<?= base_url("anggota") ?>" class="navbar-nav-link">
							<i class="icon-people mr-2"></i>
							Anggota
						</a>
					</li>

					
				</ul>

				<ul class="navbar-nav navbar-nav-highlight ml-md-auto">

					<li class="nav-item dropdown">
						<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
							<i class="icon-cog3"></i>
							<span class="ml-2">Master</span>
						</a>

						<div class="dropdown-menu dropdown-menu-right">
							
							<a href="<?= base_url("master/jenisstatus") ?>" class="dropdown-item">Jenis Status</a>
							<a href="<?= base_url("master/ttd") ?>" class="dropdown-item">TTD</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /secondary navbar -->

	<div class="modal fade" id="modalEditMyPass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <form method="post" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Password</h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Password Baru :</label>
                        <input type="password" name="password" class="form-control" placeholder="Password Baru" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="editmypass" class="btn btn-danger">Edit Password</button>
                </div>
            </form>
        </div>
    </div>