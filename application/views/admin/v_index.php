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
      if ($_GET['m'])
      {
        ?><div class="alert alert-error">
          <i class="fa fa-ban"></i><?= base64_decode($_GET['m']); ?>
          </div><?php
      }
      ?>
      <div class="row">
      <?php
      if ($rekening['pemilik']!="")
      {
        ?><div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-teal"><i class="fa fa-bank"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Jenis Tabungan</span>
              <span class="info-box-number"><?= $rekening['jenis']; ?></span>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Jumlah Saldo</span>
              <span class="info-box-number">Rp<?= number_format($rekening['saldo'],"0",".","."); ?></span>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-orange"><i class="fa fa-gear"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Nomor Rekening</span>
              <span class="info-box-number"><?= $rekening['no_rek']; ?></span>
            </div>
          </div>
        </div><?php
      }?>
      </div>
    </section>
  </div>
</div>
<?php include "v_footer.php"; ?>
</body>
</html>