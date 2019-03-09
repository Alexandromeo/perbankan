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
        <li class="active">Login</li>
      </ul>
    </section>

    <section class="content">
      <div class="row konten">
        <center class="title">Data Login</center>
          <center>
          <table class="table-data">
            <thead>
              <tr>
                <td>Waktu Login</td>
                <td>Tanggal Login</td>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($login as $log)
              {
                  ?><tr>
                    <td><?= $log->jam; ?></td>
                    <td><?= $log->tanggal; ?></td>
                  </tr><?php
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