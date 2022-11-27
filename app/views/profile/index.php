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

      <?php flash(); ?>
      <!-- horizontal Basic Forms Start -->
      <div class="row clearfix">
        <div class="col-md-6 col-sm-12 mb-30">
          <div class="card-box pd-20">
            <form action="<?= URLROOT; ?>/profile/changeProfile" method="post" enctype="multipart/form-data">
              <div class="clearfix">
                <div class="pull-left">
                  <h4 class="text-blue h4">Form Data User</h4>
                </div>
                <div class="pull-right">
                  <button class="btn btn-primary btn-lg" role="submit"><i class="fa fa-user"></i> Perbarui Data</button>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12">
                  <div class="avatar-upload">
                    <div class="avatar-edit">
                      <input type="file" id="imageUpload" name="avatar" onchange="return avatarUpload()" accept=".png, .jpg, .jpeg" />
                      <label for="imageUpload"><i class="fa fa-pencil"></i></label>
                    </div>
                    <div class="avatar-preview">
                      <div id="imagePreview" style="background-image: url(<?= URLROOT; ?>/images/avatar/<?php echo ($_SESSION['avatar']) ? $_SESSION['avatar'] : 'dummy.png'; ?>);">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>NIP</label>
                <input class="form-control" type="text" placeholder="" value="<?= $data['user']->nip ?>" name="nip" readonly />
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
                <label>Jenis Kelamin</label>
                <div class="custom-control custom-radio mb-5">
                  <input type="radio" name="jenis_kelamin" value="Pria" id="radioPria" class="custom-control-input" <?php echo ($data['user']->jenis_kelamin == 'Pria') ? 'checked' : ''; ?>>
                  <label class="custom-control-label" for="radioPria">Laki - Laki / Pria</label>
                </div>
                <div class="custom-control custom-radio mb-5">
                  <input type="radio" name="jenis_kelamin" value="Wanita" id="radioWanita" class="custom-control-input" <?php echo ($data['user']->jenis_kelamin == 'Wanita') ? 'checked' : ''; ?>>
                  <label class="custom-control-label" for="radioWanita">Perempuan / Wanita</label>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-6 col-sm-12 mb-30">
          <div class="card-box pd-20">
            <form action="<?= URLROOT; ?>/profile/changePassword" method="post" enctype="multipart/form-data">
              <div class="clearfix">
                <div class="pull-left">
                  <h4 class="text-blue h4">Form Ganti Password</h4>
                </div>
                <div class="pull-right">
                  <button class="btn btn-primary btn-lg" role="submit"><i class="fa fa-lock"></i> Perbarui Password</button>
                </div>
              </div>
              <div class="form-group">
                <label>Password Saat Ini</label>
                <input class="form-control" type="password" placeholder="" name="password" />
              </div>
              <div class="form-group">
                <label>Password Baru</label>
                <input class="form-control" type="password" placeholder="" name="newPassword" />
              </div>
              <div class="form-group">
                <label>Konfirmasi Password Baru</label>
                <input class="form-control" type="password" placeholder="" name="confirmNewPassword" />
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- horizontal Basic Forms End -->
      <?php require APPROOT . '/views/layouts/footer.php'; ?>
      <script>
        function avatarUpload() {
          var inputFile = document.getElementById('imageUpload');
          var pathFile = inputFile.value;
          var ekstensiOk = /(\.png|\.jpg|\.jpeg)$/i;
          if (inputFile.files[0].size > 2000 * 1000) { // ini untuk ukuran1000000 untuk 1 MB.
            alert("Maaf. Foto Terlalu Besar ! Maksimal Upload 2mb");
            inputFile.value = '';
            return false;
          };
          if (!ekstensiOk.exec(pathFile)) {
            alert('Silakan upload file yang memiliki ekstensi .png/.jpg/.jpeg');
            inputFile.value = '';
            return false;
          } else {
            //Pratinjau gambar
            if (inputFile.files && inputFile.files[0]) {
              var reader = new FileReader();
              reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
              };
              reader.readAsDataURL(inputFile.files[0]);
            }
          }
        }
      </script>