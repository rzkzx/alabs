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
          <div class="col-md-6 col-sm-12 text-right">
            <a class="btn btn-primary btn-lg" href="<?= URLROOT; ?>/users/add">
              <i class="fa fa-user-plus"></i>
              Tambahkan Pengguna Baru
            </a>
          </div>
        </div>
      </div>
      <div class="card card-box mb-30">
        <div class="card-header">Profil User</div>
        <div class="card-body row" style="align-items: center;">
          <div class="avatar-preview" style="margin-left:20px;width:150px;height:150px;">
            <div style="background-image: url(<?= URLROOT; ?>/images/avatar/<?php echo ($_SESSION['avatar']) ? $_SESSION['avatar'] : 'dummy.png'; ?>);">
            </div>
          </div>
          <div class="pd-20">
            <table class="data-user-riwayat">
              <tr>
                <td>Nama</td>
                <td>:</td>
                <td class="info"><?= $_SESSION['nama'] ?></td>
              </tr>
              <tr>
                <td>NIP</td>
                <td>:</td>
                <td class="info"><?= $_SESSION['nip'] ?></td>
              </tr>
              <tr>
                <td>Email</td>
                <td>:</td>
                <td class="info"><?= $_SESSION['email'] ?></td>
              </tr>
              <tr>
                <td>No HP</td>
                <td>:</td>
                <td class="info"><?= $_SESSION['no_hp'] ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <!-- Simple Datatable start -->
      <div class="card-box mb-30">
        <div class="pb-20 pt-20">
          <?php flash(); ?>
          <table class="table hover stripe data-table-export nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th class="table-plus datatable-nosort">Jam Masuk</th>
                <th class="table-plus datatable-nosort">Jam Pulang</th>
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
              ?>
                <tr>
                  <td><?= $no ?></td>
                  <td><?= dayID($absen->tanggal) ?>, <?= dateID($absen->tanggal) ?></td>
                  <td class="table-plus"><?= timeFilter($absen->jam_masuk) ?></td>
                  <td class="table-plus"><?= $jam_pulang ?></td>
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

      <script>
        function alertConfirmation() {
          $(document).delegate("#btnDelete", "click", function() {
            Swal.fire({
              icon: 'warning',
              title: 'Anda yakin menghapus user ini?',
              showDenyButton: false,
              showCancelButton: true,
              confirmButtonText: 'Hapus',
              cancelButtonText: 'Batal'
            }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {

                var id = $(this).attr('data-id');

                // Ajax config
                $.ajax({
                  type: "POST", //we are using GET method to get data from server side
                  url: '<?= URLROOT ?>/users/delete/' + id, // get the route value
                  beforeSend: function() { //We add this before send to disable the button once we submit it so that we prevent the multiple click

                  },
                  success: function(response) { //once the request successfully process to the server side it will return result here
                    // Reload lists of employees
                    Swal.fire('Berhasil Hapus Pengguna.', response, 'success').then((result) => {
                      if (result.isConfirmed) {
                        location.reload();
                      }
                    });
                  }
                });

              } else if (result.isDenied) {
                Swal.fire('Perubahan tidak disimpan', '', 'info')
              }
            });
          });
        }
      </script>