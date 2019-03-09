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
        ?><div class="alert alert-sukses">
          <i class="fa fa-check"></i><?= base64_decode($_GET['s']); ?>
          </div><?php
      }?>
      <div class="row konten">
        <form class="form-horizontal" method="post" action="<?= base_url('member/detail'); ?>">
          <div class="form-group">
            <div class="col-lg-3 col-md-12 col-xs-12 col-sm-12">            
              <label>Jenis Tabungan</label>
              <input type="text" class="form-control" readonly name="jenis" value="<?= $rekening['jenis']; ?>">
            </div>

            <div class="col-lg-3 col-md-12 col-xs-12 col-sm-12">            
              <label>No. Rekening</label>
              <input type="text" class="form-control" readonly name="no_rek" value="<?= $rekening['no_rek']; ?>">
            </div>

            <div class="col-md-3 col-xs-12 col-sm-12">
              <label>Saldo Sekarang</label>
              <input type="text" class="form-control" readonly name="saldo" value="Rp<?= number_format($rekening['saldo'],"0",".","."); ?>" >
            </div>

            <div class="col-lg-3 col-md-12 col-xs-12 col-sm-12">            
              <label>Saldo Minimal</label>
              <?php $minim = $rekening['jenis'] == "Regular" ? 20000 : 200000; ?>
              <input type="text" class="form-control" readonly name="no_rek" value="Rp<?= number_format($minim,"0",".","."); ?>">
            </div>
          </div>         

          <div class="form-group">
            <div class="col-lg-6 col-md-12 col-xs-12 col-sm-12">            
              <label>Aksi</label>
              <select id="aksi" name="aksi" class="form-control">
                <option value="">Pilih Aksi</option>
                <?= $rekening['jenis'] == "Regular" ? "<option value='kirim'>Transfer Uang</option>" : "" ; ?>
                <option value="tambah">Tambah Saldo</option>
                <option value="tarik">Tarik Uang</option>
              </select>
            </div>

            <div class="col-lg-6 col-md-12 col-xs-12 col-sm-12">            
              <label>Nominal</label>
              <div class="input-group">
                <span class="input-group-addon">Rp.</span>
                <input type="text" class="form-control" name="nominal">
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-12 col-xs-12 col-sm-12 alamat hide">
              <label class="info-label"></label>
              <input type="text" class="form-control" name="alamat">
            </div>
          </div> 

          <div class="form-group">
            <div class="col-md-12 col-xs-12 col-sm-12">            
              <button type="submit" name="aksirekening" class="btn bg-green btn-flat right"><i class="fa fa-plus"></i> Submit</button>
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