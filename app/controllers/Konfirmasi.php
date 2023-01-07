<?php
class Konfirmasi extends Controller
{

  public function __construct()
  {
    if (!Middleware::isLoggedIn()) {
      return redirect('login');
    }

    if (!Middleware::admin()) {
      return redirect('login');
    }

    //new model instance
    $this->absenModel = $this->model('AbsenModel');
  }

  public function index()
  {
    $absen = $this->absenModel->getAbsensiKonfirmasiToday();

    $data = [
      'title' => 'Konfirmasi Absensi',
      'menu' => 'Konfirmasi Absensi',
      'absen' => $absen,
    ];

    $this->view('konfirmasi/index', $data);
  }

  public function konfir($data = '')
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($data == '') {
        return redirect('absen');
      } else {
        $data = explode('-', $data);
        if ($this->absenModel->konfirmasi($data)) {
          setFlash('Berhasil konfirmasi kehadiran', 'success');
        } else {
          setFlash('Gagal konfirmasi kehadiran', 'danger');
        }
      }
    } else {
      return redirect('konfirmasi');
    }
  }
}
