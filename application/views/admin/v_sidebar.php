
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img class="img-responsive" alt="User Profile" src="<?= base_url('assets/image/admin/'.$person[foto]); ?>">
        </div>
        <div class="pull-left info">
          <p><?= explode(" ", $person['nama'])[0]; ?></p>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form"></form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree"> 
        <li class=<?= $this->uri->segment(2) == "" ? "active" : ""; ?>>
          <a href="<?= base_url('admin/'); ?>">
            <i class="fa fa-dashboard fa-flag"></i> 
              Homepage
          </a>
        </li>

        <li class=<?= $this->uri->segment(2) == "profile" ? "active" : ""; ?>>
          <a href="<?= base_url('admin/profile'); ?>">
            <i class="fa fa-user"></i> <span>Profile</span>
            <?php
            if ($person['nama']=="")
            {
                ?><span class="right sidebar-warn"><i class="fa fa-warning"></i></span><?php
            }?>
          </a>
        </li>       

        <li>
          <a href="<?= base_url('logout'); ?>">
            <i class="glyphicon glyphicon-log-out"></i> <span>Log Out</span>
          </a>
        </li>        
      </ul>
    </section>
  </aside>