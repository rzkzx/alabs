<div class="left-side-bar">
  <div class="brand-logo">
    <a href="<?= URLROOT; ?>/dashboard">
      <img src="<?= URLROOT; ?>/images/logo/alabs-black.png" alt="" class="ALABS Dark Logo" />
    </a>
    <div class="close-sidebar" data-toggle="left-sidebar-close">
      <i class="ion-close-round"></i>
    </div>
  </div>
  <div class="menu-block customscroll">
    <div class="sidebar-menu">
      <ul id="accordion-menu">
        <li>
          <a href="<?= URLROOT; ?>/admin/dashboard" class="dropdown-toggle no-arrow <?php echo ($data['menu'] == 'Dashboard') ? 'active' : ''; ?>">
            <span class="micon bi-grid-fill"></span><span class="mtext">Dashboard</span>
          </a>
        </li>
        <?php 
        if(Middleware::admin()){ ?>
        <li>    
          <a href="<?= URLROOT; ?>/konfirmasi" class="dropdown-toggle no-arrow <?php echo ($data['menu'] == 'Konfirmasi Absensi') ? 'active' : ''; ?>">
            <span class="micon bi bi-calendar-check"></span><span class="mtext">Konfirmasi</span>
          </a>
        </li>
        <?php
        }else{
          ?>
        <li>
          <a href="<?= URLROOT; ?>/absen" class="dropdown-toggle no-arrow <?php echo ($data['menu'] == 'Absen') ? 'active' : ''; ?>">
            <span class="micon bi bi-calendar-check"></span><span class="mtext">Absen</span>
          </a>
        </li>
        <?php
        }
        ?>
        <li>
          <?php if (Middleware::admin()) {
            $linkRiwayat = 'riwayat/users';
          } else {
            $linkRiwayat = 'riwayat';
          } ?>
          <a href="<?= URLROOT; ?>/<?= $linkRiwayat ?>" class="dropdown-toggle no-arrow <?php echo ($data['menu'] == 'Riwayat Absensi') ? 'active' : ''; ?>">
            <span class="micon bi bi-calendar-week"></span><span class="mtext">Riwayat Absensi</span>
          </a>
        </li>
        <?php if (Middleware::admin()) {
        ?>
          <li>
            <a href="<?= URLROOT; ?>/users" class="dropdown-toggle no-arrow <?php echo ($data['menu'] == 'Daftar Pengguna') ? 'active' : ''; ?>">
              <span class="micon bi bi-people-fill"></span><span class="mtext">Daftar Pengguna</span>
            </a>
          </li>
        <?php } ?>
        <li>
          <a href="<?= URLROOT; ?>/profile" class="dropdown-toggle no-arrow <?php echo ($data['menu'] == 'Profile') ? 'active' : ''; ?>">
            <span class="micon bi bi-person-fill"></span><span class="mtext">Profile</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
<div class="mobile-menu-overlay"></div>