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
      <!-- Simple Datatable start -->
      <div class="card-box mb-30">
        <div class="pd-20">
          <h4 class="text-blue h4">Data Riwayat Absensi Pengguna</h4>
        </div>
        <div class="pb-20">
          <?php flash(); ?>
          <table class="table hover stripe data-table-export nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th class="table-plus datatable-nosort">Nama</th>
                <th>NIP</th>
                <th>Email</th>
                <th>No. HP</th>
                <th class="datatable-nosort">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($data['users'] as $user) {
              ?>
              <a href="<?= URLROOT; ?>/riwayat/users/<?= $user->nip ?>">
                <tr>
                  <td><?= $no ?></td>
                  <td class="table-plus"><?= $user->nama ?></td>
                  <td><?= $user->nip ?></td>
                  <td><?= $user->email ?></td>
                  <td><?= $user->no_hp ?></td>
                  <td>
                    <!-- <a href="#" class="p-2 btn btn-aksi-info"><i class="dw dw-eye"></i></a> -->
                    <a href="<?= URLROOT; ?>/riwayat/users/<?= $user->nip ?>" class="p-2 btn btn-aksi-primary"><i class="dw dw-eye"></i></a>
                  </td>
                </tr>
                </a>
              <?php
                $no++;
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>


      <?php require APPROOT . '/views/layouts/footer.php'; ?>