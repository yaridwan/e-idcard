<?php
defined('BASEPATH') or exit('No direct script access allowed');
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
	<script src="<?= base_url() ?>global/js/plugins/ui/ripple.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="<?= base_url() ?>global/js/plugins/forms/styling/uniform.min.js"></script>

	<script src="<?= base_url() ?>assets/js/app.js"></script>
	<script src="<?= base_url() ?>global/js/demo_pages/login.js"></script>
	<!-- /theme JS files -->

</head>

<body>




	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Login card -->
				<form class="login-form" method="post" action="<?= base_url("auth/login") ?>">
					<div class="card-body">
						<div class="text-center mb-3">
							<img src="<?= identitas("logo") ?>" style="width:150px;">
							<h5 class="mb-0"><?= identitas("judul") ?></h5>
							<span class="d-block text-muted"><?= identitas("deskripsi") ?></span>
						</div>

                        <?= $this->session->flashdata('message') ?>

						<div class="form-group form-group-feedback form-group-feedback-left">
							<input type="text" class="form-control" placeholder="Username" name="username" required>
							<div class="form-control-feedback">
								<i class="icon-user text-muted"></i>
							</div>
						</div>

						<div class="form-group form-group-feedback form-group-feedback-left">
							<input type="password" class="form-control" placeholder="Password" name="password" required>
							<div class="form-control-feedback">
								<i class="icon-lock2 text-muted"></i>
							</div>
						</div>

						<div class="form-group d-flex align-items-center">
							<div class="form-check mb-0">
								<label class="form-check-label">
									<input type="checkbox" name="remember" class="form-input-styled" checked data-fouc>
									Remember
								</label>
							</div>

							<!-- <a href="login_password_recover.html" class="ml-auto">Forgot password?</a> -->
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 ml-2"></i></button>
						</div>
					</div>
				</form>
				<!-- /login card -->

			</div>
			<!-- /content area -->


		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
</html>
