<?php
error_reporting(0);
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
        <li class="active">Detail</li>
      </ul>
    </section>

    <section class="content">
      <div class="row konten">
      <center><span style="font-size: 20px;">Detail Transaksi</span></center>
        <div class="table-responsive">
          <form class="form-horizontal" action="<?= base_url('member/detail'); ?>" method="post">
            <table class="table table-bordered table-striped table-hover">
              <tr>
                <td>Nama Pengirim</td>
                <th>
                 <?= $person['nama_lengkap']; ?>
                  <input type="hidden" name="pengirim" value="<?= $person['nama_lengkap']; ?>">
                </th>
              </tr>
              <tr>
                <td>No. Rekening Pengirim</td>
                <th>
                  <?= $sender['no_rek']; ?>
                  <input type="hidden" name="asal" value="<?= $sender['no_rek']; ?>">
                  <input type="hidden" name="saldo" value="<?= $sender['saldo']; ?>">
                </th>
              </tr>
              <tr>
                <td>Nominal Pengiriman</td>
                <th>
                  Rp<?= number_format($amount,"0",".","."); ?>
                  <input type="hidden" name="nominal" value="<?= $amount; ?>">
                </th>
              </tr>
              <tr>
                <td>Nama Penerima</td>
                <th>
                  <?= $info['nama_lengkap']; ?>
                  <input type="hidden" name="penerima" value="<?= $info['nama_lengkap']; ?>">
                </th>
              </tr>
              <tr>
                <td>No. Rekening Penerima</td>
                <th>
                 <?= $receiver['no_rek']; ?>
                  <input type="hidden" name="tujuan" value="<?= $receiver['no_rek']; ?>">
                  <input type="hidden" name="saldopenerima" value="<?= $receiver['saldo']; ?>">
                </th>
              </tr>
            </table>
              
                <div class="col-md-12 col-xs-12 col-sm-12">            
                  <button type="submit" name="trf" class="btn bg-purple btn-flat right"><i class="fa fa-send"></i> Transfer</button>
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