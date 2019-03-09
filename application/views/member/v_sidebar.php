
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          
        </div>
        <div class="pull-left info">
          <p><?= explode(" ", $person['nama_lengkap'])[0]; ?></p>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form"></form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree"> 
        <li class=<?= $this->uri->segment(2) == "" ? "active" : ""; ?>>
          <a href="<?= base_url('member/'); ?>">
            <i class="fa fa-dashboard fa-flag"></i> 
              <span>Beranda</span>
          </a>
        </li>

        <li class=<?= $this->uri->segment(2) == "profile" ? "active" : ""; ?>>
          <a href="<?= base_url('member/profile'); ?>">
            <i class="fa fa-user"></i> <span>Profil</span>
            <?php
            if ($person['ktp']=="" || $person['kk']=="" || $person['nama_lengkap']=="" || $person['alamat']=="")
            {
                ?><span class="right sidebar-warn"><i class="fa fa-warning"></i></span><?php
            }?>
          </a>
        </li>

        <li class=<?= $this->uri->segment(2) == "rekening" ? "active" : ""; ?>>
          <?php
          if ($person['ktp']=="" || $person['kk']=="" || $person['nama_lengkap']=="" || $person['alamat']=="")
          {
              ?><a id="review" href="" data-toggle="modal" data-target="#modalReview">
                <i class="fa fa-bank"></i> <span>Rekening</span>
                <span class="right sidebar-warn"><i class="fa fa-lock"></i></span>
              </a><?php
          }

          else
          {
              ?><a href="<?= base_url('member/rekening'); ?>">
                <i class="fa fa-bank"></i> <span>Rekening</span>
                <span class="right sidebar-warn"><i class="fa fa-lock-open"></i></span>
              </a><?php
          }?>
        </li>        

        <?php
        if ($rekening['jenis']=="Regular")
        {
          ?><li class=<?= $this->uri->segment(2) == "atm" ? "active" : ""; ?>>
            <a href="<?= base_url('member/atm'); ?>">
              <i class="fa fa-credit-card"></i> 
                <span>ATM</span>
            </a>
          </li><?php
        }?>

        <?php
        if ($rekening['jenis']!="")
        {
          ?><li class=treeview <?= $this->uri->segment(2) == "histori" ? "active" : ""; ?>>
              <a href="#">
                <i class="fa fa-history"></i> 
                  <span>Histori</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
              </a>

              <ul class="treeview-menu">
                <li>
                  <a href="<?= base_url('member/histori/login'); ?>">
                    <i class="glyphicon glyphicon-log-in"></i> <span>Login</span>
                  </a>
                </li>

                <li>
                  <a href="<?= base_url('member/histori/penarikan'); ?>">
                    <i class="fa fa-hand-paper"></i> <span>Penarikan</span>
                  </a>
                </li>

                <li>
                  <a href="<?= base_url('member/histori/pengisian'); ?>">
                    <i class="fa fa-gift"></i> <span>Pengisian</span>
                  </a>
                </li>

                <?php
                if ($rekening['jenis']!="Investasi")
                {
                  ?><li>
                  <a href="<?= base_url('member/histori/transfer'); ?>">
                    <i class="fa fa-send"></i> <span>Transfer</span>
                  </a>
                  </li><?php
                }?>
              </ul>
          </li><?php
        }?>

        <li>
          <a href="<?= base_url('logout'); ?>">
            <i class="glyphicon glyphicon-log-out"></i> <span>Keluar</span>
          </a>
        </li>        
      </ul>
    </section>
  </aside>


            <div id="modalReview" class="modal fade" role="dialog">
               <div class="modal-dialog">
              <!-- konten modal-->
                <div class="modal-content">
                <!-- heading modal -->
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Profil Anda belum lengkap</h4>
                  </div>
                <!-- body modal -->
                  <div class="modal-body">
                     <p>Lengkapi profil Anda <a href="<?= base_url('member/profile'); ?>">di sini</a> sebelum membuka rekening.</p>
                  </div>
                  <!-- footer modal -->
                  <div class="modal-footer"></div>
                </div>
               </div>
            </div>