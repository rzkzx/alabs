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
              <div class="datetime" style="text-align: center;">
                <h1 class="" style="margin-bottom: 10px;" id="time"><?= timeNow(); ?></h1>
                <h4 class=""> <?= dayID(today()); ?>, <?= dateID(today()); ?></h4>
              </div>
              <hr class="mb-30 mt-30">
              <div class="row clearfix">
                <div class="col-md-6 col-sm-12 ">
                  <div class="card card-box">
                    <h5 class="card-header weight-500"><i class="fa fa-clock-o"></i> Absen Datang</h5>
                    <div class="card-body">
                      <p class="card-text mb-0">Jam Datang : <b class="text-success">08:00 - 08:20</b> </p>
                      <p class="card-text">Status Kehadiran : <?php echo (isset($data['absen'])) ? '<b class="">' . $data['absen']->keterangan . '</b>' : '<b class="text-danger">Belum Absen</b>'; ?> </p>
                      <?php
                      if (isset($data['absen'])) { ?>
                        <div style="text-align: center;">
                          <p><i>Sudah absen datang pada jam</i></p>
                          <h5><?= timeFilter($data['absen']->jam_masuk); ?></h5>
                        </div>
                      <?php } else {
                      ?>
                        <div style="text-align: center;">
                          <button type="button" id="btnAbsen" data-ket="hadir-masuk" class="btn btn-success btn-lg">
                            Hadir
                          </button>
                        </div>

                        <div class="row" style="text-align:center;padding:20px;justify-content:space-around;">
                          <button type="button" id="btnIzin" data-ket="izin-masuk" class="btn btn-warning btn-lg">
                            Izin
                          </button>
                          <button type="button" id="btnTidak" data-ket="tidak-masuk" class="btn btn-danger btn-lg">
                            Absen
                          </button>
                          <!-- Button trigger modal -->
                          <?php if ($data['totalCuti'] > 3) {
                          ?>
                            <button type="button" id="btnCuti" class="btn btn-primary btn-lg">
                              Cuti
                            </button>
                          <?php
                          } else {
                          ?>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                              Cuti
                            </button>
                          <?php
                          } ?>

                        </div>
                      <?php
                      }
                      ?>

                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12 ">
                  <div class="card card-box">
                    <h5 class="card-header weight-500"><i class="fa fa-clock-o"></i> Absen Pulang</h5>
                    <div class="card-body">
                      <?php
                      if (isset($data['absen']) && $data['absen']->jam_masuk && $data['absen']->keterangan != 'Hadir') {
                        $statusPulang = '<b class="">' . $data['absen']->keterangan . '</b>';
                      } elseif (isset($data['absen']) && $data['absen']->jam_pulang) {
                        $statusPulang = '<b class="">' . $data['absen']->keterangan . '</b>';
                      } else {
                        $statusPulang = '<b class="text-danger">Belum Absen</b>';
                      }

                      ?>
                      <p class="card-text mb-0">Jam Datang : <b class="text-success">17:00 - 18:00</b> </p>
                      <p class="card-text">Status Kehadiran : <?= $statusPulang ?></p>
                      <?php
                      if (isset($data['absen']) &&  $data['absen']->jam_masuk && $data['absen']->jam_pulang) { ?>
                        <div style="text-align: center;">
                          <p><i>Sudah absen pulang pada jam</i></p>
                          <h5><?= timeFilter($data['absen']->jam_pulang); ?></h5>
                        </div>
                      <?php } elseif (isset($data['absen']) && $data['absen']->jam_masuk && $data['absen']->keterangan == 'Tidak Hadir') { ?>
                        <div style="text-align: center;">
                          <p><i>Anda Tidak Hadir hari ini</i></p>
                        </div>
                      <?php } elseif (isset($data['absen']) && $data['absen']->jam_masuk && ($data['absen']->keterangan == 'Izin' || $data['absen']->keterangan == 'Cuti')) { ?>
                        <div style="text-align: center;">
                          <?php if ($data['absen']->konfirmasi) { ?>
                            <h6><i>Absensi Kehadiran telah <?= $data['absen']->konfirmasi ?></i></h6>
                          <?php } else { ?>
                            <h6><i>Menunggu Konfirmasi dari Admin</i></h6>
                          <?php
                          } ?>
                        </div>
                      <?php } elseif (isset($data['absen']) && $data['absen']->jam_masuk && !$data['absen']->jam_pulang && $data['absen']->keterangan == 'Hadir') {
                      ?>
                        <div class="row" style="text-align:center;padding:20px;justify-content:space-around;">
                          <button type="button" id="btnAbsen" data-ket="hadir-pulang" class="btn btn-success btn-lg">
                            Absen Pulang
                          </button>
                        </div>
                      <?php
                      } else {
                      ?>
                        <div style="text-align: center;">
                          <p class="text-danger"><i>Anda belum absen kehadiran datang</i></p>
                          <p class=""><i>"Harap absen kehadiran datang lebih dulu"</i></p>
                        </div>
                      <?php
                      }
                      ?>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Pilih Tanggal Cuti</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="post" action="<?= URLROOT ?>/absen/cuti">
              <div class="modal-body">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="cuti_mulai">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="cuti_mulai" name="cuti_mulai" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="cuti_berakhir">Tanggal Berakhir</label>
                    <input type="date" class="form-control" id="cuti_berakhir" name="cuti_berakhir" required>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-info">Absen Cuti</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <?php require APPROOT . '/views/layouts/footer.php'; ?>

      <script>
        const getCurrentTimeDate = () => {
          let currentTimeDate = new Date();

          var hours = currentTimeDate.getHours();

          var minutes = currentTimeDate.getMinutes();
          minutes = minutes < 10 ? '0' + minutes : minutes;

          var AMPM = hours >= 12 ? 'Malam' : 'Pagi';

          // if (hours === 12) {

          // } else {
          //   hours = hours % 12;
          // }

          var currentTime = `${hours}:${minutes}`;

          var currentDate = currentTimeDate.getDate();



          document.getElementById("time").innerHTML = currentTime;

          setTimeout(getCurrentTimeDate, 500);
        }
        getCurrentTimeDate();

        function alertConfirmation() {
          $(document).delegate("#btnCuti", "click", function() {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Anda melebihi batas cuti bulanan!',
              confirmButtonText: 'OK',
            })
          });

          $(document).delegate("#btnAbsen", "click", function() {
            Swal.fire({
              icon: 'warning',
              title: 'Anda Hadir hari ini?',
              showDenyButton: false,
              showCancelButton: true,
              confirmButtonText: 'Absen',
              cancelButtonText: 'Batal'
            }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {

                var ket = $(this).attr('data-ket');

                // Ajax config
                $.ajax({
                  type: "POST", //we are using GET method to get data from server side
                  url: '<?= URLROOT ?>/absen/absensi/' + ket, // get the route value
                  beforeSend: function() { //We add this before send to disable the button once we submit it so that we prevent the multiple click

                  },
                  success: function(response) { //once the request successfully process to the server side it will return result here
                    // Reload lists of employees
                    Swal.fire('Berhasil Absen Kehadiran hari ini.', response, 'success').then((result) => {
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

          $(document).delegate("#btnTidak", "click", function() {
            Swal.fire({
              icon: 'warning',
              title: 'Anda Tidak Hadir hari ini?',
              showDenyButton: false,
              showCancelButton: true,
              confirmButtonText: 'Absen',
              cancelButtonText: 'Batal'
            }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {

                var ket = $(this).attr('data-ket');

                // Ajax config
                $.ajax({
                  type: "POST", //we are using GET method to get data from server side
                  url: '<?= URLROOT ?>/absen/absensi/' + ket, // get the route value
                  beforeSend: function() { //We add this before send to disable the button once we submit it so that we prevent the multiple click

                  },
                  success: function(response) { //once the request successfully process to the server side it will return result here
                    // Reload lists of employees
                    Swal.fire('Berhasil Absen Kehadiran hari ini.', response, 'success').then((result) => {
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

          $(document).delegate("#btnIzin", "click", function() {
            Swal.fire({
              icon: 'warning',
              title: 'Anda Izin hari ini?',
              showDenyButton: false,
              showCancelButton: true,
              confirmButtonText: 'Absen',
              cancelButtonText: 'Batal'
            }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {

                var ket = $(this).attr('data-ket');

                // Ajax config
                $.ajax({
                  type: "POST", //we are using GET method to get data from server side
                  url: '<?= URLROOT ?>/absen/absensi/' + ket, // get the route value
                  beforeSend: function() { //We add this before send to disable the button once we submit it so that we prevent the multiple click

                  },
                  success: function(response) { //once the request successfully process to the server side it will return result here
                    // Reload lists of employees
                    Swal.fire('Berhasil Absen Kehadiran hari ini.', response, 'success').then((result) => {
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