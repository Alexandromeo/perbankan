<?php
$list = array
        (
          1=>'Januari',
          2=>'Februari',
          3=>'Maret',
          4=>'April',
          5=>'Mei',
          6=>'Juni',
          7=>'Juli',
          8=>'Agustus',
          9=>'September',
          10=>'Oktober',
          11=>'November',
          12=>'Desember'
        );
$borndate = explode(" ", $person['tanggal_lahir']); ?>
  <div class="col-lg-2 col-md-2 col-xs-12 col-sm-12">            
    <input placeholder="Kota lahir..." type="text" name="tempat_lahir" class="form-control" value="<?= $person['tempat_lahir']; ?>">
  </div>

  <div class="col-md-3 col-md-3 col-sm-4 col-xs-4">
    <select class="form-control opsitahun" id="thn" name="tahun_lahir">
      <option value="">Pilih tahun</option>
    <?php for($i=2000; $i>=1900; $i--)
    {
      ?><option value="<?= $i; ?>" <?=$i==$borndate[2] ? "selected" : ""; ?>><?= $i; ?></option><?php
    }?>
    </select>   
  </div>

  <div class="col-md-3 col-md-3 col-sm-4 col-xs-4">
    <select class="form-control opsibulan" id="bln" name="bulan_lahir">
      <option value="">Pilih bulan</option>
    <?php for ($i=1; $i<=12; $i++)
    {
      ?><option <?= $i==$borndate[1] ? "selected" : ""; ?> value="<?= $i; ?>"><?= $list[$i]; ?></option><?php
    }?>
    </select>
  </div>

  <div class="col-md-2 col-md-2 col-sm-4 col-xs-4">
    <select class="form-control opsitanggal" id="tanggalan" name="tanggal_lahir">
      <option value="">Pilih tanggal</option>
    <?php 
    if ($borndate[1]==2)
    {
      if ($borndate[2]%4==0)
        $lim = 29;
      else
        $lim = 28;
    }

    else if(in_array($borndate[1], $c))
      $lim = 31;
    else
      $lim = 30;


    for($i=1; $i<=$lim; $i++)
    {
      ?><option <?= $i==$borndate[0] ? "selected" : ""; ?> class="<?= $i; ?> tgl" value="<?= $i; ?>"><?= $i; ?></option><?php
    }?>
    </select>
  </div>