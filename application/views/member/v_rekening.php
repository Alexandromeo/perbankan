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
        <li class="active">Data Rekening</li>
      </ul>
    </section>

    <section class="content">
    <?php
      if ($_GET['m'])
      {
        ?><div class="alert alert-error">
          <i class="fa fa-ban"></i><?= base64_decode($_GET['m']); ?>
          </div><?php
      }

      if ($_GET['s'])
      {
        ?><div class="alert alert-error">
          <i class="fa fa-ban"></i><?= base64_decode($_GET['s']); ?>
          </div><?php
      }?>
      <div class="row konten">
        <form class="form-horizontal" method="post">
          <div class="form-group">
            <div class="col-lg-4 col-md-12 col-xs-12 col-sm-12">            
              <label>Jenis Tabungan</label>
              <select id="jenis" name="jenis" class="form-control">
                <option value="">Pilih Jenis Tabungan</option>
                <option value="Regular">Regular</option>
                <option value="Investasi">Investasi</option>
              </select>
            </div>

            <div class="col-md-4 col-xs-12 col-sm-12">
              <label>Pengisian Pertama</label>
              <input type="number" id="pengisian" value="0" name="saldo" class="form-control">
            </div>  

            <div class="col-md-4 col-xs-12 col-sm-12 hide atm">
              <label>PIN ATM</label>
              <input type="password" name="pin" class="form-control">
            </div>                       
          </div>

          <div class="form-group">
            <div class="col-md-12 col-xs-12 col-sm-12 keterangan-tabungan"></div> 
          </div>

          <div class="form-group">
            <div class="col-md-12 col-xs-12 col-sm-12">            
              <button type="submit" name="buatrekening" class="btn bg-yellow btn-flat right"><i class="fa fa-plus"></i> Buat Rekening</button>
            </div>
          </div> 
        </form>
      </div>
    </section>
  </div>
</div>
</div>
<?php include "v_footer.php"; ?>
</body>
</html>