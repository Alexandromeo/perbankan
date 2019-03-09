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
        <li class="active">ATM</li>
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
      <center><span class="title">Transfer</span></center>
      	<form method="post" action="<?= base_url('member/detail'); ?>" class="form-horizontal">
      		<div class="form-group">
            <div class="col-lg-4 col-md-12 col-xs-12 col-sm-12"> 
          			<label>No. Rekening Tujuan</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                    <input type="text" name="tujuan" class="form-control">
                  </div>
            </div>

            <div class="col-lg-4 col-md-12 col-xs-12 col-sm-12"> 
             <label>Nominal</label>
              <div class="input-group">
                <span class="input-group-addon">Rp</span>
                <input type="text" name="nominal" class="form-control">
              </div>
            </div>

            <div class="col-lg-4 col-md-12 col-xs-12 col-sm-12"> 
             <label>PIN</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="password" name="pin" class="form-control">
              </div>
            </div>

      		</div>

          <div class="form-group">
            <div class="col-md-12 col-xs-12 col-sm-12">            
              <button type="submit" name="transfer" class="btn bg-navy btn-flat right"><i class="fa fa-send"></i> Transfer</button>
            </div>
          </div> 
      	</form>

       <div>
        <hr noshade width="30%"><span class="title"><center>ATAU</center></span><hr noshade width="30%">
       </div>

        <center><span class="title">Tarik Tunai</span></center>
          <form method="post" action="<?= base_url('member/detail'); ?>" class="form-horizontal">
            <div class="form-group">
              <div class="col-lg-4 col-md-12 col-xs-12 col-sm-12"> 
                  <label>Nominal</label>
                    <div class="input-group">
                      <span class="input-group-addon">Rp</span>
                      <input type="text" name="nominal" class="form-control">
                    </div>
              </div>

              <div class="col-lg-4 col-md-12 col-xs-12 col-sm-12"> 
               <label>PIN</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                  <input type="password" name="pin" class="form-control">
                </div>
              </div>

            </div>

            <div class="form-group">
              <div class="col-md-12 col-xs-12 col-sm-12">            
                <button type="submit" name="tarikatm" class="btn bg-blue btn-flat right"><i class="fa fa-hand-paper"></i> Tarik Tunai</button>
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