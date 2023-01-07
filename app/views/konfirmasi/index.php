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
        <div class="card-header">Konfirmasi Absen User</div>
        <div class="card-body row" style="align-items: center;">
        </div>
      </div>
      <!-- Simple Datatable start -->
      <div class="card-box mb-30">
        <div class="pd-20">
          <h4 class="text-blue h4">Data Absensi Hari Ini</h4>
        </div>
        <div class="pb-20">
          <?php flash(); ?>
          <table class="table hover stripe data-table-export nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th class="table-plus datatable-nosort">NIP</th>
                <th>Nama</th>
                <th>No. HP</th>
                <th>Keterangan</th>
                <th>Awal Cuti</th>
                <th>Akhir Cuti</th>
                <th class="datatable-nosort">Konfirmasi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($data['absen'] as $absen) {
                if ($absen->keterangan == 'Izin') {
                  $badge = 'warning';
                } else {
                  $badge = 'secondary';
                }

                if ($absen->cuti_mulai) {
                  $awal_cuti = dateID($absen->cuti_mulai);
                  $akhir_cuti = dateID($absen->cuti_berakhir);
                } else {
                  $awal_cuti = NULL;
                  $akhir_cuti = NULL;
                }
              ?>
                <tr>
                  <td><?= $no ?></td>
                  <td class="table-plus"><?= $absen->nip ?></td>
                  <td class="table-plus"><?= $absen->nama ?></td>
                  <td><?= $absen->no_hp ?></td>
                  <td>
                    <h6><span class="badge badge-<?= $badge ?> badge-lg text-uppercase"><?= $absen->keterangan ?></span></h6>
                  </td>
                  <td><?= $awal_cuti ?></td>
                  <td><?= $akhir_cuti ?></td>
                  <td>
                    <?php if ($absen->konfirmasi) {
                      if ($absen->konfirmasi == 'Diterima') {
                        $konfBadge = 'success';
                      } else {
                        $konfBadge = 'danger';
                      }
                    ?>
                      <h6><span class="badge badge-<?= $konfBadge ?> badge-lg"><?= $absen->konfirmasi ?></span></h6>
                    <?php
                    } else {
                    ?>
                      <button type="button" id="btnKonfirmasi" data-ket="diterima-<?= $absen->id ?>" class="btn btn-success btn-sm">Diterima</button>
                      <button type="button" id="btnKonfirmasi" data-ket="ditolak-<?= $absen->id ?>" class="btn btn-danger btn-sm">Ditolak</button>
                    <?php
                    } ?>

                  </td>
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
          $(document).delegate("#btnKonfirmasi", "click", function() {
            Swal.fire({
              icon: 'warning',
              title: 'Konfirmasi kehadiran ini?',
              showDenyButton: false,
              showCancelButton: true,
              confirmButtonText: 'Konfirmasi',
              cancelButtonText: 'Batal'
            }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {

                var ket = $(this).attr('data-ket');

                // Ajax config
                $.ajax({
                  type: "POST", //we are using GET method to get data from server side
                  url: '<?= URLROOT ?>/konfirmasi/konfir/' + ket, // get the route value
                  beforeSend: function() { //We add this before send to disable the button once we submit it so that we prevent the multiple click

                  },
                  success: function(response) { //once the request successfully process to the server side it will return result here
                    // Reload lists of employees
                    Swal.fire('Berhasil Konfirmasi Kehadiran', response, 'success').then((result) => {
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