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
        <li>Histori</li>
        <li class="active">Pengisian</li>
      </ul>
    </section>

    <section class="content">
      <div class="row konten">
        <center class="title">Data Pengisian</center>
          <center>
          <table class="table-data">
            <thead>
              <tr>
                <td>Nominal</td>
                <td>Waktu</td>
                <td>Tanggal</td>
                <td>Status</td>
              </tr>
            </thead>
            <tbody>
              <?php
              if (count($topup)>0)
              {
                foreach($topup as $log)
                {
                    ?><tr>
                      <td>Rp<?= number_format($log->nominal,"0",".","."); ?></td>
                      <td><?= $log->jam; ?></td>
                      <td><?= $log->tanggal; ?></td>
                      <td><?= $log->approval == 1 ? "Success" : "Waiting for admin"; ?></td>
                    </tr><?php
                }
              }

              else
              {
                  ?><tr><td colspan="4"><center>Tidak ada data pengisian</center></td></tr><?php
              }?>
            </tbody>
          </table>
          </center>
      </div>
    </section>
  </div>
</div>
</div>
<?php include "v_footer.php"; ?>
</body>
</html>