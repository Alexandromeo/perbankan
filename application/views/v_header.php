<?php 
error_reporting(0);
date_default_timezone_set("Asia/Jakarta");
?>
<!DOCTYPE html>
<html>
<body>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/bootstrap/bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/custom.css'); ?>">
	<nav class="navbar navbar-greensea">
    <div class="container-fluid">
        <div class="navbar-header">
            <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#coll" aria-expanded="false">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="<?= base_url(); ?>" class="navbar-brand">Makinrajin</a>
        </div>
			<div class="collapse navbar-collapse navbar-right" id="coll">
	            <ul class="nav navbar-nav">
	            	<li class="<?= ($this->uri->segment(1) == 'contact') ? "active" : "" ; ?> navbar-font"><a href="<?= base_url('contact'); ?>">Contact</a></li>
	           	   	<li class="<?= ($this->uri->segment(1) == 'profile') ? "active" : "" ; ?> navbar-font"><a href="<?= base_url('profile'); ?>">Profile</a></li>
	               	<li class="<?= ($this->uri->segment(1) == 'login') ? "active" : "" ; ?> navbar-font"><a href="<?= base_url('login'); ?>">Login</a></li>
	               	<li class="<?= ($this->uri->segment(1) == 'register') ? "active" : "" ; ?> navbar-font"><a href="<?= base_url('register'); ?>">Register</a></li>
	            </ul>
	        </div>
		</div>
	</nav>
</body>
</html>