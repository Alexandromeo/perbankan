<?php
include "v_header.php"; 
include "v_sidebar.php";
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php
          if (NOW>=03 && NOW<=10)
            echo "Selamat pagi";
          else if(NOW>=11 && NOW<=14)
            echo "Selamat siang";
          else if(NOW>=15 && NOW<=18)
            echo "Selamat sore";
          else if(NOW>=19 && NOW<=22)
            echo "Selamat malam";
        if ($person['nama'] != "")
        {
          $called = $person['nama'];
          echo ", <b>".$called."</b>";
        }
        ?>
      </h1>
      <ul class="breadcrumb">
        <li>Beranda</li>
        <li class="active">Profil</li>
      </ul>
    </section>

    <section class="content">
      <?php
      if ($_GET['s'])
      {
        ?><div class="alert alert-sukses">
          <i class="fa fa-check"></i><?= base64_decode($_GET['s']); ?>
        </div><?php
      }

      else if ($_GET['m'])
      {
        ?><div class="alert alert-error">
          <i class="fa fa-ban"></i><?= base64_decode($_GET['m']); ?>
        </div><?php
      }?>
      <div class="row konten">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
               <li class="active"><a href="#settings" data-toggle="tab">Ubah Profile</a></li>
               <li><a href="#password" data-toggle="tab">Ubah Password</a></li>
               <li><a href="#foto" data-toggle="tab">Ubah Foto</a></li>
            </ul>
            <br>
     <div class="tab-content">
      <div class="active tab-pane" id="settings">
        <form class="form-horizontal" action="<?= base_url(); ?>admin/profile" method="post">
          <div class="form-group">
            <div class="col-md-2 col-xs-12 col-sm-12">            
              <label>Nama Lengkap</label>
            </div>
            <div class="col-md-10 col-sm-12 col-xs-12">
              <input type="text" name="nama" class="form-control" value="<?= $person['nama']; ?>">
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-2 col-xs-12 col-sm-12">            
              <label>Tempat, Tanggal Lahir</label>
            </div>
            <?php require "input_date.php"; ?>
          </div>      

          <div class="form-group">
            <div class="col-md-12 col-xs-12 col-sm-12">            
              <button type="submit" name="ubahprofile" class="btn bg-purple btn-flat right"><i class="fa fa-edit"></i> Ubah Profile</button>
            </div>
          </div>          
        </form>
      </div>

      <div class="tab-pane" id="password">
        <form class="form-horizontal" action="<?= base_url(); ?>admin/profile" method="post">
          <div class="form-group">
            <div class="col-md-2 col-xs-12 col-sm-12">            
              <label>Password Lama</label>
            </div>
            <div class="col-md-10 col-sm-12 col-xs-12">
              <input type="password" name="old" class="form-control">
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-2 col-xs-12 col-sm-12">            
              <label>Password Baru</label>
            </div>
            <div class="col-md-10 col-sm-12 col-xs-12">
              <input type="password" name="new" class="form-control">
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-2 col-xs-12 col-sm-12">            
              <label>Ulang Password Baru</label>
            </div>
            <div class="col-md-10 col-sm-12 col-xs-12">
              <input type="password" name="re" class="form-control">
            </div>
          </div> 

          <div class="form-group">
            <div class="col-md-12 col-xs-12 col-sm-12">            
              <button type="submit" name="ubahpassword" class="btn bg-orange btn-flat right"><i class="fa fa-edit"></i> Ubah Password</button>
            </div>
          </div>  
        </form>        
      </div>

      <div class="tab-pane" id="foto">
        <form class="form-horizontal" action="<?= base_url(); ?>admin/profile" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <div class="col-md-2 col-xs-12 col-sm-12">            
              <label>Foto</label>
            </div>
            <div class="col-md-10 col-sm-12 col-xs-12">
              <input type="file" name="foto" class="form-control">
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-12 col-xs-12 col-sm-12">            
              <button type="submit" name="ubahfoto" class="btn bg-green btn-flat right"><i class="fa fa-upload"></i> Upload Foto</button>
            </div>
          </div>  
      </div>

      </div>
    </section>
  </div>
</div>
</div>
<?php include "v_footer.php"; ?>
</body>
</html>