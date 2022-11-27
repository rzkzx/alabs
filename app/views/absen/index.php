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
                <li class="breadcrumb-item active" aria-current="page">
                  <?= $data['title'] ?>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>

      <div class="row clearfix">
        <div class="col-md-4 col-sm-12 mb-30">
          <div class="card-box pd-20">
            <form action="<?= URLROOT; ?>/profile/changeProfile" method="post" enctype="multipart/form-data">
              <div class="clearfix">
                <div class="pull-left">
                </div>
                <div class="pull-right">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12">
                  <div class="avatar-preview" style="margin:0 auto;width:150px;height:150px;">
                    <div style="background-image: url(<?= URLROOT; ?>/images/avatar/<?php echo ($_SESSION['avatar']) ? $_SESSION['avatar'] : 'dummy.png'; ?>);">
                    </div>
                  </div>
                </div>
              </div>
              <h5 class="text-center h5 mb-0"><?= $_SESSION['nama'] ?></h5>
              <p class="text-center text-muted font-18">
                <?= $_SESSION['nip'] ?>
              </p>
              <div class="profile-info">
                <h5 class="mb-20 h5 ">Contact Information</h5>
                <ul>
                  <li>
                    <span class="text-secondary">Email Address:</span>
                    <?= $_SESSION['email'] ?>
                  </li>
                  <li>
                    <span class="text-secondary">Nomor HP:</span>
                    <?= $_SESSION['no_hp'] ?>
                  </li>
                </ul>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-8 col-sm-12 mb-30">
          <div class="card card-box">
            <h5 class="card-header weight-500"><i class="fa fa-clock-o"></i> Absensi</h5>
            <div class="card-body">
              <form action="<?= URLROOT; ?>/profile/changePassword" method="post" enctype="multipart/form-data">
                <div class="datetime" style="text-align: center;">
                  <h1 class="" style="margin-bottom: 10px;"><?= date('H:i'); ?></h1>
                  <h4 class=""> <?= dayID(date('Y-m-d')); ?>, <?= dateID(date('Y-m-d')); ?></h4>
                </div>
                <hr class="mb-30 mt-30">
                <div class="row clearfix">
                  <div class="col-md-6 col-sm-12 ">
                    <div class="card card-box">
                      <h5 class="card-header weight-500"><i class="fa fa-clock-o"></i> Absen Datang</h5>
                      <div class="card-body">
                        <p class="card-text mb-0">Jam Datang : <b class="text-success">08:00 - 08:20</b> </p>
                        <p class="card-text">Status Kehadiran : <b class="text-danger">Belum Absen</b> </p>
                        <div style="text-align:center;padding:20px;">
                          <button type="button" class="btn btn-success btn-lg">
                            Absen Sekarang
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12 ">
                    <div class="card card-box">
                      <h5 class="card-header weight-500"><i class="fa fa-clock-o"></i> Absen Pulang</h5>
                      <div class="card-body">
                        <p class="card-text mb-0">Jam Datang : <b class="text-success">17:00 - 18:00</b> </p>
                        <p class="card-text">Status Kehadiran : <b class="text-danger">Belum Absen</b> </p>
                        <div style="text-align:center;padding:20px;">
                          <button type="button" class="btn btn-success btn-lg">
                            Absen Sekarang
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <?php require APPROOT . '/views/layouts/footer.php'; ?>