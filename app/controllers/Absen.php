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
    $absenToday = $this->absenModel->getAbsenToday();

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
            setFlash('Berhasil mengisi absen kehadiran hari ini', 'success');
          } else {
            setFlash('Gagal absen hari ini', 'danger');
          }
        } else {
          if ($this->absenModel->absenPulang($data)) {
            setFlash('Berhasil mengisi absen kehadiran hari ini', 'success');
          } else {
            setFlash('Gagal absen hari ini', 'danger');
          }
        }
      }
    } else {
      return redirect('absen');
    }
  }
}
