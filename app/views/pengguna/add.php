<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="main-container">
  <div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
      <div class="page-header">
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="title">
              <h4><?= $data['title'] ?></h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="<?= URLROOT; ?>/dsahboard">Home</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                  <a href="<?= URLROOT; ?>/users">Daftar Pengguna</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  <?= $data['title'] ?>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
      <!-- horizontal Basic Forms Start -->
      <div class="pd-20 card-box mb-30">
        <form action="" method="post" enctype="multipart/form-data">
          <div class="clearfix">
            <div class="pull-left">
              <h4 class="text-blue h4">Form Input Pengguna Baru</h4>
              <p class="mb-30">Password otomatis menyesuaikan NIP</p>
            </div>
            <div class="pull-right">
              <button class="btn btn-primary btn-lg" role="submit"><i class="fa fa-user-plus"></i> Tambah Pengguna Baru</button>
            </div>
          </div>
          <?php flash(); ?>
          <div class="form-group">
            <label>NIP</label>
            <input class="form-control" type="text" placeholder="" name="nip" />
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input class="form-control" type="text" placeholder="" name="nama" />
          </div>
          <div class="form-group">
            <label>Email</label>
            <input class="form-control" type="email" placeholder="" name="email" />
          </div>
          <div class="form-group">
            <label>No. HP</label>
            <input class="form-control" type="text" placeholder="" name="no_hp" />
          </div>
          <div class="form-group">
            <label>Jenis Kelamin</label>
            <div class="custom-control custom-radio mb-5">
              <input type="radio" name="jenis_kelamin" value="Pria" class="custom-control-input" checked>
              <label class="custom-control-label" for="customRadio1">Laki - Laki / Pria</label>
            </div>
            <div class="custom-control custom-radio mb-5">
              <input type="radio" name="jenis_kelamin" value="Wanita" class="custom-control-input">
              <label class="custom-control-label" for="customRadio2">Perempuan / Wanita</label>
            </div>
          </div>
        </form>
      </div>
      <!-- horizontal Basic Forms End -->

      <?php require APPROOT . '/views/layouts/footer.php'; ?>