<!DOCTYPE html>
<html>

<head>
  <!-- Basic Page Info -->
  <meta charset="utf-8" />
  <title>ALABS - Aplikasi Laporan Absensi</title>

  <!-- Site favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="<?= URLROOT; ?>/images/logo/humas.png" />
  <link rel="icon" type="image/png" sizes="32x32" href="<?= URLROOT; ?>/images/logo/humas.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="<?= URLROOT; ?>/images/logo/humas.png" />

  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="<?= URLROOT; ?>/styles/core.css" />
  <link rel="stylesheet" type="text/css" href="<?= URLROOT; ?>/styles/icon-font.min.css" />
  <link rel="stylesheet" type="text/css" href="<?= URLROOT; ?>/plugins/datatables/css/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet" type="text/css" href="<?= URLROOT; ?>/plugins/datatables/css/responsive.bootstrap4.min.css" />
  <link rel="stylesheet" type="text/css" href="<?= URLROOT; ?>/styles/style.css" />
  <link rel="stylesheet" type="text/css" href="<?= URLROOT; ?>/plugins/sweetalert2/sweetalert2.min.css" />

  <style>
    .btn-aksi-danger:hover {
      color: red;
    }

    .btn-aksi-info:hover {
      color: green;
    }

    .btn-aksi-primary:hover {
      color: blue;
    }
  </style>

</head>

<body class="header-dark sidebar-dark">

  <div class="header">
    <div class="header-left">
      <div class="menu-icon bi bi-list"></div>
    </div>
    <div class="header-right">
      <div class="user-info-dropdown">
        <div class="dropdown">
          <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
            <span class="user-icon">
              <?php if ($_SESSION['avatar']) { ?>
                <img src="<?= URLROOT; ?>/images/avatar/<?= $_SESSION['avatar']; ?>" alt="Avatar-<?= $_SESSION['nip'] ?>" />
              <?php } else {
              ?>
                <img src="<?= URLROOT; ?>/images/avatar/dummy.png" alt="Dummy Avatar" />
              <?php } ?>
            </span>
            <span class="user-name"><?= $_SESSION['nama'] ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
            <a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Profile</a>
            <a class="dropdown-item" href="<?= URLROOT; ?>/login/logout"><i class="dw dw-logout"></i> Log Out</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php require APPROOT . '/views/layouts/sidebar.php'; ?>