<?php
class Riwayat extends Controller
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
    $riwayat = $this->absenModel->getRiwayatUserLogged();

    $data = [
      'title' => 'Riwayat Absensi',
      'menu' => 'Riwayat Absensi',
      'riwayat' => $riwayat
    ];

    $this->view('riwayat/index', $data);
  }
}
