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
        if ($person['nama_lengkap'] != "")
        {
          $called = $person['nama_lengkap'];
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
               <li><a href="#ktp" data-toggle="tab">Ubah KTP</a></li>
               <li><a href="#kk" data-toggle="tab">Ubah KK</a></li>
               <li><a href="#password" data-toggle="tab">Ubah Password</a></li>
            </ul>
            <br>
     <div class="tab-content">
      <div class="active tab-pane" id="settings">
        <form class="form-horizontal" action="<?= base_url(); ?>member/profile" method="post">
          <div class="form-group">
            <div class="col-md-2 col-xs-12 col-sm-12">            
              <label>Email</label>
            </div>
            <div class="col-md-10 col-sm-12 col-xs-12">
              <input type="text" name="nim" readonly class="form-control" value="<?= $person['email']; ?>">
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-2 col-xs-12 col-sm-12">            
              <label>Nama Lengkap</label>
            </div>
            <div class="col-md-10 col-sm-12 col-xs-12">
              <input type="text" name="nama" class="form-control" value="<?= $person['nama_lengkap']; ?>">
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-2 col-xs-12 col-sm-12">            
              <label>Alamat</label>
            </div>
            <div class="col-md-10 col-sm-12 col-xs-12">
              <input type="text" name="alamat" class="form-control" value="<?= $person['alamat']; ?>">
            </div>
          </div>   

          <div class="form-group">
            <div class="col-md-12 col-xs-12 col-sm-12">            
              <button type="submit" name="ubahprofile" class="btn bg-purple btn-flat right"><i class="fa fa-edit"></i> Ubah Profile</button>
            </div>
          </div>          
        </form>
      </div>

      <div class="tab-pane" id="ktp">
      <?php
      if ($person['ktp']!="")
      {
        ?><center><img class="img-responsive img-size" src="<?= base_url('assets/image/ktp/'.$person[ktp]); ?>" alt="Foto KK <?= $person['ktp']; ?>"></center><?php
      }?>
        <form class="form-horizontal" action="<?= base_url(); ?>member/profile" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <div class="col-md-2 col-xs-12 col-sm-12">            
              <label>KTP</label>
            </div>
            <div class="col-md-10 col-sm-12 col-xs-12">
              <input type="file" name="ktp" class="form-control">
            </div>
          </div>
          
          <div class="form-group">
            <div class="col-md-12 col-xs-12 col-sm-12">            
              <button type="submit" name="ubahktp" class="btn bg-navy btn-flat right"><i class="fa fa-upload"></i> Upload KTP</button>
            </div>
          </div>
        </form>
      </div>

      <div class="tab-pane" id="kk">
      <?php
      if ($person['kk']!="")
      {
        ?><center><img class="img-responsive img-size" src="<?= base_url('assets/image/kk/'.$person[kk]); ?>" alt="Foto KK <?= $person['kk']; ?>"></center><?php
      }?>
        <form class="form-horizontal" action="profile" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <div class="col-md-2 col-xs-12 col-sm-12">            
              <label>KK</label>
            </div>
            <div class="col-md-10 col-sm-12 col-xs-12">
              <input type="file" name="kk" class="form-control">
            </div>
          </div>
          
          <div class="form-group">
            <div class="col-md-12 col-xs-12 col-sm-12">            
              <button type="submit" name="ubahkk" class="btn bg-green btn-flat right"><i class="fa fa-upload"></i> Upload KK</button>
            </div>
          </div>
        </form>
      </div>

      <div class="tab-pane" id="password">
        <form class="form-horizontal" action="<?= base_url(); ?>member/profile" method="post">
          <div class="form-group">
            <div class="col-md-2 col-xs-12 col-sm-12">            
              <label>Password Lama</label>
            </div>
            <div class="col-md-10 col-sm-12 col-xs-12">
              <input type="password" name="password_lama" class="form-control">
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-2 col-xs-12 col-sm-12">            
              <label>Password Baru</label>
            </div>
            <div class="col-md-10 col-sm-12 col-xs-12">
              <input type="password" name="password_baru" class="form-control">
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-2 col-xs-12 col-sm-12">            
              <label>Ulang Password Baru</label>
            </div>
            <div class="col-md-10 col-sm-12 col-xs-12">
              <input type="password" name="ulang_password" class="form-control">
            </div>
          </div> 

          <div class="form-group">
            <div class="col-md-12 col-xs-12 col-sm-12">            
              <button type="submit" name="ubahpassword" class="btn bg-orange btn-flat right"><i class="fa fa-edit"></i> Ubah Password</button>
            </div>
          </div>  
        </form>        
      </div>


      </div>
    </section>
  </div>
</div>
</div>
<?php include "v_footer.php"; ?>
</body>
</html>