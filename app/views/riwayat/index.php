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
                  <a href="<?= URLROOT; ?>/admin/">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  <?= $data['title'] ?>
                </li>
              </ol>
            </nav>
          </div>

        </div>
      </div>
      <div class="card card-box mb-30">
        <div class="card-header">Profil User</div>
        <div class="card-body row" style="align-items: center;">
          <div class="avatar-preview" style="margin-left:20px;width:150px;height:150px;">
            <div style="background-image: url(<?= URLROOT; ?>/images/avatar/<?php echo ($data['user']->avatar) ? $data['user']->avatar : 'dummy.png'; ?>);">
            </div>
          </div>
          <div class="pd-20">
            <table class="data-user-riwayat">
              <tr>
                <td>Nama</td>
                <td>:</td>
                <td class="info"><?= $data['user']->nama ?></td>
              </tr>
              <tr>
                <td>NIP</td>
                <td>:</td>
                <td class="info"><?= $data['user']->nip ?></td>
              </tr>
              <tr>
                <td>Email</td>
                <td>:</td>
                <td class="info"><?= $data['user']->email ?></td>
              </tr>
              <tr>
                <td>No HP</td>
                <td>:</td>
                <td class="info"><?= $data['user']->no_hp ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <!-- Simple Datatable start -->
      <div class="card-box mb-30">
        <div class="pb-20 pt-20">
          <?php flash(); ?>
          <div class="d-flex flex-row align-items-center m-3" style="justify-content: space-between;">
            <a href="<?= URLROOT ?>/riwayat/export/<?= $data['user']->nip ?>" target="_blank" class="btn btn-info">PRINT</a>
            <form class="form-inline" method="POST" action="">
              <input type="month" class="form-control mr-2" placeholder="" name="date" value="<?php echo isset($_POST['date']) ? $_POST['date'] : '' ?>" />
              <button class="btn btn-primary mr-2" name="filter"><span class="fa fa-filter"></span></button>
            </form>
          </div>
          <table class="table hover stripe data-tableee nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th class="table-plus datatable-nosort">Jam Masuk</th>
                <th class="table-plus datatable-nosort">Jam Pulang</th>
                <th class="table-plus datatable-nosort">Total Jam Kerja</th>
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($data['riwayat'] as $absen) {
                if ($absen->keterangan == 'Hadir') {
                  $badge = 'success';
                } elseif ($absen->keterangan == 'Izin') {
                  $badge = 'warning';
                } else {
                  $badge = 'danger';
                }

                if (!$absen->jam_pulang) {
                  $jam_pulang = '<span class="text-danger">Tidak Absen</span>';
                } else {
                  $jam_pulang = timeFilter($absen->jam_pulang);
                }

                $total_jam = strtotime($absen->jam_pulang) - strtotime($absen->jam_masuk);
                $total_jam = $total_jam / 60;
                if ($total_jam < 480) {
                  $jamkerja = 480 - $total_jam;
                  $total_jam = '<span class="text-danger">Kurang ' . $jamkerja . ' Menit Kerja</span>';
                } else {
                  $total_jam = $total_jam . ' Menit Kerja';
                }
                if ($absen->keterangan != 'Hadir') {
                  $total_jam = '<span class="text-danger">Tidak Hadir</span>';
                }
              ?>
                <tr>
                  <td><?= $no ?></td>
                  <td><?= dayID($absen->tanggal) ?>, <?= dateID($absen->tanggal) ?></td>
                  <td class="table-plus"><?= timeFilter($absen->jam_masuk) ?></td>
                  <td class="table-plus"><?= $jam_pulang ?></td>
                  <td><?= $total_jam ?></td>
                  <td><span class="badge badge-<?= $badge ?>"><?= $absen->keterangan ?></span></td>
                </tr>
              <?php
                $no++;
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>

      <?php require APPROOT . '/views/layouts/footer.php'; ?>