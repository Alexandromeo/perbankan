<?php error_reporting(0); ?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/bootstrap/bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/custom.css'); ?>">

<!DOCTYPE html>
<html>
<head>
	<title>Login Admin - Sistem Informasi Perbankan</title>
	<style>
		.sign-addon
		{
			background-color: #34495e;
			border-color: #34495e;
			border-bottom-color: #2c3e50;
		}

		.horizontal-line{background-color: #2c3e50}
		.tombol-hijau
		{
			background-color: #ecf0f1; color: #34495e;
			border-color: #ecf0f1;
			border-bottom-color: #bdc3c7;
		}
		.login-admin{background-color: #34495e; color: white;}
		.login-admin input{background-color: #34495e; color: white}
	</style>
</head>
<body>
	<div class="container">
		<div class="row" style="margin-top: 7%">
			<?php if($_GET['m'])
			{
				?><div class="alert alert-error col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<i class="fa fa-alert fa-ban"></i><?= base64_decode($_GET['m']); ?>
				</div><?php
			}?>
			<div class="login-form login-admin col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="login-logo">
					<img class="img-responsive" src="<?= base_url('assets/image/logo-admin.png'); ?>">
				</div>
				<div class="horizontal-line"></div>
				<form action="<?= base_url(); ?>login/admin" method="post">
						<div class="form-group">
							<label class="control-label">Email</label>
							<div class="input-group">
								<span class="input-group-addon sign-addon"><i class="fa fa-user fa-inverse"></i></span>
								<input type="text" name="email" class="form-control">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label">Password</label>
							<div class="input-group">
								<span class="input-group-addon sign-addon"><i class="fa fa-lock fa-inverse"></i></span>
								<input type="password" id="pass" name="password" class="form-control form-input input-pass">
							</div>
						</div>			

						<div class="form-group">
							<button type="submit" name="loginadmin" class="form-control tombol-hijau">Login Admin</button>
						</div>				
				</form>
			</div>		
		</div>
	</div>
</body>
</html>
<?php include "v_footer.php"; ?>