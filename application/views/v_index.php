<?php include "v_header.php"; ?>
<?php
$do = array('Menabung','Menarik','Transfer','Investasi'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Sistem Informasi Perbankan</title>
</head>
<body>
	<div class="landing-page">
		<center>
			<h1>Kelola Uangmu Dari Sini</h1>
			<h4>Menabung &bull; Menarik &bull; Membeli &bull; Investasi</h4>
			<img alt="banking" class="img-responsive landing-img" src="<?= base_url('assets/image/banking.jpg'); ?>">
		</center>
	</div>
	<div class="bg-success landing-page-2">
		<div class="container">
			<center><h1>Kelebihan Kami</h1></center>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
					<div class="panel-card">
						<img class="img-responsive benefit-img" alt="growth" src="<?= base_url('assets/image/growth.svg'); ?>">				<div class="panel-text">	
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sed lectus efficitur libero malesuada consequat. Ut at blandit ante. Proin faucibus scelerisque magna, a convallis ante aliquet sit amet. Phasellus iaculis non felis in laoreet. Phasellus non nisi in ipsum ultrices fringilla non vitae sem.</p>
							</div>
					</div>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
					<div class="panel-card">
						<img class="img-responsive benefit-img" alt="growth" src="<?= base_url('assets/image/home.svg'); ?>">	
							<div class="panel-text">	
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sed lectus efficitur libero malesuada consequat. Ut at blandit ante. Proin faucibus scelerisque magna, a convallis ante aliquet sit amet. Phasellus iaculis non felis in laoreet. Phasellus non nisi in ipsum ultrices fringilla non vitae sem.</p>
							</div>
					</div>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
					<div class="panel-card">
						<img class="img-responsive benefit-img" alt="growth" src="<?= base_url('assets/image/shield.svg'); ?>">
							<div class="panel-text">	
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sed lectus efficitur libero malesuada consequat. Ut at blandit ante. Proin faucibus scelerisque magna, a convallis ante aliquet sit amet. Phasellus iaculis non felis in laoreet. Phasellus non nisi in ipsum ultrices fringilla non vitae sem.</p>
							</div>
					</div>
				</div>
			</div>
		</div>
		<br/><br/><br/><br/><br/>
	</div>

	<div class="landing-page-3">
		<div class="container">
		<br/><br/>
			<div class="row">
				<div class="col-sm-12 col-md-7">
					<p class="penjelasan">Sekarang sudah jamannya online. Saat ini kita sudah sangat dimudahkan dengan kecanggihan teknologi. Dengan menggunakan website ini, Anda bisa mengelola keuangan Anda tanpa perlu keluar rumah. Anda bisa melakukan beberapa hal ini:
					<?php foreach ($do as $d)
					{
						?><br/><img class="img-icon" src="<?= base_url('assets/image/checked.svg'); ?>">&nbsp;<?= $d; ?><?php
					}?>
					</p>
				</div>
				<div class="col-sm-12 col-md-5">
				<img class="img-responsive" src="<?= base_url('assets/image/ease.png'); ?>">
				</div>
			</div>
		</div>
	</div>

	<div class="info call-to-action">
		<div class="container">
		<br/><br/>
			<div class="row">
				<div class="col-md-8">
					<p class="ajakan">Tunggu apalagi? Segera daftar sekarang</p>
				</div>

				<div class="col-md-4">
					<a href="<?= base_url('register/'); ?>"><button class="tombol-cta">Daftar Gratis</button></a>
				</div>
			</div>
		</div>
	</div>
</body>
<?php include "v_footer.php"; ?>
</html>