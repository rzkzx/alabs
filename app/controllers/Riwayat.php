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
    $this->userModel = $this->model('UserModel');
  }

  public function index()
  {
    if (isset($_POST['filter'])) {
      $riwayat = $this->absenModel->getRiwayatUserLoggedByDate($_POST['date']);
    } else {
      $riwayat = $this->absenModel->getRiwayatUserLogged();
    }

    $user = $this->userModel->getUserByNIP($_SESSION['nip']);

    $data = [
      'title' => 'Riwayat Absensi',
      'menu' => 'Riwayat Absensi',
      'riwayat' => $riwayat,
      'user' => $user
    ];

    $this->view('riwayat/index', $data);
  }

  public function users($nip = '')
  {
    if (Middleware::admin()) {
      $data = [
        'title' => 'Riwayat Absensi',
        'menu' => 'Riwayat Absensi',
      ];

      if ($nip) {
        if (isset($_POST['filter'])) {
          $data['riwayat'] = $this->absenModel->getRiwayatUserNIPByDate($nip, $_POST['date']);
        } else {
          $data['riwayat'] = $this->absenModel->getRiwayatUserNIP($nip);
        }

        $data['user'] = $this->userModel->getUserByNIP($nip);

        $this->view('riwayat/index', $data);
      } else {
        $data['users'] = $this->userModel->getAll();

        $this->view('riwayat/admin', $data);
      }
    } else {
      return redirect('riwayat');
    }
  }

  public function export($nip = '')
  {
    $data = [
      'title' => 'Riwayat Absensi',
      'menu' => 'Riwayat Absensi',
    ];

    if ($nip) {
      $data['riwayat'] = $this->absenModel->getRiwayatUserNIP($nip);

      $data['user'] = $this->userModel->getUserByNIP($nip);

      $this->view('riwayat/export/index', $data);
    } else {
      $data['users'] = $this->userModel->getAll();

      $this->view('riwayat/export/index', $data);
    }
  }
}
