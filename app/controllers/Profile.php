<?php
class Profile extends Controller
{

  public function __construct()
  {
    if (!Middleware::isLoggedIn()) {
      return redirect('login');
    }

    //new model instance
    $this->userModel = $this->model('UserModel');
  }

  public function index()
  {
    $user = $this->userModel->getByLogin();

    $data = [
      'title' => 'Profile',
      'menu' => 'Profile',
      'user' => $user
    ];

    $this->view('profile/index', $data);
  }

  public function changePassword()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (empty($_POST['password']) || empty($_POST['password_baru']) || empty($_POST['konfirmasi_password_baru'])) {
        setFlash('Form input tidak boleh kosong', 'danger');
        return redirect('profile');
      }
      if ($_POST['password_baru'] !== $_POST['konfirmasi_password_baru']) {
        setFlash('Konfrimasi Password Baru tidak sama', 'danger');
        return redirect('profile');
      }
      if ($this->userModel->changePassword($_POST)) {
        setFlash('Berhasil memperbarui password anda', 'success');
        return redirect('profile');
      } else {
        setFlash('Gagal memperbarui password anda', 'danger');
        return redirect('profile');
      }
    } else {
      return redirect('profile');
    }
  }

  public function changeProfile()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (empty($_POST['nama']) || empty($_POST['nip']) || empty($_POST['pangkat']) || empty($_POST['nik']) || empty($_POST['email'])) {
        setFlash('Form input tidak boleh kosong', 'danger');
        return redirect('profile');
      }
      if ($this->userModel->changeProfile($_POST, $_FILES)) {
        setFlash('Berhasil memperbarui profile anda', 'success');
        return redirect('profile');
      } else {
        setFlash('Gagal memperbarui profile anda', 'danger');
        return redirect('profile');
      }
    } else {
      return redirect('profile');
    }
  }
}
