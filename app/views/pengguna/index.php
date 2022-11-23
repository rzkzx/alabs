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
      <!-- Simple Datatable start -->
      <div class="card-box mb-30">
        <div class="pd-20">
          <h4 class="text-blue h4">Data Pengguna</h4>
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
                <th>Jenis Kelamin</th>
                <th class="datatable-nosort">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($data['users'] as $user) {
              ?>
                <tr>
                  <td><?= $no ?></td>
                  <td class="table-plus"><?= $user->nama ?></td>
                  <td><?= $user->nip ?></td>
                  <td><?= $user->email ?></td>
                  <td><?= $user->no_hp ?></td>
                  <td><?= $user->jenis_kelamin ?></td>
                  <td>
                    <!-- <a href="#" class="p-2 btn btn-aksi-info"><i class="dw dw-eye"></i></a> -->
                    <a href="<?= URLROOT; ?>/users/edit/<?= $user->id ?>" class="p-2 btn btn-aksi-primary"><i class="dw dw-edit2"></i></a>
                    <button type="button" class="p-2 btn btn-aksi-danger" id="btnDelete" data-id="<?= $user->id ?>"><i class="dw dw-delete-3"></i></button>
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