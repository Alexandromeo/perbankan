<?php include "v_header.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login - Sistem Informasi Perbankan</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<?php if($_GET['m'])
			{
				?><div class="alert alert-error col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<i class="fa fa-alert fa-ban"></i><?= base64_decode($_GET['m']); ?>
				</div><?php
			}?>
			<div class="login-form col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="login-logo">
					<img class="img-responsive" src="<?= base_url('assets/image/logo.png'); ?>">
				</div>
				<div class="horizontal-line"></div>
				<form action="<?= base_url(); ?>login" method="post">
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
								<span class="input-group-addon transparent"><i class="fa fa-eye mata"></i></span>
							</div>
						</div>			

						<div class="form-group">
							<input type="submit" name="login" value="Login" class="form-control tombol-hijau">
						</div>				
				</form>
				Belum punya akun? <a href="<?= base_url('register'); ?>">Daftar</a> di sini.<br><br>
			</div>		
		</div>
	</div>
</body>
</html>
<?php include "v_footer.php"; ?>