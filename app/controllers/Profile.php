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
      if (empty($_POST['password']) || empty($_POST['newPassword']) || empty($_POST['confirmNewPassword'])) {
        setFlash('Form input tidak boleh kosong', 'danger');
        return redirect('profile');
      }
      if ($_POST['newPassword'] !== $_POST['confirmNewPassword']) {
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
      if (empty($_POST['nama']) || empty($_POST['nip']) || empty($_POST['email']) || empty($_POST['no_hp']) || empty($_POST['jenis_kelamin'])) {
        setFlash('Form input tidak boleh kosong', 'danger');
        return redirect('profile');
      }
      if ($this->userModel->changeProfile($_POST, $_FILES)) {
        setFlash('Berhasil memperbarui data anda', 'success');
        return redirect('profile');
      } else {
        setFlash('Gagal memperbarui data anda', 'danger');
        return redirect('profile');
      }
    } else {
      return redirect('profile');
    }
  }
}
