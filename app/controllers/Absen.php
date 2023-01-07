<?php
class Absen extends Controller
{

  public function __construct()
  {
    if (!Middleware::isLoggedIn()) {
      return redirect('login');
    }

    //new model instance
    $this->absenModel = $this->model('AbsenModel');
  }

  public function index()
  {
    $absenToday = $this->absenModel->getAbsenTodayByUserLogged();

    $data = [
      'title' => 'Absen',
      'menu' => 'Absen',
    ];

    if ($absenToday) {
      $data['absen'] = $absenToday;
    }

    $this->view('absen/index', $data);
  }

  public function absensi($ket = '')
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($ket == '') {
        return redirect('absen');
      } else {
        $data = explode('-', $ket);
        if ($data[1] == 'masuk') {
          if ($this->absenModel->absenMasuk($data)) {
            return 'Berhasil mengisi absen kehadiran hari ini';
          } else {
            return 'Gagal absen hari ini';
          }
        } else {
          if ($this->absenModel->absenPulang($data)) {
            return 'Berhasil mengisi absen kehadiran hari ini';
          } else {
            return 'Gagal absen hari ini';
          }
        }
      }
    } else {
      return redirect('absen');
    }
  }

  public function cuti()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($this->absenModel->absenCuti($_POST)) {
        return redirect('absen');
      } else {
        return redirect('absen');
      }
    } else {
      return redirect('absen');
    }
  }
}
