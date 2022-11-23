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
              <h4 class="text-blue h4">Form Input Data User</h4>
              <p class="mb-30">Perbarui data user dengan form dibawah</p>
            </div>
            <div class="pull-right">
              <button class="btn btn-primary btn-lg" role="submit"><i class="fa fa-user-plus"></i> Perbarui Data User</button>
            </div>
          </div>
          <?php flash(); ?>
          <input type="hidden" name="id" value="<?= $data['user']->id ?>">
          <div class="form-group">
            <label>NIP</label>
            <input class="form-control" type="text" placeholder="" value="<?= $data['user']->nip ?>" name="nip" />
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input class="form-control" type="text" placeholder="" value="<?= $data['user']->nama ?>" name="nama" />
          </div>
          <div class="form-group">
            <label>Email</label>
            <input class="form-control" type="email" placeholder="" value="<?= $data['user']->email ?>" name="email" />
          </div>
          <div class="form-group">
            <label>No. HP</label>
            <input class="form-control" type="text" placeholder="" value="<?= $data['user']->no_hp ?>" name="no_hp" />
          </div>
          <div class="form-group">
            <label>Password Baru</label> <label class="text-danger">*tidak perlu diisi apabila tidak ganti password</label>
            <input class="form-control" type="text" placeholder="" value="" name="password" />
          </div>
          <div class="form-group">
            <label>Jenis Kelamin</label>
            <div class="custom-control custom-radio mb-5">
              <input type="radio" name="jenis_kelamin" value="Pria" class="custom-control-input" <?php echo ($data['user']->jenis_kelamin == 'Pria') ? 'checked' : ''; ?>>
              <label class="custom-control-label" for="customRadio1">Laki - Laki / Pria</label>
            </div>
            <div class="custom-control custom-radio mb-5">
              <input type="radio" name="jenis_kelamin" value="Wanita" class="custom-control-input" <?php echo ($data['user']->jenis_kelamin == 'Wanita') ? 'checked' : ''; ?>>
              <label class="custom-control-label" for="customRadio2">Perempuan / Wanita</label>
            </div>
          </div>
        </form>
      </div>
      <!-- horizontal Basic Forms End -->

      <?php require APPROOT . '/views/layouts/footer.php'; ?>